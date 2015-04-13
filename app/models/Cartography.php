<?php

class Cartography extends \Eloquent {

	protected $connection = 'mysql';

	protected $table = 'cartography';

	public function user(){

		return $this->belongsTo('CartographyUser','user_id','id');

	}

	public function authors(){

		return $this->hasMany('CartographyAuthor', 'cartography_id', 'id');

	}

}