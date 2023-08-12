<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller

{
     public function showProduct(Product $product)
     {
        $products = Product::all();
        return View::make('frontendlayout.index', compact('products'));
     }
 
     public function showAllProducts()
     {
         $products = Product::all();
         return view('products.index', ['products' => $products]);
     }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index-product', compact('products'));
    }
    public function insert(Request $request)
        {
            $validatedData = $request->validate([
                'category_id' => 'required|string',
                'name' => 'required|string',
                'slug' => 'required|string',
                'description' => 'required|string',
                'cost' => 'required|numeric',
                'quantity' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'is_featured' =>  'nullable|boolean',
                'is_available' => 'nullable|boolean',
                'brand' => 'required|string',
                'sku' => 'required|unique:products|string',
            ]);

            // Create a new product instance and set the attributes
            $product = new Product();
            $product->category_id = $request->input('category_id');
            $product->name = $request->input('name');
            $product->slug = $request->input('slug');
            $product->description = $request->input('description');
            $product->cost = $request->input('cost');
            $product->quantity = $request->input('quantity');
            $product->image = $request->input('image');
            $product->is_featured = $request->filled('is_featured');
            $product->is_available = $request->filled('is_available');
            $product->brand = $request->input('brand');
            $product->sku = $request->input('sku');
            
            $slug = Str::slug($product->name); 

            $product->slug = $slug;

            // Save the product to the database
            $product->save();

            // Handle the image upload after saving the product
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/uploads/product'), $imageName);

                if ($product->image) {
                    Storage::delete('public/assets/uploads/product/' . $product->image);
                }

                $product->image = $imageName;
                $product->save();
            }

            // Redirect the user back to the form with a success message
            return redirect()->route('admin.product.add-product')->with('success', 'Product added successfully!');
        }

    public function edit(Product $product)
    {
       
        $categories = Category::all(); // Fetch all categories from the database

        // Pass the $product and $categories variables to the view
        return view('admin.product.edit-product', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_featured' =>  'nullable|boolean',
            'is_available' =>  'nullable|boolean',
            'brand' => 'required|string',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
        ]);

        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->cost = $request->input('cost');
        $product->quantity = $request->input('quantity');
        $product->is_featured = $request->filled('is_featured') ? true : null;
        $product->is_available = $request->filled('is_available') ? true : null;
        $product->brand = $request->input('brand');
        $product->sku = $request->input('sku');
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/uploads/product'), $imageName);

            if ($product->image) {
                Storage::delete('public/assets/uploads/product/' . $product->image);
            }

            $product->image = $imageName;
        }
        

        // Save the updated product to the database
        $product->save();

        // Redirect the user back to the products list with a success message
        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
    
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
    
   

    
}
