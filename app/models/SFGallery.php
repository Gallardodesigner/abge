<?php

class SFGallery extends \Eloquent {
	protected $connection = 'mysql_2';

	protected $table = 'id_album_content';

	public $primaryKey  = 'id_content';

	public $timestamps = false;
}