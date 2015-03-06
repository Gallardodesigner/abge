<?php

class ORGAssociateCategories extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'categoria_asociado';

    public $timestamps = false;

	public $primaryKey  = 'id_categoria_asociado';

	public function associates(){
		return $this->hasMany('ORGAssociates', 'categoria', 'id_categoria_asociado');
	}

	public function instruction(){
		return $this->hasOne('ORGInstructions', 'categoria', 'id_categoria_asociado');
	}
	
}
