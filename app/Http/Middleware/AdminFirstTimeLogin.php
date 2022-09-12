<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminFirstTimeLogin
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

        if (backpack_user()->is_first_time_login) {
            \Alert::warning("Please You Need To Change Your Password For First Time Login")->flash();
            return redirect()->route('backpack.account.info');  
        }

        return $next($request);
    }
}
