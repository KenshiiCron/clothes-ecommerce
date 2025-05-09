<?php

namespace App\Traits;

use App\Repositories\BaseRepositories;
use Illuminate\Database\Eloquent\Model;

trait FindAbleTrait
{

    private bool $strict = true;

    protected Model $model;

    /**
     * @var int
     */
    private int $per_page;

     /**
     * @var string
     */
    private string $page_name;

    /**
     * @var array
     */
    private array $relations = [];

    /**
     * @var array
     */
    private array $columns = ['*'];

    /**
     * @var array
     */
    private array $scopes = [];

    /**
     * @var array
     */
    private array $counts = [];

    /**
     * @var array
     */
    private array $orders = [];

    private $query = null;

    /**
     * @param $id
     * @return mixed
     */
    public function findOneById($id): mixed
    {
        $this->prepagreQuery();

        return $this->getStrict()
            ? $this->query->findOrFail($id)
            : $this->query->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function findOneBy(array $params): mixed
    {
        $this->prepagreQuery();

        $this->query->where($params);
        return $this->getStrict()
            ? $this->query->firstOrFail()
            : $this->query->first();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function findBy(array $params): mixed
    {
        $this->prepagreQuery();

        $this->query->where($params);
        return $this->processQuery($this->query);
    }

    /**
     * @return mixed
     */
    public function findByFilter(): mixed
    {
        $this->prepagreQuery();

        return $this->processQuery($this->query);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function processQuery($query): mixed // Propose another name if you don't like it
    {
        $result = $this->applyFilter($query);

        foreach ($this->getOrders() as $key => $value) {
            $result->orderBy($key, $value);
        }

        if(empty($this->getOrders()))
        {
            $result->latest();
        }


        return $this->getPerPage() > 0 ? $result->paginate($this->getPerPage(),$this->getColumns(),$this->getPageName())->withQueryString() : $result->get();
    }

    /**
     * @param $per_page
     * @return FindAbleTrait|BaseRepositories
     */
    public function setPerPage($per_page): self
    {
        $this->per_page = is_numeric($per_page) ? $per_page : 10;
        return $this;
    }

    /**
     * @param $page_name
     * @return FindAbleTrait|BaseRepositories
     */
    public function setPageName($page_name): self
    {
        $this->page_name = !empty($page_name) ? $page_name : 'page';
        return $this;
    }


    /**
     * @param array $relations
     * @return FindAbleTrait|BaseRepositories
     */
    public function setRelations(array $relations = []): self
    {
        $this->relations = $relations;
        return $this;
    }

    /**
     * @param array $counts
     * @return FindAbleTrait|BaseRepositories
     */
    public function setCounts(array $counts = []): self
    {
        $this->counts = $counts;
        return $this;
    }

    /**
     * @param array $columns
     * @return FindAbleTrait|BaseRepositories
     */
    public function setColumns(array $columns = ['*']): self
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param array $scopes
     * @return FindAbleTrait|BaseRepositories
     */
    public function setScopes(array $scopes = []): self
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->per_page ?? 10;
    }

    /**
     * @return string
     */
    public function getPageName(): string
    {
        return $this->page_name ?? 'page';
    }

    /**
     * @return array
     */
    public function getRelations(): array
    {
        return $this->relations ?? [];
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns ?? ['*'];
    }

    /**
     * @return array
     */
    public function getScopes(): array
    {
        return $this->scopes ?? [];
    }

    /**
     * @return array
     */
    public function getCounts(): array
    {
        return $this->counts ?? [];
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param array $orders
     * @return FilterableTrait|BaseRepositories
     */
    public function setOrders(array $orders = ['created_at' => 'desc']): self
    {
        $this->orders = $orders;
        return $this;
    }

    public function setStrict(bool $strict): self
    {
        $this->strict = $strict;
        return $this;
    }

    public function getStrict(): bool
    {
        return $this->strict;
    }

    public function prepagreQuery()
    {
        $this->query->with($this->getRelations())
            ->select($this->getColumns())
            ->withCount($this->getCounts())
            ->scopes($this->getScopes());
    }

    public function getQuery()
    {
        return $this->query;
    }
}
