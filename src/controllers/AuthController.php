<?php namespace Nonoesp\Authenticate;


class AuthController extends \BaseController {

	public function getLogin()
	{
		if(\Auth::check()) {
			return \Redirect::route('getDashboard');
		}
		return \View::make('authenticate::page.login')->with('auth_url', 'login');
	}

	public function postLogin()
	{
		$email = \Input::get('email');
		$password = \Input::get('password');
		$user = \User::whereEmail($email)->first();

		if(\Auth::attempt(array('email' => $email, 'password' => $password), true)) {
			// Save valid email and redirect to dashboard
			\Session::put('email', $email);
			return \Redirect::intended(\Config::get('authenticate::default-access'));
		} else {
			return \Redirect::route('getLogin')->with(array('error' => 'INVALID_CREDENTIALS', 'email' => $email));
		}
	}

	public function getLogout()
	{
		\Auth::logout();
		return \Redirect::route('getLogin')->with('title', 'See you later!');
	}

	public function getDashboard() {
		return \View::make('authenticate::page.dashboard');
	}
}
