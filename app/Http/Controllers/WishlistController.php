<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Http\Controllers\Controller;


// this is the controller for the wishlistx

class WishlistController extends Controller
{
    // this displays the wishlist 
    public function index()
    {
        
        $user = Auth::user();
        $wishlistItems = $user->wishlist;
        $wishlistItemCount = $wishlistItems->count();
        return view('wishlist.index', compact('wishlistItems','wishlistItemCount'));

    }
    // this helps with adding items to a wishlist
    public function addToWishlist(Request $request)
    {
    $user = Auth::user();
    $productId = $request->input('product_id');

    if (!$user->wishlist->contains($productId)) {
        $user->wishlist()->attach($productId);
    }

        return response()->json(['message' => 'Product added to wishlist']);
    }

    // this helps with removing item from the wishlist 
    public function removeFromWishlist(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $user->wishlist()->detach($productId);

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist');
    }
}
