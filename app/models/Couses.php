<?php

class Courses extends Eloquent {

	protected $guarded = array();

	public function teachers(){
		return $this->belongsToMany('Teachers', 'course_teacher', 'course_id', 'teacher_id');
	}

}
