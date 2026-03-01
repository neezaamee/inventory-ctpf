<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function inventoryStatus(Request $request)
    {
        $variations = \App\Models\ItemVariation::with('item.category')->get();
        
        if ($request->has('export') && $request->export == 'pdf') {
            $pdf = Pdf::loadView('reports.pdf.inventory_status', compact('variations'));
            return $pdf->download('inventory_status_report_' . date('Y-m-d') . '.pdf');
        }

        return view('reports.inventory_status', compact('variations'));
    }

    public function transactionHistory(Request $request)
    {
        $query = \App\Models\Transaction::with(['variation.item', 'officer', 'user'])->latest();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $transactions = $query->get();

        if ($request->has('export') && $request->export == 'pdf') {
            $pdf = Pdf::loadView('reports.pdf.transaction_history', compact('transactions'));
            return $pdf->download('transaction_history_report_' . date('Y-m-d') . '.pdf');
        }

        return view('reports.transaction_history', compact('transactions'));
    }
}
