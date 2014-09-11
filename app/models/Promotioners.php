<?php

class Promotioners extends Eloquent {

	public function courses(){
		return $this->belongsToMany('Courses', 'promotioners', 'company_id', 'course_id');
	}

}
