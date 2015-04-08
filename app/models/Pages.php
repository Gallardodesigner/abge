<?php

class Pages extends \Eloquent {

	protected $connection = 'mysql';

	protected $table = 'pages';

	public $primaryKey  = 'id';

	public function parent(){

		return $this->belongsTo('Pages', 'id_parent','id');
		
	}

	public function children(){

		return $this->hasMany('Pages', 'id_parent','id');

	}

}