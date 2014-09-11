<?php

class Teachers extends Eloquent {

	public function courses(){
		return $this->belongsToMany('Courses');
	}

}
