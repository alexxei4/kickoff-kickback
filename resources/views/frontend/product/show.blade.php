@extends('layouts.frontendlayout')

@section('content')
<a href="{{ route('frontend.index') }}" class="btn btn-lg text-center">
    <span>
        <i class="fas fa-arrow-left fa-3x" style="width: 48px; height: 56px;"></i>
    </span>
</a>
    <div class="flex">
        <div class="w-1/3">
            <!-- Product image and other content -->
            <img src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 rounded-lg" style="width: 200px;">
            <!-- Other content related to the product -->
        </div>
        <div class="w-2/3 p-4 border rounded-lg">
            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="mt-2 text-gray-800">${{ $product->cost }}</p>
            <!-- Display the quantity and brand -->
            <p class="mt-2 text-gray-800">Quantity: {{ $product->quantity }}</p>
            <p class="mt-2 text-gray-800">Brand: {{ $product->brand }}</p>
            <div class="quantity-selector">
                <button class="quantity-change" data-action="increase">+</button>
                <button class="quantity-change" data-action="decrease">-</button>
                <br>
                <input type="number" class="quantity-input" value="1" min="1">
                
            </div>
            <button class="add-to-cart-btn">Add to Cart</button>
            <button class="add-to-wishlist-btn">Add to Wishlist</button>
        </div>

        
       
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Quantity Selector
        $('.quantity-change').on('click', function() {
            var action = $(this).data('action');
            var input = $(this).siblings('.quantity-input');
            var currentValue = parseInt(input.val());
            
            if (action === 'increase') {
                input.val(currentValue + 1);
            } else if (action === 'decrease' && currentValue > 1) {
                input.val(currentValue - 1);
            }
        });

        // Add to Cart Button
        $('.add-to-cart-btn').on('click', function() {
            var quantity = $('.quantity-input').val();
            // You can add more logic here to handle adding the item to the cart
            alert(quantity + ' items added to cart');
        });
    });
</script>

<style>
    .flex {
        display: flex;
    }

    .w-2/3 {
        width: 66.66%;
    }

    .w-1/3 {
        width: 33.33%;
    }
    button {
  margin-left: 50%;
  margin-top: 5%;
  border-radius: 50% !important;
  background-color: rgba(255, 255, 255, 0.2);
  color: white;
  border: none !important;
  padding: 30px 30px !important;
  -webkit-transition: background-color 1s, color 1s, -webkit-transform 0.5s;
     transition: background-color 1s, transform 0.5s;
}

button:hover {
  background-color: rgba(255, 255, 255, 0.8);
  color: black;
  -webkit-transform: translateX(-5px);
  -webkit-box-shadow: 5px 0px 18px 0px rgba(105,105,105,0.8);
  -moz-box-shadow: 5px 0px 18px 0px rgba(105,105,105,0.8);
  box-shadow: 5px 0px 18px 0px rgba(105,105,105,0.8);
}

/* Quantity Selector Styles */
.quantity-selector {
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-change {
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    padding: 5px 10px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin: 0 5px;
}

.quantity-change:hover {
    background-color: #ddd;
}

.quantity-input {
    width: 40px;
    text-align: center;
    border: 1px solid #ccc;
    padding: 5px;
    margin: 0 10px;
}

/* Add to Cart Button Styles */
.add-to-cart-btn {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-to-cart-btn:hover {
    background-color: #2980b9;
}
.add-to-wishlist-btn {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.add-to-wishlist-btn:hover {
    background-color: #c0392b;
}

</style>
