<?php

namespace App\QueryFilter;

use App\Models\User;

class Search extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());
        $f = request('filter');

        if (empty($q)) {
            return $builder;
        }
        $model = $builder->getModel();

        if (is_array($q)) {
            return $builder;
        }

//            if ($model instanceof Appointment) {
//                $builder->where("type", 'like', $f)->orWhere("id", 'like',intval($q))
//                    ->orWhere('reference', 'like', '%' . $q . '%')
//                    ->orWhereRelation('client', 'name', 'like', '%' . $q . '%')
//                    ->orWhereRelation('client', 'phone', 'like', $q)
//                    ->orWhereRelation('user', 'name', 'like', '%' . $q . '%');;
//            }


        if ($model instanceof User) {
            $builder->where('name', 'like', '%' . $q . '%')
                ->orWhere('email', 'like', '%' . $q . '%')
                ->orWhere('phone', 'like', '%' . $q . '%');
        }
        /*if ($model instanceof Category) {
            $builder->where('name', 'like', '%' . $q . '%');
        }*/


        return $builder;
    }
}
