<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckPremiumLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        $user = Auth::user()->premium_level;
        switch ($level) {
                    case 'starter':
                        return $user > 0 ? $next($request) : redirect('/signup/starter');
                        break;
                    case 'premium':
                        return $user > 1 ? $next($request) : redirect('/signup/premium');
                        break;
                    case 'platinum':
                        return $user > 2 ? $next($request) : redirect('/signup/platinum');
                        break;
                    default:
                        return $next($request);
                        break;
                }        
    }
}
