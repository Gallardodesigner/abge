<?php

class SFAlbum extends \Eloquent {
	protected $connection = 'mysql_2';

	protected $table = 'sf_album_content';

	public $primaryKey  = 'id_album';

	public $timestamps = false;
}