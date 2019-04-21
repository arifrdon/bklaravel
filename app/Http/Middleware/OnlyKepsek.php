<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OnlyKepsek
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
        if(Auth::user()->level =="kepala_sekolah")
        {
            
        } else 
        {
            return redirect('/');
        }
        return $next($request);
    }
}
