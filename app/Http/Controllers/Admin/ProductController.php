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
                'color' => 'required|string',
                'quantity' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'is_featured' =>  'nullable|boolean',
                'is_available' => 'nullable|boolean',
                'brand' => 'required|string',
                'size' => 'required_if:category_id,5,6,8|string', 
                'color' => 'required|string',
            ]);

           
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
            $product->size = $request->input('size');
            $product->color = $request->input('color');
            $sku = Str::slug($request->input('name')). '-' . $request->input('size') . '-' . $request->input('color')  . '-' . rand(1000, 9999);
            
            $slug = Str::slug($product->name); 

            $product->slug = $slug;

            $product->sku = $sku;
            $product->save();
            // This is the Variations section , most E Commerce Applications use an SKU Ordering system
            // For example if its the jersey of the same team but one is home and one is away
            // you have to add a variation ( Color = black , Size = XL etc. etc.)
            if ($request->has('variations')) {
                $variations = $request->input('variations');
                foreach ($variations as $variationData) {
                    $variation = new Variation();
                    $variation->product_id = $product->id;
                    $variation->size = $variationData['size'];
                    $variation->color = $variationData['color'];
                    $variation->sku = $this->generateSku($product, $variationData['size'], $variationData['color']);
                    $variation->save();
                }
            }

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

            
            return redirect()->route('admin.product.add-product')->with('success', 'Product added successfully!');
        }

    public function edit(Product $product)
    {
       
        $categories = Category::all(); 

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
            'size' => 'required_if:category_id,5,6,8|string', 
            'color' => 'required|string',
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
        $product->size = $request->input('size');
        $product->color = $request->input('color');

        // This is the Variations section , most E Commerce Applications use an SKU Ordering system
            // For example if its the jersey of the same team but one is home and one is away
            // you have to add a variation ( Color = black , Size = XL etc. etc.)
            if ($request->has('variations')) {
                $variations = $request->input('variations');
                foreach ($variations as $variationData) {
                    $variation = new Variation();
                    $variation->product_id = $product->id;
                    $variation->size = $variationData['size'];
                    $variation->color = $variationData['color'];
                    $variation->sku = $this->generateSku($product, $variationData['size'], $variationData['color']);
                    $variation->save();
                }
            }
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/uploads/product'), $imageName);

            if ($product->image) {
                Storage::delete('public/assets/uploads/product/' . $product->image);
            }

            $product->image = $imageName;
        }
        

        $product->save();

     
        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
    
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }

    
    
    
   

    
}
