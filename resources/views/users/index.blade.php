@extends('layouts.app')

@section('title', 'System Users')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Manage Users</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('users.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search name or email..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-person-plus-fill"></i> Add New User
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge text-bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                    @if($user->roles->isEmpty())
                                        <span class="badge text-bg-secondary">No Role assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
            @if($users->hasPages())
                <div class="card-footer clearfix">
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
