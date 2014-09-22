<?php

class Inscriptions extends Eloquent {
	protected $fillable = "inscriptions";

	public function participants(){
		return $this->belongsToMany('Participants', 'course_teacher', 'course_id', 'teacher_id');
	}

	public function courses(){
		return $this->belongsToMany('Courses', 'course_teacher', 'course_id', 'teacher_id');
	}
}