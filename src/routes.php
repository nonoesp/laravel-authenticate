<?php

namespace Nonoesp\Authenticate;
use Route,
    Auth,
    Redirect,
    Config,
    Session,
    Html,
    Article,
    Markdown;

Route::group(['middleware' => config("authenticate.middlewares")], function () {

  /*----------------------------------------------------------------*/
  /* AuthController
  /*----------------------------------------------------------------*/

  // Entrance: Login
  Route::get(config('authenticate.entrance'), ['as' => 'auth.login', 'uses' => 'Nonoesp\Authenticate\Controllers\AuthController@getLogin']);
  Route::post(config('authenticate.entrance'), 'Nonoesp\Authenticate\Controllers\AuthController@postLogin');

  // Exit: Logout
  Route::get(config('authenticate.exit'), ['as' => 'auth.logout', 'uses' => 'Nonoesp\Authenticate\Controllers\AuthController@getLogout']);

  /*----------------------------------------------------------------*/
  /* TwitterController
  /*----------------------------------------------------------------*/

  // Route::get('twitter/login', ['as' => 'twitter.login', 'uses' => 'Nonoesp\Authenticate\Controllers\TwitterController@login']);
  // Route::get('twitter/callback', ['as' => 'twitter.callback', 'uses' => 'Nonoesp\Authenticate\Controllers\TwitterController@callback']);
  // Route::get('twitter/error', ['as' => 'twitter.error', 'uses' => 'Nonoesp\Authenticate\Controllers\TwitterController@error']);

  /*----------------------------------------------------------------*/
  /* Temporary URL for debugging Twitter
  /*----------------------------------------------------------------*/

  // Route::get('twitter/data', function(){

  //     if(Session::get('twitter_handle')) {
  //       echo "Hi, ". Session::get('twitter_handle') .'! '.Html::link('/logout', "logout");      
  //     } else {
  //       echo "You are not logged! ".Html::link('/twitter/login', "log in").".";
  //     }
  // });

});