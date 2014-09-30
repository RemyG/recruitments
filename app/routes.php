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

Route::get('/login', 'UserController@getLogin');

Route::post('/login', 'UserController@postLogin');

Route::get('/logout', 'UserController@getLogout');

Route::get('/signup', 'UserController@getSignUp');

Route::post('/signup', 'UserController@postSignUp');

Route::group(array('before' => 'auth'), function() {
	Route::get('/', 'CompanyController@index');

	Route::resource('companies', 'CompanyController');

	Route::resource('employees', 'EmployeeController');

	Route::resource('contacts', 'ContactController');

	Route::get('/profile', 'UserController@show');

	Route::post('/profile', 'UserController@update');
});
