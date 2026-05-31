@extends('layouts.app')

@section('content')

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Name" class="form-control mb-2">
    <input type="text" name="description" placeholder="Description" class="form-control mb-2">
    <input type="number" name="price" placeholder="Price" class="form-control mb-2">

    <button class="btn btn-success">Save</button>
</form>

@endsection