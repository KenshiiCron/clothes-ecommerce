<?php

namespace App\QueryFilter;

use App\Models\Product;
use App\Models\User;

class AttributeValues extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {
            return $builder;
        }
        $model = $builder->getModel();

        if($model instanceof Product){
                return $builder->whereHas('inventories',static function($query) use ($q){
                    $query->whereHas('attribute_values',static function($query) use ($q){
                        $query->whereIn('attribute_value_inventory.attribute_value_id',$q);
                    });
                });
        }


        return $builder;
    }
}
