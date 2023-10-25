@extends('layouts.frontendlayout')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Description: {{ $product->description }}</p>
    <p>Price: {{ $product->cost }}</p>
    <p>SKU: {{ $selectedVariation->sku }}</p>
    
    @if ($product->image)
        <img src="{{ asset('/public/assets/uploads/product/' . $product->image) }}" alt="Product Image" style="width: 300px;">
    @else
        <p>No image available</p>
    @endif
    <label for="variation">Select Size:</label>
    <select name="variation" id="variation">
        @foreach ($product->variations as $variation)
            <option value="{{ $variation->id }}">{{ $variation->size }}</option>
        @endforeach
    </select>

    
    

@endsection



<script>
    document.getElementById('variation').addEventListener('change', function() {
        var VariationId = this.value;

       
    });
</script>
