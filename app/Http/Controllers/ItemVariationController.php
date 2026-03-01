<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemVariation;
use App\Models\Item;

class ItemVariationController extends Controller
{
    public function index(Request $request)
    {
        $query = ItemVariation::with('item.category');
        if ($request->has('search') && $request->search != '') {
            $query->where('value', 'like', '%' . $request->search . '%')
                  ->orWhereHas('item', function($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
        }
        $variations = $query->paginate(10);
        return view('item_variations.index', compact('variations'));
    }

    public function create()
    {
        $items = Item::with('category')->get();
        return view('item_variations.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'value' => 'required|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        ItemVariation::create($validated);

        return redirect()->route('item-variations.index')->with('success', 'Variation added successfully.');
    }

    public function edit(ItemVariation $itemVariation)
    {
        $items = Item::all();
        return view('item_variations.edit', compact('itemVariation', 'items'));
    }

    public function update(Request $request, ItemVariation $itemVariation)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'value' => 'required|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $itemVariation->update($validated);

        return redirect()->route('item-variations.index')->with('success', 'Variation updated successfully.');
    }

    public function destroy(ItemVariation $itemVariation)
    {
        // Prevent deletion if transacted, or implement constraint handling
        if ($itemVariation->transactions()->exists()) {
            return back()->withErrors(['error' => 'Cannot delete variation with transaction history.']);
        }

        $itemVariation->delete();

        return redirect()->route('item-variations.index')->with('success', 'Variation deleted successfully.');
    }
}
