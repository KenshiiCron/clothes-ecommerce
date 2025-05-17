<?php

namespace App\QueryFilter;

use App\Models\Product;
use App\Models\User;

class Price extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());


        if (empty($q)) {
            return $builder;
        }
        $model = $builder->getModel();

        if (is_array($q)) {

            return $builder;
        }

        if($model instanceof Product){
            if (is_numeric($q))
            {
                return $builder->whereHas('categories',static function($query) use ($q){
                    $query->where('categories.id',$q)->orWhere('product_categories.category_id',$q);
                });
            }else{
                $builder->with('inventories')
                    ->withMin('inventories', 'price') // adds `inventories_min_price` column
                    ->orderBy('inventories_min_price', $q);
            }
        }


        return $builder;
    }
}
