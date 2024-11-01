<?php

namespace App\Contracts;

interface CategoryContract extends Base\CrudContract
{
    public function new(array $data);
}
