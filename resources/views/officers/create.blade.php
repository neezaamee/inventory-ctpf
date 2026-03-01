@extends('layouts.app')

@section('title', 'Register Officer')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Register New Officer</h3>
            </div>
            
            <form action="{{ route('officers.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="belt_number" class="form-label">Belt Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('belt_number') is-invalid @enderror" id="belt_number" name="belt_number" value="{{ old('belt_number') }}" required>
                            @error('belt_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="rank" class="form-label">Rank <span class="text-danger">*</span></label>
                            <select class="form-select select2 @error('rank') is-invalid @enderror" id="rank" name="rank" required>
                                <option value="">Select Rank...</option>
                                @foreach($ranks as $r)
                                    <option value="{{ $r->name }}" {{ old('rank') == $r->name ? 'selected' : '' }}>{{ $r->name }}</option>
                                @endforeach
                            </select>
                            @error('rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="posting" class="form-label">Current Posting</label>
                        <input type="text" class="form-control @error('posting') is-invalid @enderror" id="posting" name="posting" value="{{ old('posting') }}" placeholder="Sector or Branch Name">
                        @error('posting')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_no" class="form-label">Contact Number</label>
                        <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ old('contact_no') }}">
                        @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="{{ route('officers.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-end">Register Officer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
