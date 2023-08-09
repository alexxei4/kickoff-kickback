<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;



class FrontEndController extends Controller
{
    public function showCarousel()
    {
        $products = Product::all();
        return view('carousel', compact('products'));
    }

    public function index()
    {
        return view('welcome');
    }

    public function showAllProducts()
    {
        $products = Product::all();
        $categories = Category::all();
        return View::make('frontend.index', compact('products','categories'));
    }

    public function filterProducts(Request $request)
{
    $category_id = $request->input('category_id');
    $products = Product::when($category_id, function ($query) use ($category_id) {
        return $query->where('category_id', $category_id);
    })->get();

    $productListView = view('frontend._products-list', ['products' => $products])->render();

    return response()->json(['html' => $productListView]);
}






}
