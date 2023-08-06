@extends('layouts.frontendlayout')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Welcome to KickOffKickBack!</h1>

        <div class="grid grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="p-4 border rounded-lg">
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="mt-2 text-gray-800">${{ $product->cost }}</p>
                    @if ($product->image)
                        <img src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 rounded-lg" style="width: 200px;">
                    @else
                        <p class="mt-4">No image available</p>
                    @endif
                    <!-- You can include more product details here -->
                </div>
            @endforeach
        </div>
    </div>
@endsection
