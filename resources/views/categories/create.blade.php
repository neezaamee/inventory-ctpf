@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Create New Category</h3>
            </div>
            
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('categories.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
