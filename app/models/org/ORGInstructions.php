<?php

class ORGInstructions extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'instrucciones_boleto';

    public $timestamps = false;

	public $primaryKey  = 'id';

	public function category(){
		return $this->belonsTo('ORGAssociateCategories', 'categoria', 'id_categoria_asociado');
	}

}