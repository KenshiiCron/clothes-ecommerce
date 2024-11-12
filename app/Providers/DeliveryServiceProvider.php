<?php
namespace App\Providers;

use App\Services\Delivery\YalidineDeliveryService;
use App\Services\Delivery\ZRExpressDeliveryService;
use Illuminate\Support\ServiceProvider;
use App\Services\Delivery\DeliveryServiceInterface;

class DeliveryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DeliveryServiceInterface::class, function ($app, $params) {
            $selectedService = $params['service'] ?? config('delivery.default_service');

            switch ($selectedService) {
                case 'yalidine':
                    return new YalidineDeliveryService();
                case 'zr_express':
                    return new ZRExpressDeliveryService();
                default:
                    throw new \Exception("Invalid delivery service selected.");
            }
        });
    }
}
