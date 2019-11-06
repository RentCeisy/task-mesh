<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Impl\ProductRepository',
            'App\Repositories\ProductQuery');

        $this->app->bind('App\Repositories\Impl\CategoryRepository',
            'App\Repositories\CategoryQuery');

        $this->app->bind('App\Services\Impl\ProductServiceImpl',
            'App\Services\ProductService');

        $this->app->bind('App\Services\Impl\CategoryServiceImpl',
            'App\Services\CategoryService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
