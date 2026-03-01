@extends('layouts.app')

@section('title', 'Currently Issued Items')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Currently Issued Items to Officers</h3>
            </div>
            
            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Officer</th>
                            <th>Belt Number</th>
                            <th>Item & Variation</th>
                            <th>Current Balance (Unreturned)</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($issued as $issue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $issue->officer->name }}</strong></td>
                                <td>{{ $issue->officer->belt_number }} <small class="text-muted">({{ $issue->officer->rank }})</small></td>
                                <td>
                                    {{ $issue->variation->item->name }}<br>
                                    <span class="badge text-bg-secondary">{{ $issue->variation->value }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-danger">{{ $issue->balance }}</span> Units
                                </td>
                                <td>
                                    <a href="{{ route('transactions.create_return', ['officer_id' => $issue->officer_id, 'variation_id' => $issue->item_variation_id]) }}" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-arrow-return-left"></i> Receive Back
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No items are currently issued to any officers.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endsection
