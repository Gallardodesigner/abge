<?php

class ORGNewsletter extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'newsletter';

    public $timestamps = false;

	public $primaryKey  = 'id_newsletter';

}