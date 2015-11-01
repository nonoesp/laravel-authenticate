<?php namespace Nonoesp\Authenticate\Controllers;

use Illuminate\Http\Request;
use User; // Must be defined in your aliases
use Redirect,
    Auth,
    Input,
    Session;

class AuthController extends Controller {

	public function getLogin()
	{
		if(Auth::check()) {
			return redirect(config('authenticate.destination'));
		}
		return view('authenticate::page.login')->with('auth_url', config('authenticate.entrance'));
	}

	public function postLogin()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$user = User::whereEmail($email)->first();

		if(Auth::attempt(array('email' => $email, 'password' => $password), true)) {
			// Save valid email and redirect to dashboard
			Session::put('email', $email);
			return Redirect::intended(config('authenticate.destination'));
		} else {
			return Redirect::route('getLogin')->with(array('error' => 'INVALID_CREDENTIALS', 'email' => $email));
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('getLogin')->with('title', 'See you later!');
	}

	public function getDashboard() {
		return view('authenticate::page.dashboard');
	}
}
