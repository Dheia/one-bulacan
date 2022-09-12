<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsBusinessOwner
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
        if(!auth()->guard('business-portal')->check())
        {
            return redirect('one-portal/login');
        }
        if(!Auth::guard('business-portal')->user()->businessOwner) {
            abort(401);
        }

        return $next($request);
    }
}
