<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('files', function($table){
			$table->increments('id');
			$table->integer('id_course');
			$table->integer('id_user');
			$table->integer('id_inscription');
			$table->string('type_user');
			$table->string('title');
			$table->string('url');
			$table->string('size');
			$table->string('mime');
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
		//
		Schema::dropIfExists('files');
	}

}
