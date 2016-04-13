<?php namespace Nonoesp\Authenticate;
 
use Session;
use Auth;

class Authenticate {
	public static function isUserLoggedInTwitter() {
		if($twitter_handle = Session::get('twitter_handle')) {
			return $twitter_handle;
		} else {
			return false;
		}
	}

	public static function setTwitterHandle($twitter_handle) {
		Session::put('twitter_handle', $twitter_handle);
		if($user = Auth::user()) {
			Session::put('twitter_image', $user->twitter_image);
		}
	}
}