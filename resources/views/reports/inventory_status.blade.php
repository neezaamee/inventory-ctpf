@extends('layouts.app')

@section('title', 'Inventory Status Report')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Current Inventory Status</h3>
                <div class="card-tools">
                    <a href="{{ route('reports.inventory_status', ['export' => 'pdf']) }}" class="btn btn-sm btn-danger" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Item Name</th>
                            <th>Variation / Size</th>
                            <th>Current Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($variations as $var)
                            <tr>
                                <td>{{ $var->item->category->name }}</td>
                                <td>{{ $var->item->name }}</td>
                                <td>{{ $var->value }}</td>
                                <td>{{ $var->stock_quantity }}</td>
                                <td>
                                    @if($var->stock_quantity <= $var->item->min_stock_threshold)
                                        <span class="badge text-bg-danger">Low Stock</span>
                                    @else
                                        <span class="badge text-bg-success">In Stock</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
