<?php

namespace App\Http\Middleware;

use App\Http\Models\Cpanel\CPanelGeneralSettings;
use Closure;
use Illuminate\Support\Facades\Auth;

class ManageGeneralSettings
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
        if(Auth::user()->cannot('manage_general_settings', CPanelGeneralSettings::class)){
            abort(401);
        }
        return $next($request);
    }
}
