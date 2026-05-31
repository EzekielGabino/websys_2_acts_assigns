@extends('layouts.app')

@section('content')

<h3>Edit Product</h3>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Name -->
    <input 
        type="text" 
        name="name" 
        value="{{ $product->name }}" 
        class="form-control mb-2"
        placeholder="Name"
    >

    <!-- Description -->
    <input 
        type="text" 
        name="description" 
        value="{{ $product->description }}" 
        class="form-control mb-2"
        placeholder="Description"
    >

    <!-- Price -->
    <input 
        type="number" 
        name="price" 
        value="{{ $product->price }}" 
        class="form-control mb-2"
        placeholder="Price"
    >

    <button class="btn btn-success">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>

</form>

@endsection