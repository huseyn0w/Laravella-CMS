<?php

namespace App\Providers;

use App\Http\Models\Page;
use App\Http\Models\Post;
use App\Http\Models\User;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        Post::observe(PostObserver::class);
        Page::observe(PageObserver::class);
        User::observe(UserObserver::class);
    }


}
