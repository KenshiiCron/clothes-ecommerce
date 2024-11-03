<?php


namespace App\Repositories;



use App\Contracts\InventoryContract;
use App\Models\Inventory;

use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class InventoryRepository extends BaseRepositories implements InventoryContract
{
    use UploadAble;

    /**
     * @param Inventory $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Inventory $model, array $filters = [
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
