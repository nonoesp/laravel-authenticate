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
			} else {
				return redirect(\URL::previous());
			}
		}
        return view('authenticate::page.login', [
            'auth_url' => config('authenticate.entrance'),
        ]);
	}

	public function postLogin(Request $request)
	{
        $email_key = 'email';

        // Get form inputs
		$email = $request->input($email_key);
		$password = $request->input('password');
		$user = User::whereEmail($email)->first();

        // Keep email
        session([$email_key => $email]);

		if(Auth::attempt([$email_key => $email, 'password' => $password], true)) {
			// Save valid email and redirect to dashboard
			if($twitter_handle = $user->twitter) { 
				session(['twitter_handle' => $twitter_handle]);
			}

			return redirect()->intended(config('authenticate.destination'));
		} else {
			return Redirect::route('getLogin')->with([
                'error' => 'INVALID_CREDENTIALS',
                $email_key => $email
            ]);
		}
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
			return Redirect::route('getLogin')->with('title', 'See you later!');
	    }

	    return Redirect::to($previous);
	}

	public function getDashboard() {
		return view('authenticate::page.dashboard');
	}
}
