<?php
namespace Arma\Http\Middleware;
use Closure;
use Auth;
use Redirect;
class LoginMiddleware
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
        if(!Auth::check()) {
            return Redirect::guest( '/'.config('authenticate.entrance') );
        }
        return $next($request);
    }
}
