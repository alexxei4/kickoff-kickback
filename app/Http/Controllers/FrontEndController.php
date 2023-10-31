<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;



class FrontEndController extends Controller
{

    public function showProduct(Product $product)
    {
        return view('frontend.product.show', compact('product'));
    }

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
        $products = Product::paginate(10);
        $categories = Category::all();
        return View::make('frontend.index', compact('products','categories'));
    }

    public function filterProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $search = $request->input('search');
        $brand_name = $request->input('brand_name'); // Use correct variable name
        $min_cost = $request->input('min_cost');
        $max_cost = $request->input('max_cost');
    
        $products = Product::when($category_id, function ($query) use ($category_id) {
            return $query->where('category_id', $category_id);
        })
        ->when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->when($brand_name, function ($query) use ($brand_name) { // Use brandname variable
            return $query->where('brand', 'like', '%' . $brand_name . '%');
        })
        ->when($min_cost, function ($query) use ($min_cost) {
            return $query->where('cost', '>=', $min_cost);
        })
        ->when($max_cost, function ($query) use ($max_cost) {
            return $query->where('cost', '<=', $max_cost);
        })
        ->get();
    
        $productListView = view('frontend._products-list', ['products' => $products])->render();
    
        return response()->json(['html' => $productListView]);
    }
    
    
    





}
