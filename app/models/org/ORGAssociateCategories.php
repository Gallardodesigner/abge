<?php

class ORGAssociateCategories extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'categoria_asociado';

    public $timestamps = false;

	public $primaryKey  = 'id_categoria_asociado';
	
}
