@extends('layouts.frontendlayout') {{-- Assuming you have a layout file --}}

@section('content')
    <h1>My Wishlist</h1>
    
    @foreach ($wishlistItems as $item)
        <div>
            <h2>{{ $item->name }}</h2>
            <p>{{ $item->description }}</p>
            <img src="{{ asset('/public/assets/uploads/product/' . $item->image) }}" alt="{{ $item->name }}" width="150">
            <form action="{{ route('wishlist.remove') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $item->id }}">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </div>
    @endforeach
@endsection
