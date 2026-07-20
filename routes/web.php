<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route untuk landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route katalog
Route::get('/katalog', function () {
    $products = \App\Models\Product::latest()->paginate(12);
    return view('catalog', compact('products'));
})->name('catalog');

// Route checkout
Route::get('/checkout/{product}', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process/{product}', [CheckoutController::class, 'process'])
    ->middleware('auth')
    ->name('checkout.process');

// Route order
Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show')
    ->middleware('auth');

// Midtrans callback
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

// Route cancel order (hanya yang pending)
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])
    ->name('orders.cancel')
    ->middleware('auth');

// Route untuk testing (HANYA UNTUK LOCAL!)
Route::get('/orders/{order}/force-paid', [OrderController::class, 'updatePaymentStatus'])
    ->name('orders.force-paid')
    ->middleware('auth');

require __DIR__ . '/auth.php';