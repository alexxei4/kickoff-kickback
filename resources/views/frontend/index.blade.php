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
            <label for="productNameFilter" class="block text-gray-700 font-bold mb-2">Search by Name:</label>
            <input type="text" id="productNameFilter" class="border rounded px-3 py-2 w-full">
            <label for="brandNameFilter" class="block text-gray-700 font-bold mb-2">Search by BrandName:</label>
            <input type="text" id="brandNameFilter" class="border rounded px-3 py-2 w-full">
            <label for="minCostFilter" class="block text-gray-700 font-bold mb-2">Min:</label>
            <input type="text" id="minCostFilter" class="border rounded px-3 py-2 w-full">
            <label for="maxCostFilter" class="block text-gray-700 font-bold mb-2">Max:</label>
            <input type="text" id="maxCostFilter" class="border rounded px-3 py-2 w-full">
        </div>
        
        <div  id="filteredProducts"> 
     
            @include('frontend._products-list', ['products' => $products])

       
        </div>
         
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoryFilter').change(function() {
                filterProducts();
            });
    
            $('#productNameFilter').keyup(function() {
                filterProducts();
            });
    
            $('#minCostFilter, #maxCostFilter').change(function() {
                filterProducts();
            });
    
            $('#brandNameFilter').keyup(function() {
                filterProducts();
            });
    
            function filterProducts() {
                var categoryId = $('#categoryFilter').val();
                var searchQuery = $('#productNameFilter').val();
                var minCost = $('#minCostFilter').val();
                var maxCost = $('#maxCostFilter').val();
                var brandName = $('#brandNameFilter').val(); 
    
                $.get('{{ route("frontend.filter.products") }}', {
                    category_id: categoryId,
                    search: searchQuery,
                    min_cost: minCost,
                    max_cost: maxCost,
                    brand_name: brandName 
                }, function(data) {
                    $('#filteredProducts').html(data.html);
                });
            }
        });
    </script>
    
@endsection

