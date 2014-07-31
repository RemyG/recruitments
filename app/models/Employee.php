<?php

class Employee extends Eloquent {

	protected $table = 'employees';

	protected $fillable = array('name', 'email', 'phone', 'position', 'company_id');

	public function company() {
		return $this->belongsTo('Company');
	}

	public function contacts() {
		return $this->hasMany('Contact');
	}

	public static function boot() {
		parent::boot();

		static::deleted(function($employee) {
			$employee->contacts()->delete();
		});
	}

}