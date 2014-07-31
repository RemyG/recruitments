<?php

class Company extends Eloquent {

	protected $table = 'companies';

	protected $fillable = array('name');

	public function employees() {
		return $this->hasMany('Employee');
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