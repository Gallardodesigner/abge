<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartographyUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartography_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');			# nome
			$table->string('username');		# username
			$table->string('email');		# email
			$table->string('password');		# senha md5
			$table->string('usertype');		# usertype
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
		Schema::drop('cartography_users');
	}

}
