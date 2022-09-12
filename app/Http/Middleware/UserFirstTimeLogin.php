<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserFirstTimeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(auth()->user()->is_first_time_login) {
            switch ($guard) {
                case config('backpack.base.guard'):
                    \Alert::warning("Please You Need To Change Your Password For First Time Login")->flash();
                    return redirect('backpack.account.info');  
                    break;
                case 'business-portal':
                    \Alert::warning("Please You Need To Change Your Password For First Time Login")->flash();
                    return redirect()->route('business-portal.account.info');
                    break;
                default:
            }
        }

        return $next($request);
    }
}
