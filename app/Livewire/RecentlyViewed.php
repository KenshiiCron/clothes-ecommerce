<?php

namespace App\Livewire;

use App\Models\Product as ProductModel;
use Livewire\Component;

class RecentlyViewed extends Component
{
    public $products = [];

    public function mount()
    {
        $this->loadRecentlyViewed();
    }

    public function loadRecentlyViewed()
    {
        $recentlyViewedIds = session()->get('recently_viewed', []);
        $this->products = ProductModel::whereIn('id', $recentlyViewedIds)->with(['inventories','images'])
            ->get();
    }

    public function render()
    {
        return view('livewire.recently-viewed');
    }
}
