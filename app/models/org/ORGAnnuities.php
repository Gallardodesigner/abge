<?php

class ORGAnnuities extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'anuidades';

	public function categories(){
		return $this->hasMany('ORGAnnuityCategories', 'id_anuidade', 'id');
	} 

	public function payments(){
        return $this->hasManyThrough('ORGAssociateAnnuities', 'ORGAnnuityCategories', 'id_anuidade', 'id_anuidade_categoria');
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

	public static function findByYear( $year ){

		$annuity = self::where('ano', '=', $year)->take(1)->get();

		if(isset($annuity[0])):

			return $annuity[0];

		else:

			return false;

		endif;

	}

	public static function getLastAnnuity(){

		$year = date('Y');

		do{
			if( $annuity = ORGAnnuities::findByYear($year) ):
				$found = true;
			else:
				$found = false;
			endif;
			$year -= 1;
		}while(!$found);

		return $annuity;

	}

	public function getAnnuityCategoryByAssociateCategory( $category ){

		foreach($this->categories as $cat):

			if( $cat->id_categoria_asociado == $category->id_categoria_asociado ):

				return $cat;

			endif;

		endforeach;

		return false;

	}

}