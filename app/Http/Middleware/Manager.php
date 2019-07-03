<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Manager
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
        if(!User::isManager()) {
             return redirect('/dashboard');
        }
        return $next($request);
    }
}
