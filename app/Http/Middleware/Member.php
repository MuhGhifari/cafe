<?php

namespace App\Http\Middleware;

use Closure;

class Member
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
            if(auth()->user()->role == 'member'){
                return $next($request);
            }else{
                return redirect('login');
            }
        }
        return redirect('login');
    }
}
