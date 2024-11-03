<?php


namespace App\Repositories;



use App\Contracts\AttributeContract;
use App\Models\Attribute;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class AttributeRepository extends BaseRepositories implements AttributeContract
{
    use UploadAble;

    /**
     * @param Attribute $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Attribute $model, array $filters = [
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
        return $this->model::create($data);
    }




}
