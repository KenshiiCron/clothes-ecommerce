<?php


namespace App\Contracts\Base;


interface CrudContract
{

    /**
     * @param bool $strict
     * @return mixed
     */
    public function setStrict(bool $strict): mixed;

    /**
     * @param $per_page
     * @return mixed
     */
    public function setPerPage($per_page);

    /**
     * @param $page_name
     * @return mixed
     */
    public function setPageName($page_name);

    /**
     * @param array $relations
     * @return mixed
     */
    public function setRelations(array $relations = []);

    /**
     * @param array $counts
     * @return mixed
     */
    public function setCounts(array $counts = []);

    /**
     * @param array $columns
     * @return mixed
     */
    public function setColumns(array $columns = ['*']);

    /**
     * @param array $orders
     * @return mixed
     */
    public function setOrders(array $orders = ['created_at' => 'desc']);

    /**
     * @param array $scopes
     * @return mixed
     */
    public function setScopes(array $scopes = []);

    /**
     * @param array $filters
     * @return mixed
     */
    public function setFilters(array $filters = []);

    /**
     * @param $id
     * @return mixed
     */
    public function findOneById($id);

    /**
     * @param array $params
     * @return mixed
     */
    public function findOneBy(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function findBy(array $params);

    /**
     * @return mixed
     */
    public function findByFilter();

    /**
     * @param array $data
     * @return mixed
     */
    public function new(array $data);

    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function update($model, array $data);

    /**
     * @param $model
     * @return mixed
     */
    public function destroy($model);


}
