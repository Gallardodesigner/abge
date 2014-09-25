<?php

class Files extends \Eloquent {
	protected $fillable = [];

	public function course(){
		return $this->belongsTo('Courses', 'id_course');
	}

	public function inscription(){
		return $this->belongsTo('Inscriptions', 'id_inscription');
	}

	public function user(){
		return $this->belongsTo('User', 'id_user');
	}

}