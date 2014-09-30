<?php

class Company extends Eloquent {

	protected $table = 'companies';

	protected $fillable = array('name', 'website', 'address', 'description');

	public function employees() {
		return $this->hasMany('Employee');
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function getByPage($page = 1, $limit = 10)
	{
		$results = StdClass;
		$results->page = $page;
		$results->limit = $limit;
		$results->totalItems = 0;
		$results->items = array();

		$users = $this->model->skip($limit * ($page - 1))->take($limit)->get();

		$results->totalItems = $this->model->count();
		$results->items = $users->all();

		return $results;
	}

	public static function boot() {
		parent::boot();

		static::deleted(function($company) {
			foreach ($company->employees as $employee) {
				$employee->delete();
			}
		});
	}

}