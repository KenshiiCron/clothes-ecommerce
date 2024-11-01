<?php

namespace App\Contracts;

interface CarouselContract extends Base\CrudContract
{
    public function new(array $data);

    public function update($model, array $data);

    public function destroy($model);
}
