<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;





class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        Cart::add($product->id, $product->name, 1, $product->cost);

        return response()->json(['message' => 'Product added to cart']);
    }
}