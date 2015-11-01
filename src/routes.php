<?php

namespace Nonoesp\Authenticate;
use Route;
use Auth;
use Redirect;
use Config;

/*----------------------------------------------------------------*/
/* AuthController
/*----------------------------------------------------------------*/

$entrance = config('authenticate.entrance');
$exit = config('authenticate.exit');
$destination = config('authenticate.destination');

// Entrance: Login
Route::get(config('authenticate.entrance'), array('as' => 'getLogin', 'uses' => 'Nonoesp\Authenticate\Controllers\AuthController@getLogin'));
Route::post(config('authenticate.entrance'), 'Nonoesp\Authenticate\Controllers\AuthController@postLogin');

// Exit: Logout
Route::get('logout', array('as' => 'getLogout', 'uses' => 'Nonoesp\Authenticate\Controllers\AuthController@getLogout'));

// Sample dashboard
Route::get('dashboard', array('before' => 'is_admin', 'as' => 'getDashboard', 'uses' => 'Nonoesp\Authenticate\Controllers\AuthController@getDashboard'));

// Filter
Route::filter('is_admin', function()
{
  if(Auth::check()) {
     if (!Auth::user()->is_admin)
      {
        return Redirect::guest(config('authenticate.entrance'));
      }
    } else {
        return Redirect::guest(config('authenticate.entrance'));
    }
});