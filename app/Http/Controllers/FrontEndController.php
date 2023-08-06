<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\View;


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
        return View::make('frontend.index', compact('products'));
    }


}
