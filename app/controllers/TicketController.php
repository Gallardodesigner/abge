<?php

class TicketController extends \BaseController {

	

	protected static $parent = '/dashboard/clients/associates';

	public function getIndex( $idAssociate ){
      
      $boleto = new Ticket();
      $boleto->buildHtml();
      $boleto->setAsociado($idAssociate);
      $boleto->inicialize();
      $boleto->printTcPdf();
      $corpo = $boleto->buildHtmlBoleto();
      $boleto->buildHtml($corpo);
      $boleto->addPagePdf();
      $boleto->creaPaginaBoleto();
      $boleto->endPagePdf();
      $boleto->inicializaHtml();
      $boleto->downloadPdf('associados');

	}

	/*
	public function getCreate( $idAssociate ){

		// $category = ORGAnnuityCategories::find( $idCategory );

		$associate = ORGAssociates::find($idAssociate);

		$args = array(
			'associate' => $associate,
			'route' => self::parseRoute( $idAssociate ),
			'parent' => self::$parent
			);

		return View::make('backend.clients.associates.payments.create')->with( $args );

	}

	public function postCreate( $idAssociate){

		$annuity = ORGAnnuities::getLastAnnuity();
		$associate = ORGAssociates::find( $idAssociate );
		$category = $annuity->getAnnuityCategoryByAssociateCategory( $associate->category );

		$payment = new ORGAssociateAnnuities();
		$payment->status = Input::get('status') == 'true' ? 1 : 0;
		$payment->id_asociado = $associate->id_asociado;
		$payment->id_anuidade_categoria = $category->id;
		$payment->pagamento = Input::get('pagamento');
		$payment->data_pagamento = date('Y-m-d', strtotime(Input::get('data_pagamento')));
		$payment->save();

		return Redirect::to( self::parseRoute( $idAssociate ));

	}

	public function getUpdate( $idAssociate, $id ){

		$args = array(
			'payment' => ORGAssociateAnnuities::find( $id ),
			'associate' =>  ORGAssociates::find( $idAssociate ),
			'route' => self::parseRoute( $idAssociate ),
			'parent' => self::$parent
			);

		return View::make('backend.clients.associates.payments.update')->with( $args );

	}

	public function postUpdate( $idAssociate, $id ){

		$payment = ORGAssociateAnnuities::find( $id );
		$payment->status = Input::get('status') == 'true' ? 1 : 0;
		$payment->pagamento = Input::get('pagamento');
		$payment->data_pagamento = date('Y-m-d', strtotime(Input::get('data_pagamento')));
		$payment->save();

		return Redirect::to( self::parseRoute( $idAssociate ));


	}

	public function getDelete( $idAssociate, $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.clients.associates_display_err'));

		else:

			$payment = ORGAssociateAnnuities::find($id);

			$delete = ORGAssociateAnnuities::destroy($id);

			if(!$delete):

				return Redirect::to(self::parseRoute($idAssociate))->with('msg_error', Lang::get('messages.clients.associates_delete_err', array( 'title' => $payment->nome )));

			else:

				return Redirect::to(self::parseRoute($idAssociate))->with('msg_success', Lang::get('messages.clients.associates_delete', array( 'title' => $payment->nome )));

			endif;

		endif;

	}

	public function getPaid( $idAssociate, $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 1;

			$payment->save();

			return Redirect::to(self::parseRoute($idAssociate))->with( 'msg_success', Lang::get('messages.payment_success'));

		else:

			return Redirect::to( self::parseRoute($idAssociate) );

		endif;
	}

	public function getNotpaid( $idAssociate, $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 0;

			$payment->save();

			return Redirect::to(self::parseRoute($idAssociate))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idAssociate) );

		endif;
	}
	*/

	public static function parseRoute( $idAssociate ){

		return self::$parent.'/'.$idAssociate.'/ticket';

	}

}