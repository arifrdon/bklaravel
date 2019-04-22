<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OnlyAdminGurubk
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
        if(Auth::user()->level =="admin" || Auth::user()->level =="guru_bk" )
        {
           
        } else 
        {
            return redirect('/');
        }
        return $next($request);
    }
}
