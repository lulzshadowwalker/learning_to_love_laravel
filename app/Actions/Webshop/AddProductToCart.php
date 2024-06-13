<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;

class AddProductToCart
{
    public function add($variantId, $quantity = 1, Cart $cart = null)
    {
        // hmm nice.
        ($cart ?: CartFactory::make())->items()->firstOrCreate(
            ['product_variant_id' => $variantId],
            ['quantity' => 0]
        )->increment('quantity', $quantity);
    }
}
