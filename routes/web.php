<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController as CategoryControllerAlias;
use App\Http\Controllers\ContactController as ContactControllerAlias;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ProductControllerAlias;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');

// Products
Route::get('/products', [ProductControllerAlias::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductControllerAlias::class, 'search'])->name('products.search');
Route::get('/api/products/autocomplete', [ProductControllerAlias::class, 'autocomplete'])->name('products.autocomplete');
Route::get('/products/{product:slug}', [ProductControllerAlias::class, 'show'])->name('products.show');
Route::post('/products/{product}/inquiry', [ProductControllerAlias::class, 'inquiry'])->name('products.inquiry');

// Categories
Route::get('/categories', [CategoryControllerAlias::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryControllerAlias::class, 'show'])->name('categories.show');

// Contact
Route::get('/contact', [ContactControllerAlias::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactControllerAlias::class, 'store'])->name('contact.store');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
    Route::resource('inquiries', InquiryController::class)->only(['index', 'show', 'destroy']);
    Route::delete('products/{product}/images/{image}', [ProductController::class, 'deleteImage'])->name('products.delete-image');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
