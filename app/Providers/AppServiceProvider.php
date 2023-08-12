<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = [];
        try{
            Paginator::useBootstrap();
            $categories = Category::orderByDesc('id')->get();
        }catch (\Exception $exception){

        }

        \View::share('categoriesGlobal', $categories);
    }
}
