<?php

/*----------------------------------------------------------------*/
/* AuthController
/*----------------------------------------------------------------*/

Route::get('login', array('as' => 'getLogin', 'uses' => 'Nonoesp\Authenticate\AuthController@getLogin'));
Route::post('login', 'Nonoesp\Authenticate\AuthController@postLogin');
Route::get('logout', array('as' => 'getLogout', 'uses' => 'Nonoesp\Authenticate\AuthController@getLogout'));
Route::get('dashboard', array('before' => 'is_admin', 'as' => 'getDashboard', 'uses' => 'Nonoesp\Authenticate\AuthController@getDashboard'));

// Filters

Route::filter('is_admin', function()
{
  if(Auth::check()) {
     if (!Auth::user()->is_admin)
      {
        return Redirect::guest('/login');
      }
    } else {
        return Redirect::guest('/login');
    }
});