<?php

class ORGTowns extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'municipio';

	public $primaryKey  = 'id_municipio';

    public $timestamps = false;
	
}
