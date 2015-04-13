<?php namespace Migrate;

class Cartography extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'cartografia';

    public $timestamps = false;

	public $primaryKey  = 'id_cartografia';

}