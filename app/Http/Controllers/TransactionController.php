<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\ItemVariation;
use App\Models\Officer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['variation.item', 'officer', 'user'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function issuedItems(Request $request)
    {
        // Calculate the current active balance of issued items per officer per variation
        $issued = Transaction::select(
                'officer_id', 
                'item_variation_id', 
                DB::raw("SUM(CASE WHEN type = 'out' THEN quantity ELSE 0 END) - SUM(CASE WHEN type = 'return' THEN quantity ELSE 0 END) as balance")
            )
            ->whereNotNull('officer_id')
            ->groupBy('officer_id', 'item_variation_id')
            ->having('balance', '>', 0)
            ->with(['officer', 'variation.item.category'])
            ->get();

        return view('transactions.issued', compact('issued'));
    }

    public function createIn()
    {
        $variations = ItemVariation::with('item')->get();
        return view('transactions.create_in', compact('variations'));
    }

    public function createOut(Request $request)
    {
        $variations = ItemVariation::with('item')->where('stock_quantity', '>', 0)->get();
        $officers = Officer::all();
        $selectedVariation = $request->get('variation_id');
        return view('transactions.create_out', compact('variations', 'officers', 'selectedVariation'));
    }

    public function createReturn()
    {
        $variations = ItemVariation::with('item')->get();
        $officers = Officer::all();
        return view('transactions.create_return', compact('variations', 'officers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_variation_id' => 'required|exists:item_variations,id',
            'type' => 'required|in:in,out,return',
            'quantity' => 'required|integer|min:1',
            'officer_id' => 'nullable|required_if:type,out|required_if:type,return|exists:officers,id',
            'remarks' => 'nullable|string'
        ]);

        $variation = ItemVariation::findOrFail($validated['item_variation_id']);

        if ($validated['type'] === 'out' && $variation->stock_quantity < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock. Only ' . $variation->stock_quantity . ' available.'])->withInput();
        }

        // Apply transaction
        DB::transaction(function () use ($validated, $variation) {
            Transaction::create([
                'item_variation_id' => $validated['item_variation_id'],
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'officer_id' => $validated['officer_id'] ?? null,
                'user_id' => Auth::id(),
                'remarks' => $validated['remarks']
            ]);

            // Update Stock
            if ($validated['type'] === 'in' || $validated['type'] === 'return') {
                $variation->increment('stock_quantity', $validated['quantity']);
            } else {
                $variation->decrement('stock_quantity', $validated['quantity']);
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaction completed successfully.');
    }

    public function show(Transaction $transaction)
    {
        // View single transaction details / receipt
    }

    // Edit and Update are typically disabled for transactions in inventory systems (auditing reasons).
    // Deletions should arguably be disabled or require reversing the stock count.
    // For now we'll leave them blank or restricted.
}
