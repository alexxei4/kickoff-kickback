@extends('frontendlayout')

@section('title', 'Products')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        <!-- Loop through your products and display them here -->
        @foreach($products as $product)
            <div class="bg-white p-4 shadow">
                <h2 class="text-xl font-semibold text-black-600">{{ $product->name }}</h2>
                <p class="text-gray-600">{{ $product->description }}</p>
                <p class="mt-2 font-bold text-black-600">Price: ${{ $product->cost }}</p>
                @if ($product->image)
                    <img src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="Product Image" style="width: 300px;">
                @else
                    <p>No image available</p>
                @endif
            </div>
        @endforeach
    </div>
@endsection
