<?php


namespace App\Repositories;


use App\Contracts\AttributeValueContract;
use App\Models\AttributeValue;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class AttributeValueRepository extends BaseRepositories implements AttributeValueContract
{
    use UploadAble;

    /**
     * @param AttributeValue $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(AttributeValue $model, array $filters = [
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

    public function update($model,array $data )
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);
        $attribute_id = $model->attribute->id;
        $data['attribute_id'] = $attribute_id;
        $model->update($data);
        return $model->refresh();
    }


}
