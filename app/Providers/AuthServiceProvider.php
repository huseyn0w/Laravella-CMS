<?php

namespace App\Providers;


use App\Http\Models\CPanel\CPanelGeneralSettings;
use App\Http\Models\Page;
use App\Http\Models\Post;
use App\Http\Models\User;
use App\Http\Models\UserRoles;
use App\Http\Models\CPanel\CPanelCategory;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        CPanelGeneralSettings::class => UserPolicy::class,
        User::class => UserPolicy::class,
        UserRoles::class => UserPolicy::class,
        Page::class => UserPolicy::class,
        CPanelCategory::class => UserPolicy::class,
        Post::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view)
        {
            if(Auth::check()) $view->with('username', Auth::user()->name);
            //...with this variable

        });
        $this->registerPolicies();

        //
    }
}
