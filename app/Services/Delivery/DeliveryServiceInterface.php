<?php
namespace App\Services\Delivery;

interface DeliveryServiceInterface
{
    public function getShippingPrices();
    public function createShipment($order);
    public function trackShipment($trackingId);
}
