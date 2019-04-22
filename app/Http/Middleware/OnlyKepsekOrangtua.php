<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OnlyKepsekOrangtua
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
        if(Auth::user()->level =="kepala_sekolah" || Auth::user()->level =="orang_tua" )
        {
           
        } else 
        {
            return redirect('/');
        }

        return $next($request);
    }
}
