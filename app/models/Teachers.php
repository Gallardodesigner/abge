<?php

class Teachers extends Eloquent {
	
	protected $guarded = array();

	public function courses(){
		return $this->belongsToMany('Courses', 'course_teacher', 'teacher_id', 'course_id');
	}

}
