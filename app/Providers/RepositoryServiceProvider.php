<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected array $repos = [
        \App\Contracts\UserContract::class     => \App\Repositories\UserRepository::class,
        \App\Contracts\CategoryContract::class     => \App\Repositories\CategoryRepository::class,
        \App\Contracts\BrandContract::class     => \App\Repositories\BrandRepository::class,
        \App\Contracts\ProductContract::class     => \App\Repositories\ProductRepository::class,
        \App\Contracts\AttributeContract::class     => \App\Repositories\AttributeRepository::class,
        \App\Contracts\AttributeValueContract::class     => \App\Repositories\AttributeValueRepository::class,
        \App\Contracts\InventoryContract::class     => \App\Repositories\InventoryRepository::class,
        \App\Contracts\OrderContract::class     => \App\Repositories\OrderRepository::class,
        \App\Contracts\ImageContract::class     => \App\Repositories\ImageRepository::class,
        \App\Contracts\CarouselContract::class     => \App\Repositories\CarouselRepository::class,
        \App\Contracts\AdminContract::class     => \App\Repositories\AdminRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repos as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
