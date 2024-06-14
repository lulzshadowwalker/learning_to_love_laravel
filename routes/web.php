<?php

use App\Livewire\Cart;
use App\Livewire\CheckoutStatus;
use App\Livewire\StoreFront;
use App\Livewire\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', StoreFront::class)->name('home');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/products/{productId}', Product::class)->name('product.show');
Route::get('/checkout/status', CheckoutStatus::class)->name('checkout.status');
Route::get('/dashboard', CheckoutStatus::class)->name('orders.show');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
