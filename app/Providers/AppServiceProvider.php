<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Lib\ProductRepository;
use App\Repositories\ProductQuery;

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
