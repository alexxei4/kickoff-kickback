@extends('layouts.frontendlayout')

@section('title', 'All Products')

@section('content')
    <h1>All Products</h1>

    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                <p>Price: ${{ $product->cost }}</p>
                <p>Description: {{ $product->description }}</p>
                @if ($product->image)
                    <img src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="{{ $product->name }}" style="width: 200px;">
                @else
                    <p>No image available</p>
                @endif
                <!-- Add other product details if needed -->
            </li>
        @endforeach
    </ul>
@endsection