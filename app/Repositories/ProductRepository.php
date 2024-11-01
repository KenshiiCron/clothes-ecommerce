<?php


namespace App\Repositories;


use App\Contracts\CategoryContract;
use App\Models\Category;
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
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        if (array_key_exists('image', $data))
        {
            $data['image'] = $this->uploadOne($data['image'],(new \ReflectionClass($this->model))->getShortName().'/image');
        }
        $data['slug'] = Str::slug($data['name']);
        return $this->model::create($data);
    }


}
