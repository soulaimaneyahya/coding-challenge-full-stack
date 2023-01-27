<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(RepositoryInterface::class, fn () => new ProductRepository());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // schema length default & use uuid as default mophid
        Schema::defaultStringLength(191);
        Builder::defaultMorphKeyType('uuid');

        // pagination
        Paginator::useBootstrap();
    }
}
