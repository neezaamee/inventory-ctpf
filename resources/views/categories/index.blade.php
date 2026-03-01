@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Categories List</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('categories.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-plus-lg"></i> Add New Category
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
                            <th>Total Items</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->items->count() ?? 0 }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                                <td colspan="4" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="card-footer clearfix">
                    {{ $categories->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
