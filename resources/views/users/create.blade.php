@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Create User Profile</h3>
            </div>
            
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <hr>
                    <h5 class="mb-3">Assign Roles</h5>
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}">
                            <label class="form-check-label" for="role_{{ $role->id }}">
                                {{ ucfirst($role->name) }}
                            </label>
                        </div>
                    @endforeach

                    <hr>
                    <h5 class="mb-3">Assign Direct Permissions <small class="text-muted">(Optional)</small></h5>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
