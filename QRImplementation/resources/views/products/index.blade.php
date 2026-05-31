@extends('layouts.app')

@section('content')

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

<div class="row">
@foreach($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card p-2 text-center">
            <h5>{{ $product->name }}</h5>

            {!! $product->qr !!}

            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm mt-2">View</a>
            <a href="{{ route('products.edit', $product->id) }}" 
                    class="btn btn-warning btn-sm mt-2">
                    Edit
                </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm mt-2">Delete</button>
            </form>
        </div>
    </div>
@endforeach
</div>

@endsection