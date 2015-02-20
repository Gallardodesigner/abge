<?php

class ORGAnnuities extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'anuidades';

	public function categories(){
		return $this->hasMany('ORGAnnuityCategories', 'id_anuidade', 'id');
	}

}