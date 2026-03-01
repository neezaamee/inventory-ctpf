@extends('layouts.app')

@section('title', 'Manage Item Variations')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Stock Variations (Sizes, Types, Serials)</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('item-variations.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search variation or item..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('item-variations.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-plus-circle"></i> Add New Variation
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->has('error'))
                    <div class="alert alert-danger m-3">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Variation / Size</th>
                            <th>Current Stock</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($variations as $variation)
                            <tr>
                                <td>
                                    <strong>{{ $variation->item->name }}</strong><br>
                                    <small class="text-muted">{{ $variation->item->category->name }}</small>
                                </td>
                                <td><span class="badge text-bg-info">{{ $variation->value }}</span></td>
                                <td>
                                    @if($variation->stock_quantity <= $variation->item->min_stock_threshold)
                                        <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle"></i> {{ $variation->stock_quantity }}</span>
                                    @else
                                        <span class="text-success fw-bold">{{ $variation->stock_quantity }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ $variation->stock_quantity > 0 ? route('transactions.create_out', ['variation_id' => $variation->id]) : 'javascript:void(0)' }}" 
                                           class="btn btn-sm btn-warning text-dark {{ $variation->stock_quantity <= 0 ? 'disabled' : '' }}" 
                                           title="{{ $variation->stock_quantity > 0 ? 'Issue Item' : 'Out of Stock' }}"
                                           @if($variation->stock_quantity <= 0) tabindex="-1" aria-disabled="true" @endif>
                                            <i class="bi bi-box-arrow-up-right"></i> Issue
                                        </a>
                                        <a href="{{ route('item-variations.edit', $variation) }}" class="btn btn-sm btn-info" title="Edit Variation">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('item-variations.destroy', $variation) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this variation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No item variations found in the system.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($variations->hasPages())
                <div class="card-footer clearfix">
                    {{ $variations->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
