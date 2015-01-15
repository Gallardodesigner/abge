<?php

class SFVideos extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'videos';

	public $primaryKey  = 'id_video';

	public $timestamps = false;
}