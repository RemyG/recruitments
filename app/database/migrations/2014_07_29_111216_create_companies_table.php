<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('website')->default('');
			$table->text('address')->default('');
			$table->text('description')->default('');
			$table->integer('user_id');
			$table->timestamps();
			$table->unique(array('name', 'user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
