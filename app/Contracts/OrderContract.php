<?php

namespace App\Contracts;

interface OrderContract extends Base\CrudContract
{
    public function new(array $data);

    public function update($model, array $data);

    public function destroy($model);

}
