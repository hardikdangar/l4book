<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('credit', function($table)
	    {
	      $table->increments('id');
	      $table->string("rfrom",255);
	      $table->string("rto",255);
	      $table->string("price",255);
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
		Schema::drop('credit');
	}

}