<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\WishlistController;

use App\Models\Product;
use App\Models\Category;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');


// Products (public view)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Categories (for users to filter)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Newsletter Subscription
Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');
// Newsletter Verification
Route::get(
    '/newsletter/verify/{token}',
    [NewsletterController::class, 'verify']
)->name('newsletter.verify');


Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image');
Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

// Support & Policies
Route::view('/privacy-policy', 'privacy');
Route::view('/terms-and-conditions', 'terms');
Route::view('/return-policy', 'returns');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {



    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::post('/cart/add/{product}', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove']);

    Route::post('/cart/increase/{item}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{item}', [CartController::class, 'decrease'])->name('cart.decrease');

    // Payment & Orders
    Route::get('/payment', [OrderController::class, 'payment'])->name('payment');
    Route::post('/payment', [OrderController::class, 'processPayment'])->name('payment.process');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');


    // wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Products
    Route::get('/products', [AdminController::class, 'products'])
        ->name('admin.products');

    Route::get('/products/create', [AdminController::class, 'createProduct'])
        ->name('admin.products.create');

    Route::post('/products', [AdminController::class, 'storeProduct'])
        ->name('admin.products.store');

    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])
        ->name('admin.products.edit');

    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])
        ->name('admin.products.update');

    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])
        ->name('admin.products.delete');

    Route::delete('/products/images/{id}', [AdminController::class, 'deleteProductImage'])
        ->name('admin.products.deleteImage');
    // Categories
    Route::get('/categories', [CategoryController::class, 'adminIndex'])
        ->name('admin.categories');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])
        ->name('admin.orders');

    Route::post('/orders/{id}/status', [AdminController::class, 'updateStatus'])
        ->name('admin.orders.status');

    Route::delete('/orders/{id}', [AdminController::class, 'deleteOrder'])
        ->name('admin.orders.delete');

    // Users
    Route::get('/users', [AdminController::class, 'users'])
        ->name('admin.users');

    Route::get('/users/{id}', [AdminController::class, 'showUser'])
        ->name('admin.users.show');

    Route::put('/users/{id}/suspend', [AdminController::class, 'toggleSuspend'])
        ->name('admin.users.suspend');

    Route::put('/users/{id}/toggle-admin', [AdminController::class, 'toggleAdmin'])
        ->name('admin.users.toggleAdmin');

    Route::put('/users/{id}/toggle-verification', [AdminController::class, 'toggleEmailVerification'])
        ->name('admin.users.toggleVerification');

    Route::post('/users/{id}/send-reset-link', [AdminController::class, 'sendPasswordResetLink'])
        ->name('admin.users.sendResetLink');

    Route::put('/users/{id}/customer-level', [AdminController::class, 'updateCustomerLevel'])
        ->name('admin.users.customerLevel');

    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])
        ->name('admin.users.delete');

    // setting
    Route::get('/settings', [AdminController::class, 'settings'])
        ->name('admin.settings');

    Route::put('/settings', [AdminController::class, 'updateSettings'])
        ->name('admin.settings.update');

    // Admin Notes
    Route::put('/users/{id}/notes', [AdminController::class, 'updateUserNotes'])
        ->name('admin.users.notes');
});




/*
|--------------------------------------------------------------------------
| Auth System (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
