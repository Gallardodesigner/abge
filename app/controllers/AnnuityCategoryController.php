<?php

class AnnuityCategoryController extends \BaseController {

	protected static $parent = '/dashboard/annuities';

	public function getIndex( $idAnnuity ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$categories = ORGAssociateCategories::all();

		if( count($annuity->categories) < count($categories)):

			foreach($categories as $category):
		
				$annuity_category = ORGAnnuityCategories::where('id_categoria_asociado', '=', $category->id_categoria_asociado)->take(1)->get();
		
				if( !isset($annuity_category[0])):

					$annuity_category = new ORGAnnuityCategories();
					$annuity_category->id_anuidade = $annuity->id;
					$annuity_category->id_categoria_asociado = $category->id_categoria_asociado;
					$annuity_category->save();
		
				endif;

			endforeach;

			return Redirect::to(self::parseRoute($idAnnuity));

		else:

			$args = array(
				'annuity' => $annuity,
				'categories' => $annuity->categories,
				'route' => self::parseRoute( $idAnnuity ),
				'parent' => self::$parent
				);

			return View::make('backend.annuities.categories')->with( $args );

		endif;

	}

	public static function parseRoute( $idAnnuity ){

		return self::$parent.'/'.$idAnnuity.'/categories';

	}

}