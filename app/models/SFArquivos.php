<?php

class SFArquivos extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'sf_archivos_seccion';

	public $primaryKey  = 'id_archivo_seccion';

	public $timestamps = false;

}