<?php

class SFNews extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'sf_news';

	public $primaryKey  = 'id_news';

	public $timestamps = false;

}