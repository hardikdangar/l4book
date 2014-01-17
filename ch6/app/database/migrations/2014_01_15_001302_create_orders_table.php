<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
		  $table->increments('id');
		  $table->integer('foldaram_id');
		  $table->integer("qty");
		  $table->integer("price");
		  $table->string("email",40);
		  $table->string("fullname",255);
		  $table->string("country",40);
		  $table->string("address_one",255);
		  $table->string("address_two",255);
		  $table->string("city",255);
		  $table->string("state",255);
		  $table->string("zipcode",255);
		  $table->integer("status");
		  $table->string("transection_id");
		  $table->timestamps();

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