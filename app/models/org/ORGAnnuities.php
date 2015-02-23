<?php

class ORGAnnuities extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'anuidades';

	public function categories(){
		return $this->hasMany('ORGAnnuityCategories', 'id_anuidade', 'id');
	}

	public function hasCategory( $category ){

		$bool = false;

		foreach( $this->categories as $cat ):

			if($cat->category->id == $category->id ):

				$bool = true;

			endif;

		endforeach;

		return $bool;

	}

}