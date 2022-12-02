<?php

namespace App\Providers;

use App\Utility\Utility;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('utility',Utility::class);
//        View::composer(['categories.create','categories.edit','products.create','products.create'], function($view){
//            $view->with('utility',Utility::class);
//        });
    }
}
