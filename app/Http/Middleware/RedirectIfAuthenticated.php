<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        // return $next($request);
        // dd($guard);
        switch ($guard) {
            case config('backpack.base.guard'):
                return !backpack_auth()->check() ? $next($request) : redirect(backpack_url());  
                break;

            case 'business-portal': 
                return !Auth::guard($guard)->check() ? $next($request) : redirect('one-portal/dashboard');
                break;
            default:
        }

        // return $next($request);
    }
}
