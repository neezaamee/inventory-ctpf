@extends('layouts.app')

@section('title', 'Create Permission')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Add New Permission</h3>
            </div>
            
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. view-transactions" required>
                        <small class="form-text text-muted">Use standard conventions like `action-resource` (e.g. `edit-users`, `create-items`).</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Save Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
