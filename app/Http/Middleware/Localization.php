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

        if(empty($locale)) $locale = \Config::get('app.locale');

        if(!empty($request->route('lang')))
        {
            $locale = $request->route('lang');
            \Session::put('locale', $locale);
        }

        if(lang_exist($locale))
        {
            \App::setLocale($locale);
        }
        else{
            \Session::put('locale', \Config::get('app.locale'));
        }

        return $next($request);

    }
}
