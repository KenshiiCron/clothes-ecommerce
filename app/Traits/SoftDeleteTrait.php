<?php

namespace app\Traits;

use Illuminate\Database\Eloquent\Model;

trait SoftDeleteTrait
{
    public function forceDelete(Model|int $model){

        $model = $model instanceof $this->model ? $model : $this->withTrashed()->findOneById($model);
        return $model->forceDelete();
    }

    public function restore(Model|int $model){
        $model = $model instanceof $this->model ? $model : $this->withTrashed()->findOneById($model);
        return $model->restore();
    }

    public function onlyTrashed(){
        $this->getQuery()->onlyTrashed();
        return $this;
    }

    public function withTrashed(){
        $this->getQuery()->withTrashed();
        return $this;
    }
}
