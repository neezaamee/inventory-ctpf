@extends('layouts.app')

@section('title', 'Manage Officers')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Registered Officers</h3>
                <div class="card-tools d-flex justify-content-end align-items-center">
                    <form action="{{ route('officers.index') }}" method="GET" class="input-group input-group-sm me-2" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search belt, name, rank..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-default">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('officers.create') }}" class="btn btn-sm btn-primary text-nowrap">
                        <i class="bi bi-person-plus-fill"></i> Register Officer
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif
                
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Belt Number</th>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Current Posting</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($officers as $officer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $officer->belt_number }}</strong></td>
                                <td>{{ $officer->rank }}</td>
                                <td>{{ $officer->name }}</td>
                                <td>{{ $officer->posting ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('officers.edit', $officer) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('officers.destroy', $officer) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this officer?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No officers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($officers->hasPages())
                <div class="card-footer clearfix">
                    {{ $officers->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
