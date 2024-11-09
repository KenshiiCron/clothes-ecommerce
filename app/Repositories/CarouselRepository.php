<?php


namespace App\Repositories;


use App\Contracts\CarouselContract;
use App\Models\Carousel;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class CarouselRepository extends BaseRepositories implements CarouselContract
{
    use UploadAble;

    /**
     * @param Carousel $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Carousel $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $this->uploadOne($data['image'], (new \ReflectionClass($this->model))->getShortName() . '/image', 'public');
        }

        $data['type'] = intval($data['type']);

        switch ($data['type']) {
            case 0:
                $data['action'] = null;
                $data['product_id'] = null;
                break;
            case 1:
                $data['action'] = null;
                break;
            case 2:
                $data['product_id'] = null;
                break;
            default:
                dd('error');
        }

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

        $data['type'] = intval($data['type']);

        switch ($data['type']) {
            case 0:
                $data['action'] = null;
                $data['product_id'] = null;
                break;
            case 1:
                $data['action'] = null;
                break;
            case 2:
                $data['product_id'] = null;
                break;
            default:
                dd('error');
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
