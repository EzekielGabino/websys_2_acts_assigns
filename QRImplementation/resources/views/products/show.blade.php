@extends('layouts.app')

@section('content')

<h3>{{ $product->name }}</h3>

<p>{{ $product->description }}</p>
<p><strong>Price:</strong> {{ $product->price }}</p>

<div class="mt-3">
    {!! $qr !!}
</div>

<a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>

@endsection