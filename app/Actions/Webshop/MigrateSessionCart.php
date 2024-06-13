<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItem;

class MigrateSessionCart
{
    public function migrate(
        Cart $sessionCart,
        Cart $userCart,
        AddProductToCart $addProductToCart = new AddProductToCart(),
    ) {
        $sessionCart->items->each(
            fn (CartItem $item) =>
            $addProductToCart->add(
                variantId: $item->product_variant_id,
                quantity: $item->quantity,
                cart: $userCart,
            )
        );

        $sessionCart->items()->delete();
        $sessionCart->delete();
    }
}
