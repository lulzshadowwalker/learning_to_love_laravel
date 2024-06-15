<?php

use App\Livewire\Cart;
use App\Livewire\CheckoutStatus;
use App\Livewire\OrderHistory;
use App\Livewire\StoreFront;
use App\Livewire\Product;
use App\Livewire\ViewOrder;
use App\Mail\AbandonedCartReminder;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Route;

Route::get('/', StoreFront::class)->name('home');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/products/{productId}', Product::class)->name('product.show');

Route::get('/preview/order-confirmation', function () {
    $order = App\Models\Order::first();
    return new OrderConfirmation($order);
});

Route::get('/preview/cart-reminder', function () {
    $order = App\Models\Order::first();
    return new AbandonedCartReminder($order);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/checkout/status', CheckoutStatus::class)->name('checkout.status');

    Route::get('/orders', OrderHistory::class)->name('orders.index');
    Route::get('/orders/{orderId}', ViewOrder::class)->name('orders.show');
});
