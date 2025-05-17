<?php


namespace App\Repositories;



use App\Contracts\ProductContract;
use App\Models\Product;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class ProductRepository extends BaseRepositories implements ProductContract
{
    use UploadAble;

    /**
     * @param Product $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Product $model, array $filters = [
        \App\QueryFilter\Search::class,
        \App\QueryFilter\Category::class,
        \App\QueryFilter\AttributeValues::class,
        \App\QueryFilter\CreatedAt::class,
        \App\QueryFilter\Price::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        if (array_key_exists('image', $data) && isset($data['image'])) {
            $data['image'] = $this->uploadOne($data['image'], ((new \ReflectionClass($this->model))->getShortName()) . '/image', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('store')
            ->log('created: ' . $this->model);

        $product = $this->model::create($data);

        $product->categories()->attach($data['categories']);

        return $product;
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

        $model->categories()->sync($data['categories']);

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
