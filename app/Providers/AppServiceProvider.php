<?php

namespace App\Providers;

use App\Models\category;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $AllCategories = category::all();
        View::share('cats', $AllCategories);
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
