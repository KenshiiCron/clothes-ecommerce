<?php

namespace App\Livewire;

use App\Helpers\Cart;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class HeaderComponent extends Component
{
    public function render()
    {
        return view('livewire.header-component');
    }
    #[Computed]
    #[On('wishlist-updated')]
    public function getWishlistCountProperty()
    {
        if(auth()->check()){
            return \App\Models\Wishlist::where('user_id',auth()->id())->count();
        }else{
            return count(session()->get('wishlist',[]));
        }

    }
    #[Computed]
    #[On('cart-updated')]
    public function getCartCountProperty()
    {
        return session()->has('cart') ? session()->get('cart')->getTotalQty() : 0;
    }
}
