<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OnlyAdminGurubkGuru
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
        
        if(Auth::user()->level =="admin" || Auth::user()->level =="guru_bk" || (Auth::user()->level =="guru" && config('wali_list')->contains(Auth::user()->id)) )
        {
           
        } else 
        {
            return redirect('/');
        }

        return $next($request);
    }
}
