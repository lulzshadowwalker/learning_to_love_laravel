<?php

use App\Mail\AbandonedCartReminder;
use App\Models\Cart;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('app:abandoned-cart', function () {
    $carts = Cart::withWhereHas('user')->whereDate('updated_at', today()->subDay())->get();

    foreach ($carts as $cart) {
        Mail::to($cart->user)->send(new AbandonedCartReminder($cart));
    }
})->purpose('check for abandoned carts and send reminder emails to customers.')->dailyAt('12:25');

Artisan::command('app:remove-inactive-session-carts', function () {
    $carts = Cart::whereDoesntHave('user')->whereDate('created_at', '<', now())->get();
    $carts->each->delete();
})->purpose('remove inactive session carts')->weekly();
