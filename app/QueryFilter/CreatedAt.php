<?php

namespace App\QueryFilter;

use App\Models\Product;
use App\Models\User;

class CreatedAt extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());;
        if (empty($q)) {
            return $builder;
        }
        $model = $builder->getModel();

        if (is_array($q)) {

            return $builder;
        }
        if($model instanceof Product){

            return $builder->orderBy('created_at', $q);
        }

        return $builder;
    }
}
