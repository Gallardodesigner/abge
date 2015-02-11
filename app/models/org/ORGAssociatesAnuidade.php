<?php

class ORGAssociatesAnuidade extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'anuidade_asosiado';

    public $timestamps = false;

	public $primaryKey  = 'id_asociado';
}
