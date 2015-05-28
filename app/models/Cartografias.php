<?php

class Cartografias extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'cartografia';

	public $primaryKey  = 'id_cartografia';

	public $timestamps = false;

	public function usuario(){

		return $this->belongsTo('CartografiaUsuarios', 'id_user', 'id_user');

	}

}