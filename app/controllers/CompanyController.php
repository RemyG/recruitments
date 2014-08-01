<?php

class CompanyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$companies = Company::orderBy('name')->get();
		return View::make('companies.index', array('companies' => $companies));
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
		$name = Input::get('name');
		$company = Company::firstOrCreate(array('name' => $name));
		return Redirect::to('companies');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = Company::find($id);
		return View::make('companies.show', array('company' => $company));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$company = Company::find($id);
		return View::make('companies.edit')
			->with('company', $company);
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
			return Redirect::to('companies/' . $id)
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$company = Company::find($id);
			$company->name = Input::get('name');
			$company->address = Input::get('address');
			$company->description = Input::get('description');
			$company->save();

			// redirect
			Session::flash('message', 'Successfully updated company!');
			return Redirect::to('companies/' . $id);
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
		$company = Company::find($id);
		$company->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the company!');
		return Redirect::to('companies');
	}


}
