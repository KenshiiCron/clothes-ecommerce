<?php


namespace App\Repositories;



use App\Contracts\ImageContract;
use App\Models\Image;
use app\Traits\UploadAble;
use JetBrains\PhpStorm\Pure;

class ImageRepository extends BaseRepositories implements ImageContract
{
    use UploadAble;

    /**
     * @param Image $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Image $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {

        return $this->model::create($data);
    }




}
