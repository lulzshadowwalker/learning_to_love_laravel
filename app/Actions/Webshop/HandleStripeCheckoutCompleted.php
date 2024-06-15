<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Cashier;
use Stripe\LineItem;

class HandleStripeCheckoutCompleted
{
    public function handle($sessionId)
    {
        Log::info("message from HandleStripeCheckoutCompleted.php");
        DB::transaction(function () use ($sessionId) {
            $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
            $user = User::find($session->metadata->user_id);
            $cart = Cart::find($session->metadata->cart_id);

            $order = $user->orders()->create([
                'stripe_checkout_session_id' => $session->id,
                'amount_total' => $session->amount_total,
                'amount_subtotal' => $session->amount_subtotal,
                'amount_tax' => $session->total_details->amount_tax,
                'amount_shipping' => $session->total_details->amount_shipping,
                'amount_discount' => $session->total_details->amount_discount,
                'billing_address' => [
                    'name' => $session->customer_details->name,
                    'city' => $session->customer_details->address->city,
                    'country' => $session->customer_details->address->country,
                    'line1' => $session->customer_details->address->line1,
                    'line2' => $session->customer_details->address->line2,
                    'postal_code' => $session->customer_details->address->postal_code,
                    'state' => $session->customer_details->address->state,
                ],
                'shipping_address' => [
                    'name' => $session->shipping_details->name,
                    'city' => $session->customer_details->address->city,
                    'country' => $session->customer_details->address->country,
                    'line1' => $session->customer_details->address->line1,
                    'line2' => $session->customer_details->address->line2,
                    'postal_code' => $session->customer_details->address->postal_code,
                    'state' => $session->customer_details->address->state,
                ],
            ]);

            $lineItems = Cashier::stripe()->checkout->sessions->allLineItems($sessionId);

            $orderItems = collect($lineItems->all())->map(function (LineItem $lineItem) {
                $product = Cashier::stripe()->products->retrieve($lineItem->price->product);

                return new OrderItem([
                    'product_variant_id' => $product->metadata->product_variant_id,
                    'name' => $product->name,

                    // this is actually the description of the product we gave to stripe not the product variant description
                    'description' => $product->description,
                    'price' => $lineItem->price->unit_amount,
                    'quantity' => $lineItem->quantity,
                    'amount_total' => $lineItem->amount_total,
                    'amount_tax' => $lineItem->amount_tax,
                    'amount_subtotal' => $lineItem->amount_subtotal,
                    'amount_discount' => $lineItem->amount_discount,
                ]);
            });

            $order->items()->saveMany($orderItems);
            $cart->delete();
        });
    }
}
