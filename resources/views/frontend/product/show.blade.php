@extends('layouts.frontendlayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KickOffKickBack</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        
        
        
        
    </head>
    <body>
        <section class="py-5">
            <button class="btn btn-outline-dark flex-shrink-0" type="button" href="/">
                <i class="fa-solid fa-arrow-left-long"></i>
                <a class="nav-link" href="/">Back To Products</a>
            </button>
            <div class="container px-4 px-lg-5 my-5">
                
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('/public/assets/uploads/product/' . $product->image) }}" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: {{ $product->sku }}</div>
                        <div class="small mb-1">Brand: {{ $product->brand }}</div>
                        <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                        <div class="fs-5 mb-5">
                            <span> $ {{ $product->cost}}</span>
                        </div>
                        <p class="lead">{{ $product->description}}</p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 3rem" />
                            <button id="addToCartButton" class="btn btn-outline-dark flex-shrink-0" type="button" data-product-id="{{ $product->id }}">
                                <i class="bi-cart-fill me-1"></i>
                                Add to Cart
                            </button>


                            
                            &nbsp;
                            <button id="addToWishlistButton" class="btn btn-outline-dark flex-shrink-0" type="button" data-product-id="{{ $product->id }}">
                                <i class="bi bi-heart"></i> Add to Wishlist
                            </button>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                    
                            <ul>
                                @if(isset($variations) && $variations->count() > 0)
                                <h3>Variations:</h3>
                                    @foreach ($variations as $variation)
                                        <li>
                                            <strong>Size:</strong> {{ $variation->size }}, 
                                            <strong>Color:</strong> {{ $variation->color }}, 
                                            <strong>SKU:</strong> {{ $variation->sku }}
                                        </li>
                                    @endforeach
                                @else
                                    <p></p>
                                @endif
                            </ul>

                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    
                    
                   
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $(document).ready(function() {
                @auth
                $('#addToWishlistButton').on('click', function() {
                    var productId = $(this).data('product-id');
                    $.post('{{ route('wishlist.add') }}', { product_id: productId }, function(response) {
                        alert(response.message);
                    });
                });
                @else
                $('#addToWishlistButton').on('click', function() { 
                    window.location.href = '{{ route('login') }}';
                });
                @endauth
            });
            $(document).ready(function() {
                @auth
                $('#addToCartButton').on('click', function() {
                    var productId = $(this).data('product-id');
                    var quantity = $('#inputQuantity').val(); 
                    $.post('{{ route('cart.add') }}', { product_id: productId, quantity: quantity }, function(response) {
                        alert(response.message);
                    });
                });
                @else
                $('#addToCartButton').on('click', function() { 
                    window.location.href = '{{ route('login') }}';
                });
                @endauth
            });
          

        </script>
    </body>
</html>
@endsection


