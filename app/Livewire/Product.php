<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Models\AttributeValue;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    public $product;
    public $attribute_values = [];
    public $selected_values = [];
    public $selected_inventory_id;
    public $exists = true;
    public $price;
    public $quantity = 1;
    public $isInWishlist;

    public function mount()
    {
        $inventory = $this->product->inventories->where('quantity', '>', 0)->first();
        $this->selected_inventory_id = $inventory->id;
        $this->price = $inventory->price;
        foreach ($inventory->attribute_values as $value) {
            $this->attribute_values[$value->attribute->id] = $value->id;
            $this->selected_values[$value->attribute->id] = ucfirst($value->value);
        }

        if (Auth::check()) {
            $this->syncWishlist();
            $this->isInWishlist = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $this->product->id)
                ->exists();
        } else {
            $wishlist = session()->get('wishlist', []);
            $this->isInWishlist = in_array($this->product->id, $wishlist);
        }

    }
    public function render()
    {

        return view('livewire.product');
    }
    public function updated($propertyName, $value)
    {
        if (str_contains($propertyName, 'attribute_values')) {
            // Handle radio button changes
            $attributeId = explode('.', $propertyName)[1];
            $this->selected_values[$attributeId] = ucfirst(AttributeValue::where('id', $value)->first()->value);
            $this->exists = false;

            foreach ($this->product->inventories as $inventory) {
                $inventoryValueIds = $inventory->attribute_values->pluck('id')->all();
                if (collect($this->attribute_values)
                        ->every(fn ($id) => in_array($id, $inventoryValueIds)) && $inventory->quantity > 0)
                {
                    $this->exists = true;
                    $this->price = $inventory->price;
                    $this->selected_inventory_id = $inventory->id;
                    break;
                }
            }
        } elseif ($propertyName === 'selected_inventory_id') {
            // Handle select dropdown changes
            $inventory = $this->product->inventories->find($value);
            if ($inventory && $inventory->quantity > 0) {
                $this->exists = true;
                $this->price = $inventory->price;
                $this->attribute_values = [];
                $this->selected_values = [];
                foreach ($inventory->attribute_values as $value) {
                    $this->attribute_values[$value->attribute->id] = $value->id;
                    $this->selected_values[$value->attribute->id] = ucfirst($value->value);
                }
            } else {
                $this->exists = false;
            }
        }
    }

    public function increaseQty()
    {
        $this->quantity ++;
    }
    public function decreaseQty()
    {
        if($this->quantity > 1)
        {
            $this->quantity --;
        }

    }
    public function addToCart()
    {
        if (session()->has('cart'))
        {
            $cart = new Cart(session('cart'));
        }else
        {
            $cart = new Cart();
        }
        $cart->add($this->product,['qty' => $this->quantity,'inventory_id' => $this->selected_inventory_id]);
        session()->put('cart',$cart);
        session()->flash("success","a été ajouté au panier !");
        $this->dispatch('swal-toast',['icon' => 'success','title' => 'wow', 'text' => 'wow²']);
        $this->dispatch('cart-updated');
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
                    'text' => 'Product removed from wishlist.',
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
                    'text' => 'Product added to wishlist.',
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
                    'text' => 'Product removed from wishlist.',
                ]);
            } else {
                $wishlist[] = $this->product->id;
                $this->isInWishlist = true;
                $this->dispatch('wishlist-updated');
                $this->dispatch('swal-toast', [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => 'Product added to wishlist.',
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
