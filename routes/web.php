<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontEndController;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');



// Authentication routes
Auth::routes();
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/', [FrontEndController::class, 'showAllProducts'])->name('frontend.index');
// Protected routes for authenticated users with admin privileges
Route::middleware(['auth', 'isAdmin'])->group(function () {

    // Admin dashboard
    Route::get('/dashboard', function () {
        return view('auth.admin');
    });

    // Categories
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/add-category', function () {
        return view('admin.category.add-category');
    });
    Route::post('/insert-category', [CategoryController::class, 'insert'])->name('insert.category');
    Route::get('edit-category/{category}', [CategoryController::class, 'edit'])->name('edit.category');
    Route::put('update-category/{category}', [CategoryController::class, 'update'])->name('update.category');
    Route::delete('delete-category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/add-product', [ProductController::class, 'insert'])->name('add.product');
    Route::get('/add-product', function () {
        $categories = Category::all();
        return view('admin.product.add-product', compact('categories'));
    })->name('admin.product.add-product');
    Route::get('edit-product/{product}', [ProductController::class, 'edit'])->name('edit.product');
    Route::put('update-product/{product}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('delete-product/{product}', [ProductController::class, 'destroy'])->name('admin.product.delete-product');
});
