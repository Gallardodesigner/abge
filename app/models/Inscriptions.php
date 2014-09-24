<?php

class Inscriptions extends Eloquent {
	protected $fillable = "inscriptions";

	public function course(){
		return $this->belongsTo('Courses', 'id_course');
	}

	public function usertype(){
		return $this->belongsTo('Courses', 'id_usertype');
	}

	public function user(){
		return $this->belongsTo('Courses', 'id_user');
	}
	
}