<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('courses', function($table){
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->longText('header');
			$table->longText('address');
			$table->date('start');
			$table->date('end');
			$table->integer('min');
			$table->integer('max');
			$table->longText('min_message');
			$table->longText('max_message');
			$table->integer('company_id');
			$table->integer('category_id');
			$table->integer('event_id');
			$table->string('type');
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
		Schema::dropIfExists('courses');
	}

}
