<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCreditOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('usercreditorders', function($table)
	    {
	      $table->increments('id');
	      $table->integer('user_id');
	      $table->integer('qty');
	      $table->integer('price');
	      $table->string("email",255);
	      $table->boolean('status', array('0', '1'))->default(0);
	      $table->string("transection_id",255);
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
		Schema::drop('usercreditorders');
	}

}