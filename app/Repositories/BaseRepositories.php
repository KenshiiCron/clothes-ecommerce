<?php


namespace App\Repositories;

use App\Contracts\Base\CrudContract;
use App\Traits\FilterableTrait;
use App\Traits\FindAbleTrait;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\Model;

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
            $data['image'] = $this->uploadOne($data['image'],(new \ReflectionClass($this->model))->getShortName().'/image');
        }

        return $this->model::create($data);
    }

    public function update($model,array $data )
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if (array_key_exists('image',$data))
        {
            if ($model->image)
            {
                $this->deleteOne($model->image);
            }
            $data['image'] = $this->uploadOne($data['image'],(new \ReflectionClass($this->model))->getShortName().'/image');
        }

        $model->update($data);
        return $model->refresh();
    }

    public function destroy($model)
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if ($model->image)
        {
            $this->deleteOne($model->image);
        }

        return $model ->delete();
    }
}
