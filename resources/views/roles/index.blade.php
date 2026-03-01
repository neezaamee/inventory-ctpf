@extends('layouts.app')

@section('title', 'System Roles')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Manage Roles</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('roles.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search roles..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-shield-plus"></i> Add New Role
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
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ ucfirst($role->name) }}</td>
                                <td>
                                    @foreach($role->permissions as $permission)
                                        <span class="badge text-bg-info">{{ $permission->name }}</span>
                                    @endforeach
                                    @if($role->permissions->isEmpty())
                                        <span class="badge text-bg-secondary">No Permissions</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        @if(!in_array($role->name, ['admin', 'super-admin']))
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($roles->hasPages())
                <div class="card-footer clearfix">
                    {{ $roles->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
