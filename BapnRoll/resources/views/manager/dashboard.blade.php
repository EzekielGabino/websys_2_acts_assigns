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
                            @foreach ($products as $product)
                                <tr>
                                    <td class="thumb-cell">
                                        <img src="{{ asset('products/'.$product->pic) }}" alt="{{ $product->name }}" width="42" height="42" class="product-thumb-img">
                                    </td>
                                    <td>
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-cat">{{ $product->category }}</div>
                                    </td>
                                    <td class="text-end pe-3">
                                        <span class="stock-badge">{{ $product->stock }} left</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="row mb-4">

        {{-- Sales Bar Chart --}}
        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-bar-chart me-1"></i> Monthly Sales</span>
                    <span class="text-muted" style="font-size: 13px;">{{ now()->year }}</span>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Products Doughnut Chart --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-trophy me-1"></i> Top Products
                </div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('js/chart.umd.min.js') }}"></script>
<script>
    // --- Sales Bar Chart ---
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Sales (₱)',
                data: @json($monthlySales),
                backgroundColor: 'rgba(216, 90, 48, 0.7)',
                borderColor: 'rgba(216, 90, 48, 1)',
                borderWidth: 1,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => '₱' + ctx.parsed.y.toLocaleString()
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: val => '₱' + val.toLocaleString()
                    }
                }
            }
        }
    });

    // --- Top Products Doughnut Chart ---
    const topCtx = document.getElementById('topProductsChart').getContext('2d');
    new Chart(topCtx, {
        type: 'doughnut',
        data: {
            labels: @json($topProducts->pluck('name')),
            datasets: [{
                data: @json($topProducts->pluck('qty')),
                backgroundColor: [
                    'rgba(216, 90, 48, 0.8)',
                    'rgba(216, 90, 48, 0.6)',
                    'rgba(216, 90, 48, 0.4)',
                    'rgba(240, 160, 100, 0.8)',
                    'rgba(240, 160, 100, 0.5)',
                ],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 11 }, boxWidth: 14 }
                },
                tooltip: {
                    callbacks: {
                        label: ctx => ctx.label + ': ' + ctx.parsed + ' sold'
                    }
                }
            }
        }
    });
</script>

@endsection