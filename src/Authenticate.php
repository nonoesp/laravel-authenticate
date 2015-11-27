<?php namespace Nonoesp\Authenticate;
 
use Session;

class Authenticate {
	public static function isUserLoggedInTwitter() {
		if($twitter_handle = Session::get('twitter_handle')) {
			return $twitter_handle;
		} else {
			return false;
		}
	}	
}