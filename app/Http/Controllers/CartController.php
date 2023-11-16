<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// this si the controller for the shopping cart section in the store itself 
class CartController extends Controller
{
    // this displays the users items that were added to the shopping cart
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $cartItems = Cart::where('user_id', $user->id)->get();
        return view('cart.index', compact('cartItems'));
    }
    // this is for obtaining the data that the item had saved to cart 
    public function getCartData()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        return response()->json($cartItems);
    }
    // this is for adding items to the shopping cart
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
    // this is for removing items from the shopping cart 
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = auth()->user()->id;

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            $this->updateCartTotal();
            return response()->json(['message' => 'Product removed from cart']);
        }
      

        return response()->json(['error' => 'Product not found in cart']);
    }
    // this is responsible for the quantity feature in the shopping cart 
    public function changeQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $changeType = $request->input('change_type');
        $userId = auth()->user()->id;

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
          
            if ($changeType === 'increase') {
                $cartItem->quantity++;
            } elseif ($changeType === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity--;
            }

            $cartItem->save();
            $this->updateCartTotal();

            return response()->json(['message' => 'Quantity changed successfully']);
        }
        

        return response()->json(['error' => 'Product not found in cart']);
    }
    // this is responsible for updating the cart total if something is deleted
    // or if a quantity was increased
    private function updateCartTotal()
    {
        $userId = auth()->user()->id;

        $cartItems = Cart::where('user_id', $userId)->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $taxRate = 0.13;

        $tax = $subtotal * $taxRate;

        $total = $subtotal + $tax;

        Log::info("Subtotal: $subtotal, Tax: $tax, Total: $total");

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ];
    }
    
}
