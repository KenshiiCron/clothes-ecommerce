<?php


namespace App\Repositories;

use App\Contracts\Base\CrudContract;
use App\Traits\FilterableTrait;
use App\Traits\FindAbleTrait;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

abstract class BaseRepositories implements CrudContract
{
    use FindAbleTrait,FilterableTrait,Uploadable;

    public function __construct(Model $model, array $filters = [])
    {
        $this->model = $model;
        $this->filters = $filters;
        $this->query = $model::query();
    }

    public function new(array $data)
    {
        if (array_key_exists('image', $data))
        {
            $data['image'] = $this->uploadOne($data['image'],(new ReflectionClass($this->model))->getShortName().'/image');
        }

        if ($model AND $user) {
            activity()
                ->causedBy($user)
                ->performedOn($model)
                ->event('store')
                ->log('created: '. $model);
        }

        return $this->model::create($data);
    }

    public function update($model,array $data, $user = null)
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if (array_key_exists('image',$data))
        {
            if ($model->image)
            {
                $this->deleteOne($model->image);
            }
            $data['image'] = $this->uploadOne($data['image'],(new ReflectionClass($this->model))->getShortName().'/image');
        }

        if ($model AND $user) {
            activity()
                ->causedBy($user)
                ->performedOn($model)
                ->event('update')
                ->log('updated: '. $model);
        }

        $model->update($data);
        return $model->refresh();
    }

    public function destroy($model, $user = null)
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if ($model->image)
        {
            $this->deleteOne($model->image);
        }


        if ($model AND $user) {
            activity()
                ->causedBy($user)
                ->performedOn($model)
                ->event('destroy')
                ->log('deleted: '. $model);
        }

        return $model ->delete();
    }
}
