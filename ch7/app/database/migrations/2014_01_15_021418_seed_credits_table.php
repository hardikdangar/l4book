<?php

use Illuminate\Database\Migrations\Migration;

class SeedCreditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('credit')->insert(
		                        array(
		                                array(
		                                        'rfrom' => '1',
		                                        'rto' => '4',
		                                        'price'  => '4'
		                                ),
		                                array(
		                                        'rfrom' => '5',
		                                        'rto' => '9',
		                                        'price'  => '3.7'
		                                ),
		                                array(
		                                        'rfrom' => '10',
		                                        'rto' => '25',
		                                        'price'  => '3.5'
		                                ),
		                                array(
		                                        'rfrom' => '26',
		                                        'rto' => '50',
		                                        'price'  => '3'
		                                ),

		                        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('credit')->delete();

	}

}