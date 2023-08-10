@extends('layouts.frontendlayout')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Welcome to KickOffKickBack!</h1>

        <div class="mb-4">
            <label for="categoryFilter" class="block text-gray-700 font-bold mb-2">Filter by Category:</label>
            <select id="categoryFilter" class="border rounded px-3 py-2 w-full">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
         <div class="grid grid-cols-3 gap-4" id="filteredProducts">
            
            <!-- Loop through and display the products here -->
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
                </div>
            @endforeach
        </div>
         
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoryFilter').change(function() {
                var categoryId = $(this).val();

                $.get('{{ route("frontend.filter.products") }}', { category_id: categoryId }, function(data) {
                    $('#filteredProducts').html(data.html);
                });
            });
        });
    </script>
@endsection

