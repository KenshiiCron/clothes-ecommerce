<?php


namespace App\Repositories;



use App\Contracts\OrderContract;
use App\Models\Order;
use app\Traits\UploadAble;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class OrderRepository extends BaseRepositories implements OrderContract
{
    use UploadAble;

    /**
     * @param Order $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Order $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        $prefix = 'CO-';
        $month = now()->format('m');
        $day = now()->format('d');
        $incrementalValue = $this->model::whereDate('created_at', now()->toDateString())->count() + 1;
        $orderNumber = sprintf('%s%s%s-%03d', $prefix, $month, $day, $incrementalValue);
        $data['order_number'] = $orderNumber;
        $order = $this->model::create($data);

        return $order;
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
