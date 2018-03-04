<?php

namespace App\Http\Middleware;
use Config;
use Closure;

class isActiveMiddleware
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
        if(Config::get('app.login')){

        }else
            return $next($request);
        
    }
}
