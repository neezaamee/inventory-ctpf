@extends('layouts.app')

@section('title', 'System Reports')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Inventory Status Report</h5>
            </div>
            <div class="card-body">
                <p class="card-text">View current stock levels for all items and variations across the warehouse. Exportable to PDF for auditing.</p>
                <a href="{{ route('reports.inventory_status') }}" class="btn btn-primary"><i class="bi bi-file-earmark-bar-graph"></i> View Report</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h5 class="m-0">Transaction History Report</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Generate a log of all Stock In and Stock Out (Issuance) operations. Filterable by date.</p>
                <a href="{{ route('reports.transaction_history') }}" class="btn btn-success"><i class="bi bi-file-earmark-text"></i> View Report</a>
            </div>
        </div>
    </div>
</div>
@endsection
