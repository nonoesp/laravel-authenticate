<?php namespace Nonoesp\Authenticate\Controllers;

use Illuminate\Http\Request;
use User; // Must be defined in your aliases
use Redirect,
    Auth,
    Input,
    Session,
    URL;


class AuthController extends Controller {

	public function getLogin()
	{
		if(Auth::check()) {
			
			$entrance_url = \App::make('url')->to(config('authenticate.entrance'));
			$previous_url = \URL::previous();
			
			if($entrance_url == $previous_url) {
				return redirect(config('authenticate.destination'));
			}
			return redirect(\URL::previous());
		}
        return view('authenticate::page.login', [
            'auth_url' => config('authenticate.entrance'),
        ]);
	}

	public function postLogin(Request $request)
	{
        // Get form inputs
		$email = $request->input('email');
		$password = $request->input('password');

        // Keep email
		session(['email' => $email]);

		if(Auth::attempt(['email' => $email, 'password' => $password], true)) {
			// Get Twitter handle
			$user = User::whereEmail($email)->first();
			if($twitter_handle = $user->twitter) { 
				session(['twitter_handle' => $twitter_handle]);
			}
			// Redirect to dashboard or intended URL
			return redirect()->intended(config('authenticate.destination'));
		}
		return redirect(route('auth.login'))->with('error', 'INVALID_CREDENTIALS');
	}

	public function getLogout()
	{
		// Auth
		Auth::logout();

		// Twitter
		Session::forget('access_token');
	    Session::forget('twitter_handle');
	    Session::forget('twitter_image');	    
	    Session::forget('twitter_intended');

	    $previous = URL::previous();
	    
	    if($previous == URL::to('/dashboard')) {
			return redirect()->route('auth.login')->with('title', 'See you later!');
	    }

	    return Redirect::to($previous);
	}

}
