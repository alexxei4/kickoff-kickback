<div class="grid grid-cols-2 gap-2 p-2">
    @foreach($products as $product)
    <a href="{{ route('frontend.product.show', $product) }}" style=" text-decoration: none;color: black;" >
        @if ($product->image)
            <img src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="{{ $product->name }}" class="mb-4 rounded-lg" style="width: 100%;">
        @else
            <p class="mb-4">No image available</p>
        @endif
        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
        <p class="text-gray-600">{{ $product->description }}</p>
        <p class="mt-2 text-gray-800">${{ $product->cost }}</p>
    </a>
    @endforeach
</div>
