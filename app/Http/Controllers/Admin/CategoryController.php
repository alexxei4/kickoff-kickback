<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index-category', compact('categories'));
    }
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

    public function edit(Category $category)
    {
        return view('admin.category.edit-category', compact('category'));
    }

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


    public function destroy(Category $category)
    {
    
        $category->delete();

        
        return redirect()->route('categories')->with('success', 'Category deleted successfully');
   
    }
}

