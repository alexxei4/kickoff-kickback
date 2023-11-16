<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

// This is the controller for the Category section in the admin dashboard
class CategoryController extends Controller
{

    // This displays all of the categories
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index-category', compact('categories'));
    }
    // This is for creating a new category 
    public function insert(Request $request)
    {
    
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);



    
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->save();

       
        return redirect()->route('categories')->with('success', 'Category inserted successfully');
    }
    // This is for editing the category 
    public function edit(Category $category)
    {
        return view('admin.category.edit-category', compact('category'));
    }
    // This is for Updating the category 
    public function update(Request $request, Category $category)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string',
                'description' => 'required|string',
            ]);

          


    
            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
            $category->save();

            return redirect()->route('categories')->with('success', 'Category edited successfully');
        }

    // This is for deleting the category
    public function destroy(Category $category)
    {
    
        $category->delete();

        
        return redirect()->route('categories')->with('success', 'Category deleted successfully');
   
    }
}

