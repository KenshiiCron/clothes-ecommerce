<?php

namespace App\Livewire;

use App\Contracts\ProductContract;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    protected $products;
    protected $categories;
    public $attribute_values = [];
    #[Url]
    public $category = null;
    public $search = null;
    public $orders = [];
    public $currentOrder = 'default';
    public $min_price = 0;
    public $max_price = 10000;

    public function mount(ProductContract $product)
    {
        if(request()->has('category'))
        {
            $this->category = request('category');
        }
        if(request()->has('search'))
        {
            $this->search = request('search');
        }
    }
    public function render(ProductContract $product)
    {
        $categories = Category::whereHas('products')->get();
        $attributes = Attribute::whereHas('products')->get();
        $this->products = $product->setScopes(['HasValidInventories'])->setOrders($this->orders)->findByFilter();
        return view('livewire.shop', ['categories' => $categories,'attributes' => $attributes, 'products' => $this->products]);
    }

    public function updated($propertyName,$value)
    {
        if(str_contains($propertyName,'attribute_values'))
        {

            $selectedAttributes = collect($this->attribute_values)
                ->filter()
                ->keys()
                ->all();
            request()->merge(['attribute_values' => $selectedAttributes]);

            if($this->category != null)
            {
                request()->merge(['category' => $this->category, 'attribute_values' => $selectedAttributes]);
            }
            /*$this->products = $product->findByFilter()*/
            ;/*->reject(function ($product) {
                return $product->inventories->isEmpty();
            });*/
        }
        if(str_contains($propertyName,'min_price') || str_contains($propertyName,'max_price'))
        {
            dd($propertyName);
        }
    }
    public function order($order,$direction)
    {
        $this->orders = [$order => $direction];
        $this->currentOrder = $order.'_'.$direction;
    }


}
