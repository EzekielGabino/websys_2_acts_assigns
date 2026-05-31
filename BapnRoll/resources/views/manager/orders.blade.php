@extends('layouts.master')

@section('title', 'Orders')

@section('content')

<div class="orders-page">

    {{-- LEFT: Sidebar --}}
    <div class="products-sidebar">
        <p class="sidebar-label">Filter</p>
        <a href="{{ route('orders.pending') }}"
           class="cat-item {{ request()->routeIs('orders.pending') ? 'active' : '' }}">
            <span class="status-dot dot-pending"></span> Pending
        </a>
        <a href="{{ route('orders.done') }}"
           class="cat-item {{ request()->routeIs('orders.done') ? 'active' : '' }}">
            <span class="status-dot dot-completed"></span> Completed
        </a>
        <a href="{{ route('orders.cancel') }}"
           class="cat-item {{ request()->routeIs('orders.cancel') ? 'active' : '' }}">
            <span class="status-dot dot-cancelled"></span> Cancelled
        </a>
    </div>

    {{-- MAIN: Orders --}}
    <div class="products-main">

        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        @php
            $pageStatus = $orders->first()->status ?? 'Orders';
        @endphp

        {{-- Top bar with title + export button --}}
        <div class="products-topbar">
            <p class="main-title">{{ $pageStatus }} Orders</p>

            @if(request()->routeIs('orders.done'))
                <a href="{{ route('orders.export.pdf') }}" class="btn-outline-peach">
                    <i class="bi bi-download"></i> Export PDF
                </a>
            @endif
        </div>

        @if($orders->isEmpty())
            <p class="empty-order">No {{ strtolower($pageStatus) }} orders found.</p>
        @else
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-card">

                        {{-- Card Header --}}
                        <div class="order-card-header">
                            <div class="order-meta">
                                <span class="order-num">Order #{{ $order->id }}</span>
                                <span class="order-user">
                                    <i class="bi bi-person"></i> {{ $order->user->name }}
                                </span>
                            </div>

                            @if($order->status == 'pending')
                                <span class="status-badge badge-pending">Pending</span>
                            @elseif($order->status == 'Completed')
                                <span class="status-badge badge-completed">Completed</span>
                            @elseif($order->status == 'Cancelled')
                                <span class="status-badge badge-cancelled">Cancelled</span>
                            @endif
                        </div>

                        {{-- Card Body --}}
                        <div class="order-card-body">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->products->name ?? 'No Product' }}</td>
                                            <td>{{ $item->quantity }}x</td>
                                            <td>₱{{ number_format($item->price, 2) }}</td>
                                            <td class="text-end">₱{{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Card Footer --}}
                            <div class="order-footer">
                                <div class="order-total">
                                    Total: <span>₱{{ number_format($order->total, 2) }}</span>
                                </div>

                                <div class="order-btns">
                                    @if($order->status == 'pending')
                                        <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                            <input type="hidden" name="total"   value="{{ $order->total }}">
                                            <button type="submit" class="btn-order btn-done">
                                                <i class="bi bi-check-lg"></i> Done
                                            </button>
                                        </form>

                                        <form action="{{ route('orders.cancelled', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                            <input type="hidden" name="total"   value="{{ $order->total }}">
                                            <button type="submit" class="btn-order btn-cancel-ord">
                                                <i class="bi bi-x-lg"></i> Cancel
                                            </button>
                                        </form>

                                    @elseif($order->status == 'Completed' || $order->status == 'Cancelled')
                                        <form action="{{ route('orders.delete', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-order btn-delete">
                                                <i class="bi bi-trash"></i> Delete Order
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>

@endsection