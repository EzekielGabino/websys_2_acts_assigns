@php 
  $role = Auth::user()->role; 
  $username = Auth::user()->username;

@endphp

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ $role === 'admin' || $role === 'manager' ? route($role.'.dashboard') 
    : route('staff.products')}}"><img src="{{ asset('images/bapnroll_logo.jpg') }}" alt="logo" width="200" height="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        {{-- Welcome username --}}
        <li class="nav-item">
            <span class="navbar-text me-3">
                Welcome, {{ $username }} ({{ ucfirst($role) }})
            </span>
        </li>

        {{-- Dashboard (everyone) --}}
        @if ($role === 'admin' || $role === 'manager')
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('*dashboard') ? 'active' : '' }}"
              href="{{ route($role . '.dashboard') }}">
              Dashboard
            </a>
        </li>
        @endif
        
        {{-- Products (everyone) --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('products') || request()->routeIs('beverages') || request()->routeIs('discounts') ? 'active' : '' }}"
              href="{{ route('products') }}">
              Products
            </a>
        </li>

        {{-- Orders (everyone) --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('orders.pending') || 
            request()->routeIs('orders.done') || 
            request()->routeIs('orders.cancel') ? 'active' : '' }}"
              href="{{ route('orders.pending') }}">
              Orders
            </a>
        </li>

        {{-- Admin only --}}
        @if($role === 'admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}"
                  href="{{ route('users') }}">
                  Users
                </a>
            </li>
        @endif
        
        {{-- Logout --}}
        <li class="nav-item">
            <form method="POST" action=" {{ route('logout') }}">
                @csrf
                <button class="nav-link btn btn-link">Logout</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>