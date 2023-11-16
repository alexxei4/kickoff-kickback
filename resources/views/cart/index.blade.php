<html lang="en">
<head>
    <title>Your Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DomContent Loaded');
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            document.querySelectorAll('.removeFromCart').forEach(function (button) {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    removeFromCart(productId, csrfToken);
                });
            });
            document.querySelectorAll('.changeQuantity').forEach(function (button) {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    const changeType = this.getAttribute('data-change');
                    changeQuantity(productId, changeType, csrfToken);
                    
                });
            });
            getCartData(csrfToken); 
        });

        function changeQuantity(productId, changeType, csrfToken) {
            console.log('Quantity Changed');
            fetch('/cart/change-quantity', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    change_type: changeType
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                getCartData(csrfToken);
            })
            .catch(error => console.error('Error:', error));
        }

        function removeFromCart(productId, csrfToken) {
            console.log('Item Removed');
            fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                getCartData(csrfToken);
            })
            .catch(error => console.error('Error:', error));
        }

        function getCartData(csrfToken) {
            console.log('Item Fetched');
            fetch('/cart/data', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Updated cart data:', data);
                updateTotals(data);
            })
            .catch(error => console.error('Error:', error));
        }
        function updateTotals(data) {
            console.log('Total Updated; ' , data);
              const subtotal = parseFloat('{{ $cartItems->sum(function ($item) { return $item->price * $item->quantity; }) }}');
            const taxRate = 0.13;
            const tax = subtotal * taxRate;
            const total = subtotal + tax;

            document.getElementById('Tax').innerText = `Tax: $${tax.toFixed(2)}`;
            document.getElementById('Total').innerText = `Total: $${total.toFixed(2)}`;

        }
    </script>

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
                            <td>&nbsp; &nbsp;<button class="btn btn-secondary changeQuantity" data-product-id="{{ $item->product_id }}" data-change="decrease"> - </button>&nbsp;&nbsp;{{ $item->quantity }}&nbsp;&nbsp;<button class="btn btn-secondary changeQuantity" data-product-id="{{ $item->product_id }}" data-change="increase">+</button>&nbsp;&nbsp;</td>
                            <td>{{ $item->price * $item->quantity }}</td>
                            <td>
                                <button class="btn btn-danger removeFromCart" data-product-id="{{ $item->product_id }}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                <h4>Subtotal: ${{ $cartItems->sum(function ($item) { return $item->price * $item->quantity; }) }}</h4>
                <br>
                <h4 id="Tax">Tax: $0.00</h4>
                <br>
                <h4 id="Total">Total: $0.00</h4>
                <br>
                <button class="btn btn-success">Checkout</button>
            </div>
        @endif
    @endsection

</body>
</html>
