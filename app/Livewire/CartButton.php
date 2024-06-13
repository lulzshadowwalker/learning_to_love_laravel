<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;

class CartButton extends Component
{

    public $listeners = ['cart-update' => '$refresh'];

    public function getCountProperty()
    {
        return CartFactory::make()->items->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-button');
    }
}
