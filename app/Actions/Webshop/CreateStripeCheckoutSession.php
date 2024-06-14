<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

class CreateStripeCheckoutSession
{
    public function createFromCart(Cart $cart)
    {
        return $cart
            ->user
            ->allowPromotionCodes()
            ->checkout($this->formatCartItems($cart->items), [
                'customer_update' => [

                    // to automatically sync the customer address with e.g. the tax calculation
                    'shipping' => 'auto',
                ],
                'shipping_address_collection' => [
                    'allowed_countries' => ['US', 'SE', 'ZA', 'RO', 'GB', 'JP'],
                ],
                'metadata' => [
                    'user_id' => $cart->user->id,
                    'cart_id' => $cart->id,
                ]
            ]);
    }

    private function formatCartItems(Collection $items)
    {
        return $items->loadMissing('product', 'variant')->map(
            fn (CartItem $item) =>
            [
                'price_data' => [
                    'currency' => $item->product->price->getCurrency(),
                    'unit_amount' => $item->product->price->getAmount(),
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => "Size: {$item->variant->size} | Color {$item->variant->color}",
                        'images' => $item->product->images->map(fn (Image $image) => $image->path)->toArray(),
                        'metadata' => [
                            'product_id' => $item->product->id,
                            'product_variant_id' => $item->variant->id,
                        ],
                    ],
                ],
                'quantity' => $item->quantity,
            ]
        )->toArray();
    }
}