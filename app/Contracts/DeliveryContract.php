<?php

namespace App\Contracts;

interface DeliveryContract extends Base\CrudContract
{
    public function getParcels();

    public function getParcel($id);

    public function createParcel($data);

    public function getPricing();
}
