<?php namespace Nonoesp\Authenticate\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use URL;
use Twitter;
use Redirect;
use Input;
use User; // Must be defined in your aliases
use Auth;

class TwitterController extends Controller {

	public function login(Request $request)
	{
	 	// your SIGN IN WITH TWITTER button should point to this route
	    $sign_in_twitter = true;
	    $force_login = false;		

		$twitter_intended = Session::get('url.intended');		
		$URL_previous = \URL::previous();
		$path_previous = str_replace('/', '', parse_url(\URL::previous())['path']);
		$auth_entrance = config('authenticate.entrance');

		if($path_previous != $auth_entrance) {
			$twitter_intended = $URL_previous;
		}

		Session::put('twitter_intended', $twitter_intended);	

	    // Skip login with Twitter if user already logged in another page
	    if(Session::get('twitter_handle')) {
	    	return Redirect::back();
	    }

	    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
	    Twitter::reconfig(['token' => '', 'secret' => '']);
	    $token = Twitter::getRequestToken(route('twitter.callback'));

	    if (isset($token['oauth_token_secret']))
	    {
	        $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

	        Session::put('oauth_state', 'start');
	        Session::put('oauth_request_token', $token['oauth_token']);
	        Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

	        return Redirect::to($url);
	    }

	    return Redirect::route('twitter.error');
	}

	public function callback() {
	  	// You should set this route on your Twitter Application settings as the callback
	    // https://apps.twitter.com/app/YOUR-APP-ID/settings
	    if (Session::has('oauth_request_token'))
	    {
	        $request_token = [
	            'token'  => Session::get('oauth_request_token'),
	            'secret' => Session::get('oauth_request_token_secret'),
	        ];

	        Twitter::reconfig($request_token);

	        $oauth_verifier = false;

	        if (Input::has('oauth_verifier'))
	        {
	            $oauth_verifier = Input::get('oauth_verifier');
	        }

	        // getAccessToken() will reset the token for you
	        $token = Twitter::getAccessToken($oauth_verifier);

	        if (!isset($token['oauth_token_secret']))
	        {
	            return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
	        }

	        $credentials = Twitter::getCredentials();

	        if (is_object($credentials) && !isset($credentials->error))
	        {
	            // $credentials contains the Twitter user object with all the info about the user.
	            // Add here your own user logic, store profiles, create new users on your tables...you name it!
	            // Typically you'll want to store at least, user id, name and access tokens
	            // if you want to be able to call the API on behalf of your users.

	            // This is also the moment to log in your users if you're using Laravel's Auth class
	            // Auth::login($user) should do the trick.

	            if($user = User::whereTwitter($credentials->screen_name)->first()) {
	              Auth::login($user, true);
	            }

	            Session::put('twitter_handle', $credentials->screen_name);
	            Session::put('access_token', $token);

	            $destination = config("authenticate.destination"); // Default destination

	            if(Session::get('twitter_intended')) {
	              $destination = Session::get('twitter_intended');
	              Session::forget('twitter_intended');
	            }

	            return Redirect::to($destination)->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
	        }

	        return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
	    }		
	}
	
	public function error() {
		// Something went wrong, add your own error handling here
	}

}
