<?php

class Companies extends Eloquent {

	public function courses(){
		return $this->hasMany('Courses', 'company_id', 'id');
	}

}
