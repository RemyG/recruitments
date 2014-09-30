<?php

class CompanyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*$page = Input::get('page', 1);

		$data = Company::getByPage($page, 50);

		$companies = Paginator::make($data->items, $data->totalItems, 50);

		return View::make('companies.index', compact('companies'));*/

		$companies = User::find(Auth::id())->companies->sortBy('name');
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
		$rules = array(
			'name'	=> 'required|unique:companies,name,id,NULL,user_id,'.Auth::id()
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('companies/')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else {
			$company = new Company();
			$company->name = Input::get('name');
			$company->user_id = Auth::id();
			$company->save();
			Session::flash('message', 'Successfully created company!');
			return Redirect::to('companies/' . $company->id);
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
		$company = Company::find($id);

		$rules = array();

		// name has to be unique
		if (Input::get('name') != $company->name) {
			$rules['name'] = 'required|unique:companies,name,id,NULL,user_id,'.Auth::id();
		} else {
			$rules['name'] = 'required|exists:companies,name,id,NULL,user_id,'.Auth::id();
		}
		if (Input::get('website') != '') {
			$rules['website'] = 'url';
		}

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('companies/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$company = Company::find($id);
			$company->name = Input::get('name');
			$company->website = Input::get('website');
			$company->address = Input::get('address');
			$company->description = Input::get('description');
			$company->save();

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

		Session::flash('message', 'Successfully deleted the company!');
		return Redirect::to('companies');
	}


}
