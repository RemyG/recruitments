<?php

class UserController extends \BaseController {

	public function getLogin()
	{
		return View::make('users.login');
	}

	public function postLogin()
	{
		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		$rememberme = Input::get('rememberme');

		/* Try to authenticate the credentials */
		if(Auth::attempt($userdata, ($rememberme == 'on' ? true : false))) {
			return Redirect::to('/');
		}
		else {
			return Redirect::to('login');
		}
	}

	public function getLogout()
	{
		if (Auth::check()) {
			Auth::logout();
		}
		return Redirect::to('login');
	}

}
