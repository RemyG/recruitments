<?php

class EmployeeController extends \BaseController {

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
			'name'			=> 'required',
			'email'			=> 'email',
			'company_id'	=> 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('companies/' . Input::get('company_id'))
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$employee = new Employee;
			$employee->name       = Input::get('name');
			$employee->email      = Input::get('email');
			$employee->phone      = Input::get('phone');
			$employee->position   = Input::get('position');
			$employee->company_id = Input::get('company_id');
			$employee->save();

			// redirect
			Session::flash('message', 'Successfully created employee!');
			return Redirect::to('employees/' . $employee->id);
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
		$employee = Employee::find($id);

		return View::make('employees.show')
			->with('employee', $employee);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employee = Employee::find($id);
		return View::make('employees.edit')
			->with('employee', $employee);
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
			'name'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('employees/' . $id)
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$employee = Employee::find($id);
			$employee->name = Input::get('name');
			$employee->phone = Input::get('phone');
			$employee->email = Input::get('email');
			$employee->position = Input::get('position');
			$employee->save();

			// redirect
			Session::flash('message', 'Successfully updated employee!');
			return Redirect::to('employees/' . $id);
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
		$employee = Employee::find($id);
		$company_id = $employee->company_id;
		$employee->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the employee!');
		return Redirect::to('companies/' . $company_id);
	}


}
