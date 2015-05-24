<?php

class SFGallery extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'sf_album_content';

	public $primaryKey  = 'id_content';

	public $timestamps = false;

	public function album(){

		return $this->belongsTo('SFAlbum', 'id_album', 'id_album');

	}
	
}