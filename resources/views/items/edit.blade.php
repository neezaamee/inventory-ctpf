@extends('layouts.app')

@section('title', 'Edit Inventory Item')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Edit Item: {{ $item->name }}</h3>
            </div>
            
            <form action="{{ route('items.update', $item) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $item->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="min_stock_threshold" class="form-label">Minimum Stock Alert Threshold <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('min_stock_threshold') is-invalid @enderror" id="min_stock_threshold" name="min_stock_threshold" value="{{ old('min_stock_threshold', $item->min_stock_threshold) }}" required min="0">
                        <small class="form-text text-muted">You will be alerted when stock falls below this number.</small>
                        @error('min_stock_threshold')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                
                <div class="card-footer">
                    <a href="{{ route('items.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
