@extends('layouts.frontendlayout')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Description: {{ $product->description }}</p>
    <p>Price: {{ $product->cost }}</p>
    
    @if ($product->image)
        <img src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="Product Image" style="width: 300px;">
    @else
        <p>No image available</p>
    @endif

@endsection
