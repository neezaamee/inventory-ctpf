@extends('layouts.app')

@section('title', 'Receive Back from Officer')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-info card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">Stock IN (Receive Back)</h3>
            </div>
            
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="return">
                
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="quantity" class="form-label">Quantity to Receive <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required min="1">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="officer_id" class="form-label">Returning Officer <span class="text-danger">*</span></label>
                        <select class="form-select @error('officer_id') is-invalid @enderror" id="officer_id" name="officer_id" required>
                            <option value="">Select Officer...</option>
                            @foreach($officers as $officer)
                                <option value="{{ $officer->id }}" {{ old('officer_id') == $officer->id ? 'selected' : '' }}>
                                    {{ $officer->name }} - {{ $officer->belt_number }} ({{ $officer->rank }})
                                </option>
                            @endforeach
                        </select>
                        @error('officer_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="item_variation_id" class="form-label">Select Returned Item (Size/Variation) <span class="text-danger">*</span></label>
                        <select class="form-select @error('item_variation_id') is-invalid @enderror" id="item_variation_id" name="item_variation_id" required>
                            <option value="">Search or Select an Item...</option>
                            @foreach($variations as $var)
                                <option value="{{ $var->id }}" {{ old('item_variation_id') == $var->id ? 'selected' : '' }}>
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
                    <button type="submit" class="btn btn-info float-end text-white"><i class="bi bi-arrow-return-left"></i> Receive Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
