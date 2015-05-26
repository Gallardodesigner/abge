<?php

class Cartografias extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'cartografia';

	public $primaryKey  = 'id_cartografia';

	public $timestamps = false;

}