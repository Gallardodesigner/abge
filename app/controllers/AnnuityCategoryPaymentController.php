<?php

class AnnuityCategoryPaymentController extends \BaseController {

	protected static $ancestor = '/dashboard/annuities';

	public function getIndex( $idAnnuity, $idCategory ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$args = array(
			'category' => $category,
			'payments' => $category->payments,
			'route' => self::parseRoute( $idAnnuity, $idCategory ),
			'parent' => self::parseParent( $idAnnuity )
			);

		return View::make('backend.annuities.payments.index')->with( $args );

	}

	public function getCreate( $idAnnuity, $idCategory ){

		$category = ORGAnnuityCategories::find( $idCategory );

		$associates = $category->category->associates;

		$args = array(
			'category' => $category,
			'associates' => $associates,
			'route' => self::parseRoute( $idAnnuity, $idCategory ),
			'parent' => self::parseParent( $idAnnuity )
			);

		return View::make('backend.annuities.payments.create')->with( $args );

	}

	public function postCreate( $idAnnuity, $idCategory ){

		if( Input::get('id_asociado') != 0):

			$annuity = ORGAnnuities::find( $idAnnuity );
			$category = ORGAnnuityCategories::find( $idCategory );

			$payment = new ORGAssociateAnnuities();
			$payment->status = Input::get('status') == 'true' ? 1 : 0;
			$payment->id_asociado = Input::get('id_asociado');
			$payment->id_anuidade_categoria = $category->id;
			$payment->pagamento = Input::get('pagamento');
			$payment->data_pagamento = date('Y-m-d', strtotime(Input::get('data_pagamento')));
			$payment->save();

			return Redirect::to( self::parseRoute( $idAnnuity, $idCategory ));

		else:

			return Redirect::to( self::parseRoute( $idAnnuity, $idCategory ) . '/create' );

		endif;

	}

	public function getUpdate( $idAnnuity, $idCategory, $id ){

		$annuity = ORGAnnuities::find( $idAnnuity );
		$category = ORGAnnuityCategories::find( $idCategory );

		$args = array(
			'payment' => ORGAssociateAnnuities::find( $id ),
			'associates' =>  ORGAssociates::all(),
			'category' => $category,
			'route' => self::parseRoute( $idAnnuity, $idCategory ),
			'parent' => self::parseParent( $idAnnuity )
			);

		return View::make('backend.annuities.payments.edit')->with( $args );

	}

	public function postUpdate( $idAnnuity, $idCategory, $id ){

		if( Input::get('id_asociado') != 0):

			$annuity = ORGAnnuities::find( $idAnnuity );
			$category = ORGAnnuityCategories::find( $idCategory );

			$payment = ORGAssociateAnnuities::find( $id );
			$payment->status = Input::get('status') == 'true' ? 1 : 0;
			$payment->id_asociado = Input::get('id_asociado');
			$payment->id_anuidade_categoria = $category->id;
			$payment->pagamento = Input::get('pagamento');
			$payment->data_pagamento = date('Y-m-d', strtotime(Input::get('data_pagamento')));
			$payment->save();

			return Redirect::to( self::parseRoute( $idAnnuity, $idCategory ));

		else:

			return Redirect::to( self::parseRoute( $idAnnuity, $idCategory ) . '/update' );

		endif;


	}

	public function getDelete( $idAnnuity, $idCategory, $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_display_err'));

		else:

			$payment = ORGAssociateAnnuities::find($id);

			$delete = ORGAssociateAnnuities::destroy($id);

			if(!$delete):

				return Redirect::to(self::parseRoute($idAnnuity,$idCategory))->with('msg_error', Lang::get('messages.annuities_delete_err', array( 'title' => $payment->nome )));

			else:

				return Redirect::to(self::parseRoute($idAnnuity,$idCategory))->with('msg_success', Lang::get('messages.annuities_delete', array( 'title' => $payment->nome )));

			endif;

		endif;

	}

	public function getPaid( $idAnnuity, $idCategory, $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 1;

			$payment->save();

			return Redirect::to(self::parseRoute($idAnnuity,$idCategory))->with( 'msg_success', Lang::get('messages.payment_success'));

		else:

			return Redirect::to( self::parseRoute($idAnnuity,$idCategory) );

		endif;
	}

	public function getNotpaid( $idAnnuity, $idCategory, $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 0;

			$payment->save();

			return Redirect::to(self::parseRoute($idAnnuity,$idCategory))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idAnnuity,$idCategory) );

		endif;
	}

	public static function parseParent( $idAnnuity ){

		return self::$ancestor.'/'.$idAnnuity.'/categories';

	}

	public static function parseRoute( $idAnnuity, $idCategory ){

		return self::parseParent( $idAnnuity ).'/'.$idCategory.'/payments';

	}

}