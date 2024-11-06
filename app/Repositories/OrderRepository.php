<?php


namespace App\Repositories;



use App\Contracts\OrderContract;
use App\Models\Orders;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class OrderRepository extends BaseRepositories implements OrderContract
{
    use UploadAble;

    /**
     * @param Orders $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Orders $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        return $this->model::create($data);
    }

    public function update($model,array $data )
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);
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
        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('destroy')
            ->log('deleted: '. $this->model);

        return $model ->delete();
    }


}
