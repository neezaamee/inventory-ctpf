@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Modify Role & Permissions</h3>
            </div>
            
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required {{ in_array($role->name, ['admin', 'super-admin']) ? 'readonly' : '' }}>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <hr>
                    <h5 class="mb-3">Assign Permissions</h5>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
