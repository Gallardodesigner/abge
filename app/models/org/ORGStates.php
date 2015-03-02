<?php

class ORGStates extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'estados';

	public $primaryKey  = 'id_estados';

    public $timestamps = false;
	
}
