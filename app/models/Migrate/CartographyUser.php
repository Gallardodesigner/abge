<?php namespace Migrate;

class CartographyUser extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'usuario_cartografia';

    public $timestamps = false;

	public $primaryKey  = 'id_user';
	
}