<?php

class ORGuf extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'uf';

    public $timestamps = false;

	public $primaryKey  = 'id_uf';

	public function towns(){

		return $this->hasMany('ORGTowns', 'id_uf', 'id_uf');
		
	}

}