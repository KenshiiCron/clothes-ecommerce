<?php

namespace App\Livewire;

use App\Contracts\ProductContract;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
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

    protected $listeners = ['filter'];

    public function mount(ProductContract $product)
    {
        if(request()->has('category'))
        {
            $this->category = request('category');
        }
        /*->reject(function ($product) {
            return $product->inventories->isEmpty();
        });*/
    }
    public function render(ProductContract $product)
    {
        $categories = Category::whereHas('products')->get();
        $attributes = Attribute::whereHas('products')->get();
        $this->products = $product->findByFilter();
        return view('livewire.shop', ['categories' => $categories,'attributes' => $attributes, 'products' => $this->products]);
    }

    public function updated($propertyName)
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
    }
    public function filter($filters)
    {
        request()->merge([$filters[0] => $filters[1]]);
    }

}
