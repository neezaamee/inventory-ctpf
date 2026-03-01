@extends('layouts.app')

@section('title', 'Process Stock In (Restock)')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-success card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Stock IN (Restock)</h3>
            </div>
            
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="in">
                
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="quantity" class="form-label">Quantity to Add <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required min="1">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="item_variation_id" class="form-label">Select Item (with Size/Variation) <span class="text-danger">*</span></label>
                        <select class="form-select @error('item_variation_id') is-invalid @enderror" id="item_variation_id" name="item_variation_id" required>
                            <option value="">Search or Select an Item...</option>
                            @foreach($variations as $var)
                                <option value="{{ $var->id }}" {{ old('item_variation_id', request('item_variation_id')) == $var->id ? 'selected' : '' }}>
                                    {{ $var->item->name }} - Size/Value: {{ $var->value }} (Current Stock: {{ $var->stock_quantity }})
                                </option>
                            @endforeach
                        </select>
                        @error('item_variation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks (Optional)</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="2">{{ old('remarks') }}</textarea>
                    </div>

                </div>
                
                <div class="card-footer">
                    <a href="{{ route('transactions.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-success float-end"><i class="bi bi-arrow-down-left"></i> Process Restock</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
