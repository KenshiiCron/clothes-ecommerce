<?php

namespace App\QueryFilter;

use App\Models\Product;
use App\Models\User;

class Category extends Filter
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
                return $builder->whereHas('categories',static function($query) use ($q){
                    $query->where('slug',$q);
                });
            }
        }


        return $builder;
    }
}
