@extends('layouts.app')

@section('title', 'Manage Inventory Items')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Items List</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('items.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search items or categories..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('items.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-plus-lg"></i> Add New Item
                    </a>
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
                            <th style="width: 50px">#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Min Stock Alert</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td><span class="badge text-bg-secondary">{{ $item->category->name }}</span></td>
                                <td>{{ $item->min_stock_threshold }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                                <td colspan="5" class="text-center">No inventory items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($items->hasPages())
                <div class="card-footer clearfix">
                    {{ $items->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
