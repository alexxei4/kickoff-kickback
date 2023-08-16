<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use App\Http\Controllers\Controller;




class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlist; 

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function addToWishlist(Request $request)
    {
        
        $user = Auth::user();
        $productId = $request->input('product_id');

        if (!$user->wishlist->contains($productId)) {
            $user->wishlist()->attach($productId);
        }
    

        return response()->json(['message' => 'Product added to wishlist']);
    }

    public function removeFromWishlist(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $user->wishlist()->detach($productId);

        return response()->json(['message' => 'Product removed from wishlist']);
    }
}
