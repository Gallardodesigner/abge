<?php

class Courses extends Eloquent {

	protected $guarded = array();

	public function teachers(){
		return $this->belongsToMany('Teachers', 'course_teacher', 'course_id', 'teacher_id');
	}

	public function promotioners(){
		return $this->belongsToMany('Companies', 'promotioners', 'course_id', 'company_id');
	}

	public function supporters(){
		return $this->belongsToMany('Companies', 'supporters', 'course_id', 'company_id');
	}

	public function category(){
		return $this->belongsTo('Categories', 'category_id');
	}

	public function company(){
		return $this->belongsTo('Companies', 'company_id');
	}
/*
	public function promotioners(){
		return $this->hasMany('Promotioners', 'course_id');
	}

	public function supporters(){
		return $this->hasMany('Supporters', 'course_id');
	}
*/
}
