<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }
        if ($guard == "member" && Auth::guard($guard)->check()) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }

    // public function handle($request, Closure $next, $guard = null)
    // {

    //     $guards = empty($guards) ? [null] : $guards;
        
    //     if ($guard == "member" && Auth::guard($guard)->check()) {
    //         return redirect('/user/userDashboard');
    //     }
    //     else
    //     {
    //         return redirect('/home')->with('status',"Your are not allowed to Dashboard");
    //     }

    //      return $next($request);
    // }


}
