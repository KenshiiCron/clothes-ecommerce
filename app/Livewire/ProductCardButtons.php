<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Livewire\Component;

class ProductCardButtons extends Component
{
    public $product;
    public $isInWishlist;
    public function mount(\App\Models\Product $product)
    {
        $this->product = $product;
        $this->isInWishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();
    }

    public function render()
    {
        return view('livewire.product-card-buttons');
    }

    public function toggleWishlist()
    {
        $userId = auth()->id();
        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $this->product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $this->isInWishlist = false;
            $this->dispatch('swal-toast', [
                'icon' => 'success',
                'title' => 'Success',
                'text' => 'Product removed from wishlist.',
            ]);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $this->product->id,
            ]);
            $this->isInWishlist = true;
            $this->dispatch('swal-toast', [
                'icon' => 'success',
                'title' => 'Success',
                'text' => 'Product added from wishlist.',
            ]);
        }
    }
}
