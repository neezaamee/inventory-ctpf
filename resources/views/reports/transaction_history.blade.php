@extends('layouts.app')

@section('title', 'Transaction History Report')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Filter Transactions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.transaction_history') }}" method="GET" class="row gx-3 gy-2 align-items-center">
                    <div class="col-sm-4">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-sm-4 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-funnel-fill"></i> Filter</button>
                        <a href="{{ route('reports.transaction_history') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaction Records</h3>
                <div class="card-tools">
                    <a href="{{ route('reports.transaction_history', array_merge(request()->query(), ['export' => 'pdf'])) }}" class="btn btn-sm btn-danger" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Item Details</th>
                            <th>Qty</th>
                            <th>Officer</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $tx)
                            <tr>
                                <td>{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @if($tx->type == 'in')
                                        <span class="badge text-bg-success">Stock In</span>
                                    @else
                                        <span class="badge text-bg-danger">Stock Out</span>
                                    @endif
                                </td>
                                <td>{{ $tx->variation->item->name }} ({{ $tx->variation->value }})</td>
                                <td>{{ $tx->quantity }}</td>
                                <td>{{ $tx->officer ? $tx->officer->name . ' (' . $tx->officer->belt_number . ')' : '--' }}</td>
                                <td>{{ Str::limit($tx->remarks, 30) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No transactions match your criteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
