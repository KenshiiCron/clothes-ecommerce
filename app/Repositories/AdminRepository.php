<?php


namespace App\Repositories;


use App\Contracts\AdminContract;
use App\Models\Admin;
use app\Traits\UploadAble;
use JetBrains\PhpStorm\Pure;

class AdminRepository extends BaseRepositories implements AdminContract
{
    use UploadAble;

    /**
     * @param Admin $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(Admin $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    public function new(array $data)
    {
        if (array_key_exists('image', $data) && isset($data['image'])) {
            $data['image'] = $this->uploadOne($data['image'], ((new \ReflectionClass($this->model))->getShortName()) . '/image', 'public');
        }

        $data['password'] = bcrypt($data['password']);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('store')
            ->log('created: '. $this->model);

        $admin = $this->model::create($data);
        $admin->assignRole($data['roles']);
        return $admin;
    }

    public function update($model,array $data )
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

//        if (array_key_exists('image', $data) && isset($data['image'])) {
//            if ($model->image) {
//                $this->deleteOne($model->image);
//            }
//            $data['image'] = $this->uploadOne($data['image'], (new \ReflectionClass($this->model))->getShortName() . '/image', 'public');
//        } else {
//            $data['image'] = $model->image;
//        }


        $model->update($data);
        if (array_key_exists('roles',$data))
        {
            $model->syncRoles($data['roles']);
        }

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('update')
            ->log('edited: '. $this->model);

        return $model->refresh();
    }

    public function destroy($model)
    {
        $model = $model instanceof $this->model ? $model : $this->findOneById($model);

        if ($model->image)
        {
            $this->deleteOne($model->image);
        }

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->model)
            ->event('destroy')
            ->log('deleted: '. $this->model);

        return $model ->delete();
    }

}
