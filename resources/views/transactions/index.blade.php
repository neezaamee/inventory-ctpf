@extends('layouts.app')

@section('title', 'Transactions History')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Recent Transactions</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <a href="{{ route('transactions.create_in') }}" class="btn btn-sm btn-success">
                            <i class="bi bi-arrow-down-left"></i> Restock
                        </a>
                        <a href="{{ route('transactions.create_return') }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-arrow-return-left"></i> Receive Back
                        </a>
                        <a href="{{ route('transactions.create_out') }}" class="btn btn-sm btn-danger">
                            <i class="bi bi-arrow-up-right"></i> Issue OUT
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif
                
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Item & Variation</th>
                            <th>Quantity</th>
                            <th>Officer (If Issuance)</th>
                            <th>Operator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $tx)
                            <tr>
                                <td>{{ $tx->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($tx->type === 'in')
                                        <span class="badge text-bg-success"><i class="bi bi-arrow-down-left"></i> Stock In</span>
                                    @elseif($tx->type === 'return')
                                        <span class="badge text-bg-info text-white"><i class="bi bi-arrow-return-left"></i> Received Back</span>
                                    @else
                                        <span class="badge text-bg-danger"><i class="bi bi-arrow-up-right"></i> Stock Out</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $tx->variation->item->name ?? 'Deleted Item' }}</strong><br>
                                    <small class="text-muted">Size/Type: {{ $tx->variation->value ?? 'N/A' }}</small>
                                </td>
                                <td>{{ $tx->quantity }}</td>
                                <td>
                                    @if($tx->officer)
                                        {{ $tx->officer->name }} ({{ $tx->officer->belt_number }})
                                    @else
                                        <span class="text-muted">--</span>
                                    @endif
                                </td>
                                <td>{{ $tx->user->name ?? 'System' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No transactions recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
