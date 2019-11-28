<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $locale = session('locale');
        if(lang_exist($locale))
        {
            \App::setLocale(session('locale'));
        }
        else{
            \Session::put('locale', \Config::get('app.locale'));
        }
        //dd('test');
        return $next($request);

    }
}
