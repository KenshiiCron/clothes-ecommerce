<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCardButtons extends Component
{
    public $product;
    public $isInWishlist;

    public function mount(Product $product)
    {
        $this->product = $product;
        if (Auth::check()) {
            $this->syncWishlist();
            $this->isInWishlist = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->exists();
        } else {
            $wishlist = session()->get('wishlist', []);
            $this->isInWishlist = in_array($product->id, $wishlist);
        }
    }

    public function render()
    {
        return view('livewire.product-card-buttons');
    }

    public function toggleWishlist()
    {
        if (Auth::check()) {
            $userId = auth()->id();
            $wishlistItem = Wishlist::where('user_id', $userId)
                ->where('product_id', $this->product->id)
                ->first();

            if ($wishlistItem) {
                $wishlistItem->delete();
                $this->isInWishlist = false;
                $this->dispatch('wishlist-updated');
                $this->dispatch('swal-toast', [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => $this->product->name.' has been removed from your wishlist.',
                ]);
            } else {
                Wishlist::create([
                    'user_id' => $userId,
                    'product_id' => $this->product->id,
                ]);
                $this->isInWishlist = true;
                $this->dispatch('wishlist-updated');
                $this->dispatch('swal-toast', [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => $this->product->name.' has been added to your wishlist.',
                ]);
            }
        } else {

            $wishlist = session()->get('wishlist', []);

            if (in_array($this->product->id, $wishlist)) {
                $wishlist = array_diff($wishlist, [$this->product->id]);
                $this->isInWishlist = false;
                $this->dispatch('wishlist-updated');
                $this->dispatch('swal-toast', [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => $this->product->name.' has been removed from your wishlist.',
                ]);
            } else {
                $wishlist[] = $this->product->id;
                $this->isInWishlist = true;
                $this->dispatch('wishlist-updated');
                $this->dispatch('swal-toast', [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => $this->product->name.' has been added to your wishlist.',
                ]);
            }

            session()->put('wishlist', array_values($wishlist));
        }
    }

    protected function syncWishlist()
    {
        $wishlist = session()->pull('wishlist', []);

        foreach ($wishlist as $productId) {
            Wishlist::firstOrCreate([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
        }
        session()->forget('wishlist');
    }
}
