<?php

class Supporters extends Eloquent {

	public function courses(){
		return $this->belongsToMany('Courses', 'supporters', 'company_id', 'course_id');
	}

}
