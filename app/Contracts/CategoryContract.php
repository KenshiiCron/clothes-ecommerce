<?php

namespace App\Contracts;

interface CategoryContract extends Base\CrudContract
{
    public function new(array $data);

    public function update($model, array $data);

    public function destroy($model);

}
