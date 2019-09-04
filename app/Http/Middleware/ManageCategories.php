<?php

namespace App\Http\Middleware;

use App\Http\Models\Category;
use Closure;
use Illuminate\Support\Facades\Auth;

class ManageCategories
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

        if(Auth::user()->cannot('manage_post_categories', Category::class)){
            abort(401);
        }
        return $next($request);

    }
}
