<?php


namespace App\Repositories;


use App\Contracts\BrandContract;
use App\Models\Brand;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class BrandRepository extends BaseRepositories implements BrandContract
{
    use UploadAble;

    /**
     * @param Brand $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Brand $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $this->uploadOne($data['image'], ((new \ReflectionClass($this->model))->getShortName()) . '/image', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('store')
            ->log('created: ' . $this->model);

        return $this->model::create($data);
    }

    public function update($model, array $data)
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if (array_key_exists('image', $data) && isset($data['image'])) {
            if ($model->image) {
                $this->deleteOne($model->image);
            }
            $data['image'] = $this->uploadOne($data['image'], (new \ReflectionClass($this->model))->getShortName() . '/image', 'public');
        } else {
            $data['image'] = $model->image;
        }

        if (!array_key_exists('featured', $data)) {
            $data['featured'] = false;
        }

        $model->update($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('update')
            ->log('edited: ' . $this->model);

        return $model->refresh();
    }

    public function destroy($model)
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if ($model->image) {
            $this->deleteOne($model->image);
        }

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('destroy')
            ->log('deleted: ' . $this->model);

        return $model->delete();
    }
}
