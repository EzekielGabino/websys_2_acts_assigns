@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">

    {{-- Low / No Stock --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-box-seam me-1"></i> Out of Stock
                </div>
                <div class="card-body p-0">
                    @if (!isset($product) || $product->isEmpty())
                        <p class="text-peach px-3 py-3 mb-0">0 Products</p>
                    @else
                        <table class="dashboard-table w-100">
                            @foreach ($product as $prod)
                                <tr>
                                    <td class="thumb-cell">
                                        <img src="{{ asset('products/'.$prod->pic) }}" alt="{{ $prod->name }}" width="42" height="42" class="product-thumb-img">
                                    </td>
                                    <td>
                                        <div class="product-name">{{ $prod->name }}</div>
                                        <div class="product-cat">{{ $prod->category }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-exclamation-triangle me-1"></i> Low Stock
                </div>
                <div class="card-body p-0">
                    @if (!isset($products) || $products->isEmpty())
                        <p class="text-peach px-3 py-3 mb-0">0 Products</p>
                    @else
                        <table class="dashboard-table w-100">
                            @foreach ($products as $prods)
                                <tr>
                                    <td class="thumb-cell">
                                        <img src="{{ asset('products/'.$prods->pic) }}" alt="{{ $prods->name }}" width="42" height="42" class="product-thumb-img">
                                    </td>
                                    <td>
                                        <div class="product-name">{{ $prods->name }}</div>
                                        <div class="product-cat">{{ $prods->category }}</div>
                                    </td>
                                    <td class="text-end pe-3">
                                        <span class="stock-badge">{{ $prods->stock }} left</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Sales --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-bar-chart me-1"></i> Sales
                </div>
                <div class="card-body">
                    <form action="{{ route('manager.dashboard') }}" method="GET" class="filter-row mb-3">
                        @csrf

                        <select name="month" id="month" class="filter-select">
                            <option value="">Select Month</option>
                            <option value="1"  {{ request('month') == 1  ? 'selected' : '' }}>January</option>
                            <option value="2"  {{ request('month') == 2  ? 'selected' : '' }}>February</option>
                            <option value="3"  {{ request('month') == 3  ? 'selected' : '' }}>March</option>
                            <option value="4"  {{ request('month') == 4  ? 'selected' : '' }}>April</option>
                            <option value="5"  {{ request('month') == 5  ? 'selected' : '' }}>May</option>
                            <option value="6"  {{ request('month') == 6  ? 'selected' : '' }}>June</option>
                            <option value="7"  {{ request('month') == 7  ? 'selected' : '' }}>July</option>
                            <option value="8"  {{ request('month') == 8  ? 'selected' : '' }}>August</option>
                            <option value="9"  {{ request('month') == 9  ? 'selected' : '' }}>September</option>
                            <option value="10" {{ request('month') == 10 ? 'selected' : '' }}>October</option>
                            <option value="11" {{ request('month') == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ request('month') == 12 ? 'selected' : '' }}>December</option>
                        </select>

                        <select name="year" id="year" class="filter-select">
                            <option value="">Select Year</option>
                            <option value="2026" {{ request('year') == 2026 ? 'selected' : '' }}>2026</option>
                            <option value="2025" {{ request('year') == 2025 ? 'selected' : '' }}>2025</option>
                        </select>

                        <button type="submit" class="btn btn-peach">Filter</button>
                    </form>

                    @if(isset($month))
                        <div class="sales-month">{{ $month }}, {{ $year }}</div>
                        <div class="sales-amount">{{ $sales }}</div>
                    @else
                        <p class="text-peach mb-0">No Sales</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection