@extends('layouts.frontendlayout') 

@section('content')
    <h1>Your Cart</h1>
    
    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price * $item->quantity }}</td>
                        <td>
                            <button class="btn btn-danger removeFromCartButton" data-product-id="{{ $item->id }}">
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div>
            <h4>Total: ${{ Cart::getTotal() }}</h4>
            <button class="btn btn-success">Checkout</button>
        </div>
    @endif
@endsection
