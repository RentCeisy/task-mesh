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
        $this->app->bind('App\Repositories\Lib\ProductRepository',
            'App\Repositories\ProductQuery');

        $this->app->bind('App\Repositories\Lib\CategoryRepository',
            'App\Repositories\CategoryQuery');

        $this->app->bind('App\Services\Lib\ProductServiceImpl',
            'App\Services\ProductService');

        $this->app->bind('App\Services\Lib\CategoryServiceImpl',
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
