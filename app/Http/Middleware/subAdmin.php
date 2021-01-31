<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class subAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth::user()->usertype=='subadmin')
        {
            return $next($request);           
        }
        else
        {
            return redirect('/home')->with('status',"Your are not allowed to Dashboard");
        }
    }
}
