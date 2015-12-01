<?php

namespace Nonoesp\Authenticate;
use Route,
    Auth,
    Redirect,
    Config,
    Session,
    HTML,
    Article,
    Markdown;

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

/*----------------------------------------------------------------*/
/* TwitterController
/*----------------------------------------------------------------*/

Route::get('twitter/login', ['as' => 'twitter.login', 'uses' => 'Nonoesp\Authenticate\Controllers\TwitterController@login']);
Route::get('twitter/callback', ['as' => 'twitter.callback', 'uses' => 'Nonoesp\Authenticate\Controllers\TwitterController@callback']);
Route::get('twitter/error', ['as' => 'twitter.error', 'uses' => 'Nonoesp\Authenticate\Controllers\TwitterController@error']);

/*----------------------------------------------------------------*/

// Temporary URL

Route::get('twitter/data', function(){
    if(Session::get('twitter_handle')) {
      echo "Hi, ". Session::get('twitter_handle') .'! '.HTML::link('/logout', "logout");      
    } else {
      echo "You are not logged! ".HTML::link('/twitter/login', "log in").".";
    }
});