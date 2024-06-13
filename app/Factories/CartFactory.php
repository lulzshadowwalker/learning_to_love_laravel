<?php

namespace App\Factories;

use App\Models\Cart;

class CartFactory
{
    public static function make()
    {
        $cart = match (auth()->guest()) {
            true => Cart::firstOrCreate([
                'session_id' => session()->getId(),
            ]),
            false => Cart::firstOrCreate([
                'user_id' => auth()->id(),
            ]),
        };

        return $cart;
    }
}
