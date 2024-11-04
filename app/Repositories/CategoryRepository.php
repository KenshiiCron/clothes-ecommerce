<?php


namespace App\Repositories;


use App\Contracts\CategoryContract;
use App\Models\Category;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class CategoryRepository extends BaseRepositories implements CategoryContract
{
    use UploadAble;

    /**
     * @param Category $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Category $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        if (array_key_exists('image', $data))
        {
            $data['image'] = $this->uploadOne($data['image'],(new \ReflectionClass($this->model))->getShortName().'/image', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('store')
            ->log('created: '. $this->model);

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

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('update')
            ->log('edited: '. $this->model);

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

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('destroy')
            ->log('deleted: '. $this->model);

        return $model ->delete();
    }

}
