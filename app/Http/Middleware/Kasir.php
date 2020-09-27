<?php

namespace App\Http\Middleware;

use Closure;

class Kasir
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
        if (!empty(auth()->user())) {
            if(auth()->user()->role == 'kasir'){
                return $next($request);
            }
        }
        return redirect('login')->with('error',"You don't have admin access.");
    }
}
