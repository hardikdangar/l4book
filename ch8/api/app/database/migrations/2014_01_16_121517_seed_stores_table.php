<?php

use Illuminate\Database\Migrations\Migration;

class SeedStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('stores')->insert(
			array(
			        array(
						"name" => "NY store",
						"address" => "times square",
						"city" =>  "new york",
						"zip" =>  "10032",
						"state" =>  "NY",
						"country" =>  "usa",
						"latitude" =>  "40.6700",
						"longitude" =>  "73.9400",
						"support_phone" => "123 456 7891",
						"support_email" => "support@email.com",
						"user_id" =>  "1"
			        ),
			        array(
						"name" => "London store",
						"address" => "30 Leicester Square",
						"city" =>  "London",
						"zip" =>  "WC2H 7LA",
						"state" =>  "London",
						"country" =>  "UK",
						"latitude" =>  "40.6700",
						"longitude" =>  "73.9400",
						"support_phone" => "123 456 7891",
						"support_email" => "support@email.com",
						"user_id" =>  "1"
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
		//
	}

}