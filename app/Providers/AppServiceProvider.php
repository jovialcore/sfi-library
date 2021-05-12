<?php

namespace App\Providers;

use App\Models\category;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();
    }
}
