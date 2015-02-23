<?php

class AnnuityDateController extends \BaseController {

	protected static $ancestor = '/dashboard/annuities';

	public function getIndex( $idAnnuity, $idCategory ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$args = array(
			'category' => $category,
			'dates' => $category->dates,
			'route' => self::parseRoute( $idAnnuity, $idCategory ),
			'parent' => self::parseParent( $idAnnuity )
			);

		return View::make('backend.annuities.dates.index')->with( $args );

	}

	public function getCreate( $idAnnuity, $idCategory ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$args = array(
			'category' => $category,
			'route' => self::parseRoute( $idAnnuity, $idCategory ),
			'parent' => self::parseParent( $idAnnuity )
			);

		return View::make('backend.annuities.dates.create')->with( $args );

	}

	public function postCreate( $idAnnuity, $idCategory ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$date = new ORGAnnuityDates();
		$date->nome = Input::get('nome');
		$date->preco = Input::get('preco');
		$date->id_anuidade_categoria = $idCategory;
		$date->pagseguro = Input::get('pagseguro');
		$date->data_inicio = date('Y-m-d', strtotime(Input::get('data_inicio')));
		$date->data_final = date('Y-m-d', strtotime(Input::get('data_final')));
		$date->save();

		return Redirect::to( self::parseRoute( $idAnnuity, $idCategory ));

	}

	public function getUpdate( $idAnnuity, $idCategory, $id ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$args = array(
			'data' => ORGAnnuityDates::find( $id ),
			'category' => $category,
			'route' => self::parseRoute( $idAnnuity, $idCategory ),
			'parent' => self::parseParent( $idAnnuity )
			);

		return View::make('backend.annuities.dates.edit')->with( $args );

	}

	public function postUpdate( $idAnnuity, $idCategory, $id ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$date = ORGAnnuityDates::find( $id );
		$date->nome = Input::get('nome');
		$date->preco = Input::get('preco');
		$date->id_anuidade_categoria = $idCategory;
		$date->pagseguro = Input::get('pagseguro');
		$date->data_inicio = date('Y-m-d', strtotime(Input::get('data_inicio')));
		$date->data_final = date('Y-m-d', strtotime(Input::get('data_final')));
		$date->save();

		return Redirect::to( self::parseRoute( $idAnnuity, $idCategory ));

	}

	public function getDelete( $idAnnuity, $idCategory, $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_display_err'));

		else:

			$date = ORGAnnuityDates::find($id);

			$delete = ORGAnnuityDates::destroy($id);

			if(!$delete):

				return Redirect::to(self::parseRoute($idAnnuity,$idCategory))->with('msg_error', Lang::get('messages.annuities_delete_err', array( 'title' => $date->nome )));

			else:

				return Redirect::to(self::parseRoute($idAnnuity,$idCategory))->with('msg_success', Lang::get('messages.annuities_delete', array( 'title' => $date->nome )));

			endif;

		endif;

	}

	public static function parseParent( $idAnnuity ){

		return self::$ancestor.'/'.$idAnnuity.'/categories';

	}

	public static function parseRoute( $idAnnuity, $idCategory ){

		return self::parseParent( $idAnnuity ).'/'.$idCategory.'/dates';

	}

}