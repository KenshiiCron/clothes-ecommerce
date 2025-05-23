<?php

namespace App\View\Composers;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SearchCategoriesComposer
{
    public function compose(View $view)
    {
        $categories = Category::featured()->get();
        return $view->with(['searchCategories'=>$categories]);
    }
}
