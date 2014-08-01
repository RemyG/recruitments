<?php

class ContactController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'employee_id'	=> 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('employees/' . Input::get('employee_id'))
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$contact = new Contact;
			$date = Input::get('date');
			$contact->date       = date("Y-m-d", strtotime($date));
			$contact->type      = Input::get('type');
			$contact->description      = Input::get('description');
			$contact->employee_id   = Input::get('employee_id');
			$contact->save();

			// redirect
			Session::flash('message', 'Successfully created contact!');
			return Redirect::to('employees/' . Input::get('employee_id'));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contact = Contact::find($id);
		return View::make('contacts.edit')
			->with('contact', $contact);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'date'       => 'required',
			'type'		=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('contacts/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$contact = Contact::find($id);
			$date = Input::get('date');
			$contact->date       = date("Y-m-d", strtotime($date));
			$contact->type      = Input::get('type');
			$contact->description      = Input::get('description');
			$contact->save();

			// redirect
			Session::flash('message', 'Successfully updated contact!');
			return Redirect::to('employees/' . Input::get('employee_id'));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$contact = Contact::find($id);
		$employee_id = $contact->employee_id;
		$contact->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the contact!');
		return Redirect::to('employees/' . $employee_id);
	}


}
