<?php

class Contact extends Eloquent {

	protected $table = 'contacts';

	protected $fillable = array('type', 'description', 'date', 'employee_id');

	public function employee() {
		return $this->belongsTo('Employee');
	}

}