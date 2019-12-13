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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            //...with this variable
            $view->with('current_user', \Auth::user());
            $view->with('home_page_data', get_data(1, 'page', ['slug', 'title']));
        });
    }
}
