<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Authenticate;

class NONRememberMiddleware
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
        if(Auth::check() && $user = Auth::user()) {
            // User is logged in via remember (restore session twitter values)
            Authenticate::setTwitterSession($user->twitter);
        } else {
            // User isn't logged in
        }

        return $next($request);
    }
}
