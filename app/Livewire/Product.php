<?php

namespace App\Livewire;

use App\Actions\Webshop\AddProductToCart;
use App\Models\Product as ModelsProduct;
use Exception;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Product extends Component
{
    use InteractsWithBanner;

    // `$productId` can also be defined as a parameter in the `mount` method
    public $productId;
    public $variant;

    public $rules = [
        'variant' => 'required|exists:App\Models\ProductVariant,id',
    ];

    public function mount()
    {
        $this->variant = $this->product->variants->value('id');
        // or
        // $this->variant = $this->product->variants->first()->id;
    }

    public function getProductProperty()
    {
        return ModelsProduct::findOrFail($this->productId);
    }

    public function render()
    {
        return view('livewire.product');
    }

    public function addToCart(AddProductToCart $cart)
    {
        $this->validate();

        $cart->add($this->variant);
        $this->banner('Product added to cart!');
        $this->dispatch('cart-update');
    }
}
