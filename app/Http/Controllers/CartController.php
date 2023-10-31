<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /*
    public function calculateTaxAndShipping(Request $request)
    {
    $provinceData = config("provinces.$province");
    $province = $request->input('province');

   
    $provinceData = config("provinces.$province");

    if (!$provinceData) {
       
    }

    $taxRate = $provinceData['tax_rate'];
    $shippingCost = $provinceData['shipping_cost'];

  
    $subtotal = 
    $tax = $subtotal * $taxRate;
    $total = $subtotal + $tax + $shippingCost;

    return view('cart', [
        'taxRate' => $taxRate,
        'shippingCost' => $shippingCost,
        'total' => $total,
    ]);
    }
`    */
    
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();     
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);
    
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        $userId = auth()->user()->id;
    
        Cart::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->cost,
        ]);
    
        return response()->json(['message' => 'Product added to cart']);
    }
    


    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = auth()->user()->id; 

       
        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }

}
