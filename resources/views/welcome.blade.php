@extends('layouts.frontendlayout')

@section('title', 'Welcome to My Store')

@section('content')
    <div class="container mx-auto py-8 text-center">
        <h1 class="text-4xl font-semibold text-black-600">Welcome to KickOff-KickBack</h1>

       

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($products as $product)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('assets/uploads/product/'.$product->image) }}" class="d-block w-100 carousel-image" alt="{{ $product->name }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

       
        <div class="owl-carousel owl-theme">
            @foreach($products as $product)
                <div class="item">
                    <img src="{{ asset('/public/assets/uploads/product/'.$product->image) }}" alt="{{ $product->name }}" class="carousel-image">
                </div>
            @endforeach
        </div>
    </div>

     
        <div class="my-8">
            <h2 class="text-2xl font-semibold">Featured Products</h2>
            <div class="flex items-center space-x-4">
                @foreach($products as $product)
                    @if($product->is_featured)
                        <div class="w-1/5">
                            <a  style="text-decoration:none; color:black;" href="{{ route('frontend.product.show', $product->id) }}">
                            <img src="{{ asset('assets/uploads/product/'.$product->image) }}" alt="{{ $product->name }}" class="carousel-image">
                            <h3 class="text-lg">{{ $product->name }}</h3>
                           
                            <p>Price: ${{ $product->cost }}</p>
                             </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

      

       
        <script>
            $(document).ready(function(){
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        600: {
                            items: 3,
                            nav: false
                        },
                        1000: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        </script>
    </div>

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
@endsection

<style>
  
    .carousel-image {
        height: 200px; 
        object-fit: cover; 
    }
</style>
