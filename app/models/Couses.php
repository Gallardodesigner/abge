<?php

class Courses extends Eloquent {

	public function teachers(){
		return $this->belongsToMany('Teachers');
	}

}
