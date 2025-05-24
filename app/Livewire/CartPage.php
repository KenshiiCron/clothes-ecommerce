<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Product;

class CartPage extends Component
{
    public $qty = [];
    public $products = [];

    public function mount(){
       $this->getCart();
    }
    public function getCart(){
        $cart = session()->has('cart') ? session()->get('cart') : null;
        $this->products =[];
        if($cart){
            foreach($cart->getItems() as $key=>$item){
                $product = Product::find($item['product_id']);
                $inventory = $product->inventories->where('id',$item['inventory_id'])->first();
                $this->products[$key]['details'] = $product;
                $this->products[$key]['inventory'] = $inventory;
                $this->products[$key]['qty'] = $item['qty'];
                $this->products[$key]['total'] = $item['qty'] * $inventory->price;
            }
        }
    }

    public function increaseQty($key)
    {
        $this->products[$key]['qty']++;
        $this->recalculateTotal($key);
        $cart = session()->has('cart') ? session()->get('cart') : null;
        $cart->update($key,$this->products[$key]['qty']);
        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function decreaseQty($key)
    {

        if ($this->products[$key]['qty'] > 1) {
            $cart = session()->has('cart') ? session()->get('cart') : null;
            $this->products[$key]['qty']--;
            $this->recalculateTotal($key);
            $cart->update($key, $this->products[$key]['qty']);
            session()->put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }
    public function remove($key)
    {
        $cart = session()->has('cart') ? session()->get('cart') : null;

        if ($cart) {
            $cart->remove($key);

            unset($this->products[$key]);
            $this->products = array_values($this->products);

            session()->put('cart', $cart);

            $this->getCart();

            $this->dispatch('swal-toast',
                ['icon' => 'success',
                    'title' => 'Cart Item Removed',
                    'text' => $this->products[$key]->name . ' has been removed from your cart.',
                ]);
            $this->dispatch('cart-updated');
        }
    }


    private function recalculateTotal($key)
    {
        $qty = $this->products[$key]['qty'];
        $price = $this->products[$key]['inventory']->price;
        $this->products[$key]['total'] = $qty * $price;

    }

    #[Computed]
    public function getTotalProperty()
    {
        $cart = session()->has('cart') ? session()->get('cart') : null;
        return $cart?->getTotalPrice()?:0;
    }


    public function render()
    {
        $cart = session()->has('cart') ? session()->get('cart') : null;
        return view('livewire.cart-page',compact('cart'));
    }
}
