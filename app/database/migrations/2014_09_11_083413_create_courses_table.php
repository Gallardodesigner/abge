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
			$table->longText('content');
			$table->longText('program');
			$table->longText('address');
			$table->longText('signin');
			$table->longText('associates_payment');
			$table->longText('participants_payment');
			$table->longText('associates_message');
			$table->longText('participants_message');
			$table->date('start');
			$table->date('end');
			$table->integer('min');
			$table->integer('max');
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
