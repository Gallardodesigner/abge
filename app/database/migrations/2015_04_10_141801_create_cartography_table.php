<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartographyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartography', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->text('work_title'); 				# titulo_trabajo
			$table->integer('year'); 					# ano
			$table->string('region');					# region
			$table->string('backyard');					# municipio
			$table->string('link');						# link_publicacion
			$table->string('scale'); 					# escala_trabajo
			$table->string('institution');				# institucion
			$table->string('pages');					# paginas
			$table->text('maps');						# mapas geraos
			$table->text('keywords');					# palabras_claves
			$table->string('geotechnical_testing');		# ensaios_geotecnicos
			$table->text('summary');					# resumen
			$table->string('locale');					# local_publicacion
			$table->string('subtitle');					# subtitle
			$table->string('concentration');			# ano_concentracao
			$table->string('teaching_unit');			# unidade_ensino
			$table->string('approval_year');			# ano_aprobacion
			$table->string('cartography_institution');	# institucion_carto
			$table->date('date');						# data
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
		Schema::drop('cartography');
	}

}
