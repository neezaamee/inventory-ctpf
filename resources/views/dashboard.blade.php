@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h3>{{ $totalItems }}</h3>
                    <p>Total Stock Items</p>
                  </div>
                  <i class="small-box-icon bi bi-box-seam"></i>
                  <a href="{{ route('items.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              
              <!-- Total Categories -->
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>{{ $totalCategories }}</h3>
                    <p>Categories</p>
                  </div>
                  <i class="small-box-icon bi bi-tags"></i>
                  <a href="{{ route('categories.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>

              <!-- Total Officers -->
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>{{ $totalOfficers }}</h3>
                    <p>Registered Officers</p>
                  </div>
                  <i class="small-box-icon bi bi-person-badge"></i>
                  <a href="{{ route('officers.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>

              <!-- Transactions -->
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>{{ $recentTransactions }}</h3>
                    <p>Total Transactions</p>
                  </div>
                  <i class="small-box-icon bi bi-arrow-left-right"></i>
                  <a href="{{ route('transactions.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
</div>
<!-- /.row -->

@if($lowStockItems->count() > 0)
<div class="row">
  <div class="col-12">
    <div class="card mb-4 border-danger border-2">
      <div class="card-header text-bg-danger">
        <h3 class="card-title"><i class="bi bi-exclamation-triangle-fill"></i> Low Stock Alerts</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped table-hover m-0">
          <thead>
            <tr>
              <th>Item Name</th>
              <th>Category</th>
              <th>Variation / Size</th>
              <th>Current Stock</th>
              <th>Min Threshold</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lowStockItems as $alertItem)
            <tr>
              <td><strong>{{ $alertItem->item->name }}</strong></td>
              <td>{{ $alertItem->item->category->name }}</td>
              <td><span class="badge text-bg-info">{{ $alertItem->value }}</span></td>
              <td class="text-danger fw-bold">{{ $alertItem->stock_quantity }}</td>
              <td>{{ $alertItem->item->min_stock_threshold }}</td>
              <td>
                <a href="{{ route('transactions.create_in', ['item_variation_id' => $alertItem->id]) }}" class="btn btn-sm btn-outline-success">
                  <i class="bi bi-plus-circle"></i> Restock
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="bi bi-clock-history"></i> Recent Transactions</h3>
                <div class="card-tools">
                    <a href="{{ route('transactions.index') }}" class="btn btn-tool btn-sm"> 
                        <i class="bi bi-list"></i> View All
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Transaction Type</th>
                            <th>Officer</th>
                            <th>Item & Variation</th>
                            <th>Qty</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivities as $activity)
                        <tr>
                            <td>
                                @if($activity->type == 'in')
                                    <span class="badge text-bg-success">Stock In</span>
                                @elseif($activity->type == 'out')
                                    <span class="badge text-bg-warning">Issuance</span>
                                @else
                                    <span class="badge text-bg-info">Receive Back</span>
                                @endif
                            </td>
                            <td>{{ $activity->officer->name ?? 'N/A' }}</td>
                            <td>{{ $activity->itemVariation->item->name }} ({{ $activity->itemVariation->value }})</td>
                            <td><strong>{{ $activity->quantity }}</strong></td>
                            <td>{{ $activity->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No recent transactions.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
