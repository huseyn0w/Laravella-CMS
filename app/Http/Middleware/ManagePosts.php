<?php

namespace App\Http\Middleware;

use App\Http\Models\Post;
use Closure;
use Illuminate\Support\Facades\Auth;

class ManagePosts
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
        if(Auth::user()->cannot('manage_posts', Post::class)){
            abort(401);
        }
        return $next($request);
    }
}
