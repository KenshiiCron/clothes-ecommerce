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
            $data['image'] = $this->uploadOne($data['image'],(new \ReflectionClass($this->model))->getShortName().'/image','public');
        }
        $data['slug'] = Str::slug($data['name']);
        return $this->model::create($data);
    }


}
