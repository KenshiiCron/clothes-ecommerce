<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Models\AttributeValue;
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

    public function mount()
    {
        $inventory = $this->product->inventories->where('quantity', '>', 0)->first();
        $this->selected_inventory_id = $inventory->id;
        $this->price = $inventory->price;
        foreach ($inventory->attribute_values as $value) {
            $this->attribute_values[$value->attribute->id] = $value->id;
            $this->selected_values[$value->attribute->id] = ucfirst($value->value);
        }

    }
    public function render()
    {

        return view('livewire.product');
    }
    public function updated($propertyName, $value)
    {
        if(str_contains($propertyName,'attribute_values')) {
            $this->selected_values[explode('.',$propertyName)[1]] = ucfirst(AttributeValue::where('id',$value)->first()->value);
            $this->exists = false;
            foreach($this->product->inventories as $inventory) {
                $inventoryValueIds = $inventory->attribute_values->pluck('id')->all();
                if(collect($this->attribute_values)
                    ->every(fn ($id) => in_array($id, $inventoryValueIds)) && $inventory->quantity > 0)
                {
                    $this->exists = true;
                    $this->price = $inventory->price;
                    $this->selected_inventory_id = $inventory->id;

                }
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

}
