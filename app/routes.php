<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', function() {
	return View::make('users.login');
});

Route::post('login', function() {
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
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('login');
});

Route::group(array('before' => 'auth'), function() {
	Route::get('/', 'CompanyController@index');

	Route::resource('companies', 'CompanyController');

	Route::resource('employees', 'EmployeeController');

	Route::resource('contacts', 'ContactController');
});
