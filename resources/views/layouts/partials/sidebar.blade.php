<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="{{ url('/dashboard') }}" class="brand-link">
      <img src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">CTPF Inventory</span>
    </a>
  </div>
  <!--end::Sidebar Brand-->
  
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" data-accordion="false">
        
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">MANAGEMENT</li>
        
        @can('manage-inventory')
        @php
            $inventoryActive = request()->is('categories*') || request()->is('items*') || request()->is('item-variations*');
        @endphp
        <li class="nav-item {{ $inventoryActive ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $inventoryActive ? 'active' : '' }}">
            <i class="nav-icon bi bi-boxes"></i>
            <p>
              Inventory
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('items.index') }}" class="nav-link {{ request()->is('items*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Master Items</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('item-variations.index') }}" class="nav-link {{ request()->is('item-variations*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Stock & Variations</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan
        
        @can('manage-officers')
        <li class="nav-item">
          <a href="{{ route('officers.index') }}" class="nav-link {{ request()->is('officers*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-person-badge-fill"></i>
            <p>Officers</p>
          </a>
        </li>
        @endcan
        
        @can('manage-transactions')
        @php
            $transactionsActive = request()->is('transactions*');
        @endphp
        <li class="nav-item {{ $transactionsActive ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $transactionsActive ? 'active' : '' }}">
            <i class="nav-icon bi bi-arrow-left-right"></i>
            <p>
              Issue Records
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->is('transactions*') && !request()->routeIs('transactions.issued') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>All Transactions</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('transactions.issued') }}" class="nav-link {{ request()->routeIs('transactions.issued') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Issued Tracking</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan

        @can('view-reports')
        <li class="nav-header">REPORTS & ANALYTICS</li>

        <li class="nav-item">
          <a href="{{ route('reports.index') }}" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-earmark-bar-graph-fill"></i>
            <p>System Reports</p>
          </a>
        </li>
        @endcan

        @role('super-admin')
        <li class="nav-header">ADMINISTRATION</li>

        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>User Management</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-shield-lock-fill"></i>
            <p>Roles & Permissions</p>
          </a>
        </li>
        @endrole

      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
