<?php

class Dates extends \Eloquent {
	
	protected $fillable = [];

	public function usertype(){
		return $this->belongsTo('UserTypes', 'usertype_id');
	}

}