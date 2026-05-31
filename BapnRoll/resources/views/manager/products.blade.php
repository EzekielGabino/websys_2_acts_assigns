@extends('layouts.master')

@section('title', 'Products')

@section('content')

@if(session('success'))
    <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
@endif

<div class="products-page">

    {{-- LEFT: Sidebar --}}
    <div class="products-sidebar">
        <p class="sidebar-label">Categories</p>
        <a href="{{ route('products') }}"
           class="cat-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">
            <i class="bi bi-bowl-hot"></i> Foods
        </a>
        <a href="{{ route('beverages') }}"
           class="cat-item {{ request()->routeIs('admin.beverages') ? 'active' : '' }}">
            <i class="bi bi-cup-straw"></i> Beverages
        </a>
    </div>

    {{-- CENTER: Products --}}
    <div class="products-main">
        <div class="products-topbar">
            <h5 class="topbar-title">Products</h5>
            <button type="button" class="btn-peach" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg"></i> Add Product
            </button>
            <a href="{{ route('products.export.pdf') }}" class="btn-outline-peach">
                <i class="bi bi-download"></i> Export PDF
            </a>
        </div>

        <div class="products-grid">
            @foreach($products as $product)
                <div class="prod-card">
                    <div class="prod-img-wrap">
                        <img src="{{ asset('products/'.$product->pic) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="prod-body">
                        <div class="prod-name">{{ $product->name }}</div>
                        <div class="prod-price">₱{{ number_format($product->price, 2) }}</div>

                        @if ($product->size)
                            <div class="prod-meta">Size: {{ $product->size }}</div>
                        @endif

                        @if ($product->stock == 0)
                            <span class="stock-badge stock-out">Out of stock</span>
                        @elseif ($product->stock <= 5)
                            <span class="stock-badge stock-low">
                                <i class="bi bi-exclamation-triangle"></i> Low · {{ $product->stock }}x
                            </span>
                        @else
                            <div class="prod-meta">Stock: {{ $product->stock }}x</div>
                        @endif
                        
                        @if ($product->stock > 0)
                            
                        
                        <div class="prod-actions">
                            <button
                                class="act-btn act-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#editProductModal"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}"
                                data-category="{{ $product->category }}"
                                data-size="{{ $product->size }}"
                                data-pic="{{ $product->pic }}"
                            >
                                <i class="bi bi-pencil"></i> Edit
                            </button>

                            <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="act-btn act-del" type="submit">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>

                            <form action="{{ route('orders.create') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="act-btn act-add" type="submit">
                                    <i class="bi bi-plus-lg"></i> Order
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- RIGHT: Order Summary --}}
    <div class="order-panel">
        <p class="sidebar-label"><i class="bi bi-cart3"></i> Order Summary</p>

        @php $orders = session('orders', []); @endphp

        @if(count($orders) > 0)
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                @php $grandTotal = 0; @endphp

                @foreach($orders as $order)
                    @php $grandTotal += $order['total']; @endphp

                    <input type="hidden" name="product_name[]" value="{{ $order['product_name'] }}">
                    
                    <input type="hidden" name="orders_price[]"        value="{{ $order['price'] }}">
                    <input type="hidden" name="total[]"        value="{{ $order['total'] }}">

                    <div class="order-item">
                        <div class="order-item-name">{{ $order['product_name'] }}</div>
                        <div class="order-row"><span>Category</span><span>{{ $order['product_cat'] }}</span></div>
                        {{-- <div class="order-row"><span>Qty</span><span>{{ $order['quantity'] }}x</span></div> --}}
                        <input type="number" name="quantity[]"     value="{{ $order['quantity'] }}">
                        <div class="order-row"><span>Price</span><span>₱{{ number_format($order['price'], 2) }}</span></div>
                        <div class="order-row"><span>Total</span><span>₱{{ number_format($order['total'], 2) }}</span></div>
                    </div>
                @endforeach

                <hr class="order-divider">
                <div class="order-total">
                    <span>Total</span>
                    <span>₱{{ number_format($grandTotal, 2) }}</span>
                </div>

                <button type="submit" class="btn-checkout">
                    <i class="bi bi-check-lg"></i> Checkout
                </button>
            </form>

            <form action="{{ route('order.cancel') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn-cancel">
                    <i class="bi bi-x-lg"></i> Cancel Order
                </button>
            </form>

        @else
            <p class="empty-order">No items selected</p>
        @endif
    </div>

</div>

{{-- ADD Modal --}}
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="Foods"      {{ old('category')=='Foods'      ? 'selected' : '' }}>Foods</option>
                            <option value="Beverages"  {{ old('category')=='Beverages'  ? 'selected' : '' }}>Beverages</option>
                        </select>
                        @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Size <span class="text-muted">(optional)</span></label>
                        <input type="text" name="size" class="form-control" value="{{ old('size') }}">
                        @error('size') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01">
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                        @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="pic" class="form-control">
                        @error('pic') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-peach-modal">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT Modal --}}
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" id="edit_category" class="form-select">
                            <option value="Foods">Foods</option>
                            <option value="Beverages">Beverages</option>
                        </select>
                        @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Size <span class="text-muted">(optional)</span></label>
                        <input type="text" name="size" id="edit_size" class="form-control">
                        @error('size') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" id="edit_price" class="form-control" step="0.01">
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" id="edit_stock" class="form-control">
                        @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="pic" id="edit_pic" class="form-control">
                        @error('pic') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-peach-modal">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('editProductModal').addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;
        document.getElementById('edit_name').value     = btn.dataset.name;
        document.getElementById('edit_price').value    = btn.dataset.price;
        document.getElementById('edit_stock').value    = btn.dataset.stock;
        document.getElementById('edit_size').value     = btn.dataset.size ?? '';
        document.getElementById('edit_category').value = btn.dataset.category;
        document.getElementById('editForm').action     = "{{ url('/products/update/') }}/" + btn.dataset.id;
    });
</script>

@endsection