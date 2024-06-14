<?php

namespace App\Livewire;

use Livewire\Component;

class OrderHistory extends Component
{
    public function render()
    {
        return view('livewire.order-history');
    }

    public function getOrdersProperty()
    {
        return auth()->user()->orders()->orderBy('created_at', 'desc')->get();
    }
}
