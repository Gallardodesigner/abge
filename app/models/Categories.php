<?php

class Categories extends Eloquent {

	public function courses(){
		return $this->hasMany('Courses', 'category_id', 'id');
	}

}
