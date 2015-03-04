<?php

class AnnuityPaymentController extends \BaseController {

	protected static $parent = '/dashboard/annuities';

	public function getIndex( $idAnnuity ){

		$annuity = ORGAnnuities::find( $idAnnuity );

		$payments = array();

		foreach( $annuity->categories as $category ):
			foreach( $category->payments as $payment ):
				$payments[] = $payment;
			endforeach;
		endforeach;

		$args = array(
			'annuity' => $annuity,
			'payments' => $payments,
			'route' => self::parseRoute( $idAnnuity ),
			'parent' => self::$parent
			);

		return View::make('backend.annuities.payments')->with( $args );

	}


	public function getPayments( $idAnnuity = '' ){

		if( $idAnnuity == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_display_err'));

		else:

			$annuity = ORGAnnuities::find($idAnnuity);

			return View::make('backend.annuities.payments', array(
				'parent' => $this->route,
				'route' => $this->route.'/'.$idAnnuity.'/',
				'annuity' => $annuity,
				'msg_success' => Session::get('msg_success'),
				'msg_error' => Session::get('msg_error')
				));

		endif;

	}

	public function getPaid( $idAnnuity, $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 1;

			$payment->save();

			return Redirect::to(self::parseRoute($idAnnuity))->with( 'msg_success', Lang::get('messages.payment_success'));

		else:

			return Redirect::to( self::parseRoute($idAnnuity) );

		endif;
	}

	public function getNotpaid( $idAnnuity, $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 0;

			$payment->save();

			return Redirect::to(self::parseRoute($idAnnuity))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idAnnuity) );

		endif;
	}

	public static function parseRoute( $idAnnuity ){

		return self::$parent.'/'.$idAnnuity.'/payments';

	}

}