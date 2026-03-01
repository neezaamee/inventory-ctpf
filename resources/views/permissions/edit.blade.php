@extends('layouts.app')

@section('title', 'Edit Permission')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-info card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Edit Permission: {{ $permission->name }}</h3>
            </div>
            
            <form action="{{ route('permissions.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-info float-end text-white">Update Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
