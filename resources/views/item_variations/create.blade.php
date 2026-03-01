@extends('layouts.app')

@section('title', 'Add Item Variation')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">New Size/Type Variation</h3>
            </div>
            
            <form action="{{ route('item-variations.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Base Item <span class="text-danger">*</span></label>
                        <select class="form-select @error('item_id') is-invalid @enderror" id="item_id" name="item_id" required>
                            <option value="">Select Base Item...</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }} ({{ $item->category->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Variation Value (Size, Serial, etc.) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}" placeholder="e.g., L, XL, Red, SN-1234" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Initial Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" required min="0">
                        @error('stock_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                
                <div class="card-footer">
                    <a href="{{ route('item-variations.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Save Variation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
