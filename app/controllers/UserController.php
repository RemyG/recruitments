<?php

class UserController extends \BaseController {

	public function getLogin()
	{
		return View::make('users.login');
	}

	public function postLogin()
	{
		$rules = array(
			'username'			=> 'required',
			'password'			=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

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
			return Redirect::to('login')
				->with('flash_error', 'Incorrect username / password combination.')
				->withInput(Input::all());
		}
	}

	public function getLogout()
	{
		if (Auth::check()) {
			Auth::logout();
		}
		return Redirect::to('login');
	}

	public function postSignUp()
	{
		$rules = array(
			'signup_username'			=> 'required|alpha_num|unique:users,username',
			'signup_password'			=> 'required|confirmed|min:8',
			'signup_email'				=> 'required|confirmed|email|unique:users,email'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator, 'signup')
				->withInput(Input::all());
		} else {
			$user = new User();
			$user->username = Input::get('signup_username');
			$user->password = Hash::make(Input::get('signup_password'));
			$user->email = Input::get('signup_email');
			$user->save();

			Auth::login($user);

			return Redirect::to('/');
		}
	}

	public function show()
	{
		$user = User::find(Auth::id());
		return View::make('users.edit')
			->with('user', $user);
	}

	public function update()
	{
		$rules = array(
			'username'			=> 'required|alpha_num|exists:users,username',
			'email'				=> 'required|email'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('profile')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$user = User::find(Auth::id());
			// Update the password
			if (Input::get('password') != '' && !Hash::check(Input::get('password'), $user->password)) {
				$rules = array(
					'password'			=> 'required|confirmed|min:8'
				);
				$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails()) {
					return Redirect::to('profile')
						->withErrors($validator)
						->withInput(Input::all());
				} else {
					$user->password = Hash::make(Input::get('password'));
				}
			}
			if (Input::get('email') != '' && Input::get('email') != $user->email) {
				$rules = array(
					'email'			=> 'required|email|unique:users,email'
				);
				$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails()) {
					return Redirect::to('profile')
						->withErrors($validator)
						->withInput(Input::all());
				} else {
					$user->email = Input::get('email');
				}
			}
			$user->save();

			return Redirect::to('profile');
		}
	}

}
