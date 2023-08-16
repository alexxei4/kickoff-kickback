@extends('layouts.frontendlayout')

@section('content')
    <h1>My Wishlist</h1>

    @if ($wishlistItems->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <ul>
            @foreach ($wishlistItems as $item)
                <li>{{ $item->name }} - {{ $item->description }}</li>
            @endforeach
        </ul>
    @endif
@endsection
