<?php

namespace App\Livewire;

use Livewire\Component;

class CartPage extends Component
{
    public $qty = [];

    public function render()
    {
        $cart = session()->has('cart') ? session()->get('cart') : null;
        return view('livewire.cart-page');
    }
}
