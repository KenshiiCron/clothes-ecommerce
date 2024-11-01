<?php

namespace app\Traits;

use Illuminate\Routing\Pipeline;

trait FilterableTrait
{

    /**
     * @var array
     */
    protected array $filters;

    protected function applyFilter($query)
    {
        return app(Pipeline::class)
            ->send($query)
            ->through($this->filters)
            ->thenReturn();
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters ?? [];
    }

    public function setFilters(array $filters = []): self
    {
        $this->filters = $filters;
        return $this;
    }
}
