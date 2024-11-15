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
        if (array_key_exists('path', $data) && isset($data['path'])) {
            $data['path'] = $this->uploadOne($data['path'], ((new \ReflectionClass($this->model))->getShortName()) . '/path', 'public');
        }

        return $this->model::create($data);
    }

    public function destroy($model): void
    {
        $model = $this->findOneById($model);

        $this->deleteOne($model->path, 'public');

        $model->delete();
    }

}
