@extends('layouts.app')

@section('title', 'Manage Permissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Manage Permissions</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('permissions.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search permissions..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-plus-circle"></i> Add New Permission
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
                            <th>Permission Name</th>
                            <th>Guard</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                                <td><strong>{{ $permission->name }}</strong></td>
                                <td>{{ $permission->guard_name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline" onsubmit="return confirm('WARNING: Deleting a permission may break system access logic. Proceed?');">
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
                                <td colspan="4" class="text-center">No permissions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($permissions->hasPages())
                <div class="card-footer clearfix">
                    {{ $permissions->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
