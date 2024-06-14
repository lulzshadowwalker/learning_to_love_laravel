<?php

namespace App\Livewire;

use App\Actions\Webshop\AddProductToCart;
use App\Actions\Webshop\CreateStripeCheckoutSession;
use App\Factories\CartFactory;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Cart extends Component
{
    use InteractsWithBanner;

    public function getCartProperty()
    {
        return CartFactory::make();
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function increment($itemId, AddProductToCart $addProductToCart = new AddProductToCart())
    {
        $item = $this->cart->items()->where('id', $itemId)->first();
        $addProductToCart->add($item->variant->id);
        $this->dispatch('cart-update');
    }

    public function decrement($itemId)
    {
        $item = $this->cart->items()->where('id', $itemId)->first();
        if ($item->quantity === 1) {
            $this->remove($itemId);
        } else {
            $item->quantity--;
            $item->save();
        }

        $this->dispatch('cart-update');
    }

    public function remove($itemId)
    {
        // TODO: make this into an action/servicej
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch('cart-update');
    }

    public function clear(): void
    {
        $this->cart->items()->delete();
        $this->banner('Cart has been cleared successfully.');
        $this->dispatch('cart-update');
    }

    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        return $checkoutSession->createFromCart($this->cart);
    }
}
