<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontEndController;
use App\Models\Category;
use App\Models\Product;
use App\Models\SKU;
use App\Models\User;
use App\Models\Variation;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Auth::routes();
Route::get('/products/{product}', [FrontEndController::class, 'showProduct'])->name('frontend.product.show');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/', [FrontEndController::class, 'showAllProducts'])->name('frontend.index');
Route::get('/filter-products', [FrontEndController::class, 'filterProducts'])->name('frontend.filter.products');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('password/request/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/product/{product}/variations', [ProductController::class, 'variations'])->name('product.variations');
Route::post('/product/{product}/variations/add', [ProductController::class, 'addVariation'])->name('product.variations.add');
Route::get('/product/{product}/variations/{variation}/edit', [ProductController::class, 'editVariation'])->name('product.variations.edit');
Route::put('/product/{product}/variations/{variation}', [ProductController::class, 'updateVariation'])->name('product.variations.update');
Route::delete('/product/{product}/variations/{variation}', [ProductController::class, 'deleteVariation'])->name('product.variations.delete');



Route::middleware(['auth', 'isAdmin'])->group(function () {



   
    Route::get('/dashboard', function () {
        return view('auth.admin');
    });
    Route::get('/sales', [App\Http\Controllers\Admin\AdminController::class,'sales'])->name('admin.sales.index');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class,'users'])->name('admin.users.users');  


    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\AdminController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\AdminController::class,'update'])->name('users.update');
    Route::delete('/delete-user/{user}/',[App\Http\Controllers\Admin\AdminController::class,'destroy'])->name('users.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/add-category', function () {
        return view('admin.category.add-category');
    });
    Route::post('/insert-category', [CategoryController::class, 'insert'])->name('insert.category');
    Route::get('edit-category/{category}', [CategoryController::class, 'edit'])->name('edit.category');
    Route::put('update-category/{category}', [CategoryController::class, 'update'])->name('update.category');
    Route::delete('delete-category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

  
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/add-product', [ProductController::class, 'insert'])->name('add.product');
    Route::get('/add-product', function () {
        $categories = Category::all();
        return view('admin.product.add-product', compact('categories'));
    })->name('admin.product.add-product');
    Route::get('edit-product/{product}', [ProductController::class, 'edit'])->name('edit.product');
    Route::put('update-product/{product}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('delete-product/{product}', [ProductController::class, 'destroy'])->name('admin.product.delete-product');
    Route::get('/generate-sku/{category}/{brand}/{size}/{color}', [SKUController::class, 'generateSKU'])->name('generateSKU');

});
Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/upload', [ProfileController::class, 'showUploadForm'])->name('profile.upload'); // You can name this 'profile.uploadForm' for clarity.
Route::post('/profile/upload', [ProfileController::class, 'uploadProfilePicture'])->name('profile.upload.post'); // Changed the name to 'profile.upload.post'.
Route::get('/profile/edit', [ProfileController::class, 'showUpdateForm'])->name('profile.edit');
Route::put('/profile/edit', [ProfileController::class, 'updateProfilePicture'])->name('profile.update');
