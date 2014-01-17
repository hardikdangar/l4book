<?php

use Illuminate\Database\Migrations\Migration;

class AddUserTableColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('users', function($table)
		{
			$table->integer('credit');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}