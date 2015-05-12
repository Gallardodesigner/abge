<?php

class ORGBackyards extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'logradouro';

    public $timestamps = false;

	public $primaryKey  = 'id_logradouro';
	
}
