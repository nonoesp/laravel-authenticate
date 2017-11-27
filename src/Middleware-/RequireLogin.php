<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Redirect;
use Session;
use URL;

class RequireLogin
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
            Session::put('twitter_intended', URL::current());
            return Redirect::guest( '/'.config('authenticate.entrance') );
        }
        return $next($request);
    }
}