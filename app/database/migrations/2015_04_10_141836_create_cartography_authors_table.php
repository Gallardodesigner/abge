<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartographyAuthorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartography_authors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cartography_id');		# id_cartografia
			$table->string('first_name');			# nome
			$table->string('middle_name');			# nome_do_meio
			$table->string('last_name');			# sobrenome
			$table->string('institution');			# institucao
			$table->string('email');				# email	
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
		Schema::drop('cartography_authors');
	}

}
