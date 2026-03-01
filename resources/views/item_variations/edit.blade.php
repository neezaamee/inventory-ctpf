@extends('layouts.app')

@section('title', 'Edit Item Variation')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Edit Variation: {{ $itemVariation->value }}</h3>
            </div>
            
            <form action="{{ route('item-variations.update', $itemVariation) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Base Item <span class="text-danger">*</span></label>
                        <select class="form-select @error('item_id') is-invalid @enderror" id="item_id" name="item_id" required>
                            <option value="">Select Base Item...</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" {{ old('item_id', $itemVariation->item_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Variation Value (Size, Serial, etc.) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $itemVariation->value) }}" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $itemVariation->stock_quantity) }}" required min="0">
                        <small class="text-danger">Warning: Changing this manually bypasses transaction history!</small>
                        @error('stock_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                
                <div class="card-footer">
                    <a href="{{ route('item-variations.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Update Variation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
