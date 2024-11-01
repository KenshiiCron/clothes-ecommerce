<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected array $repos = [
        \App\Contracts\CategoryContract::class     => \App\Repositories\CategoryRepository::class,
        \App\Contracts\BrandContract::class     => \App\Repositories\BrandRepository::class,
        \App\Contracts\ProductContract::class     => \App\Repositories\ProductRepository::class,
        \App\Contracts\AttributeContract::class     => \App\Repositories\AttributeRepository::class,
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
