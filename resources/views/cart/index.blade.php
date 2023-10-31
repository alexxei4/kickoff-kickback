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
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price * $item->quantity }}</td>
                        <td>
                            <button class="btn btn-danger removeFromCartButton" data-product-id="{{ $item->product_id }}">
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        
        <div>
            <h4>Promo Code:</h4>
            <input type="text" id="PromoCode" class="border rounded px-3 py-2 w-1/4">
            <p>
                // 'GIVEMECOFFEE' , makes final price 1$
                // 'GIVEMELATTE' , makes final price 2$
                // 'GIVEMEFRAPPE' , makes final price 3$
                // 'PRETTYPENNY' , makes final price 0.01$
                // 'NOGST4ME' , removes tax 
                // '5FINGERDISCOUNT' , makes it free
                // '99%OFF' , 99% off on order
            </p>
            <label for="Province" class="block text-gray-700 font-bold mb-2">Province :</label>
            <select id="Province" class="border rounded px-3 py-2 w-full">
                <option value="Ontario">Ontario</option>
                <option value="Quebec">Quebec</option>
                <option value="Saskatchewan">Saskatchewan</option>
                <option value="PEI">PEI</option>
                <option value="Manitoba">Manitoba</option>
                <option value="Alberta">Alberta</option>
                <option value="British Columbia">British Columbia</option>
                <option value="Nova Scotia">Nova Scotia</option>
                <option value="Yukon">Yukon</option>
                <option value="NWT">Northwest Territories</option>
                <option value="Newfoundland">Newfoundland</option>
                <option value="Nunavut">Nunavut</option>


             
            </select>
            <br>
            <h4>Subtotal: ${{ $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            }) }}</h4>
            <br>
            <h4>Shipping:</h4>
            <br>
            <h4>Tax: </h4>
            <br>
            <h4>Total: </h4>
            <br>
            <button class="btn btn-success">Checkout</button>
        </div>
    @endif
@endsection 