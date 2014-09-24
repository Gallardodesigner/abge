<?php

class UserTypes extends \Eloquent {

	protected $fillable = [];

	protected $table = 'usertypes';

	public function course(){
		return $this->belongsTo('Courses', 'course_id');
	}

	public function dates(){
		return $this->hasMany('Dates', 'usertype_id', 'id');
	}

	public function inscriptions(){
		return $this->hasMany('Inscriptions', 'id_usertype', 'id');
	}

}