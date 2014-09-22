<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('dates', function($table){
			$table->increments('id');
			$table->integer('usertype_id');
			$table->longText('message');
			$table->longText('button');
			$table->date('start');
			$table->date('end');
//			$table->string('type');
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::dropIfExists('dates');

	}

}
