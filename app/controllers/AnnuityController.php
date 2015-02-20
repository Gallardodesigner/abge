<?php

class AnnuityController extends \BaseController {

	protected $route = '/dashboard/annuities';

	public function getIndex(){

		return View::make('backend.annuities.index', array(
			'annuities' => ORGAnnuities::all(),
			'route' => $this->route,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function getCreate(){

		return View::make('backend.annuities.create', array(
			'route' => $this->route,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function postCreate(){

		$annuity = new ORGAnnuities();
		$annuity->ano = Input::get('ano');
		$annuity->save();

		return Redirect::to( $this->route )->with(array('msg_success' => 'Anuidade adicionada com sucesso'));

	}

	public function getUpdate( $idAnnuity = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_display_err'));

		else:

			$annuity = ORGAnnuities::find($idAnnuity);

			return View::make('backend.annuities.edit', array(
				'route' => $this->route,
				'annuity' => $annuity,
				'msg_success' => Session::get('msg_success'),
				'msg_error' => Session::get('msg_error')
				));

		endif;

	}

	public function postUpdate( $idAnnuity = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_display_err'));

		else:

			$annuity = ORGAnnuities::find($idAnnuity);

			$annuity->ano = Input::get('ano');
			$annuity->save();

			return Redirect::to( $this->route )->with(array('msg_success' => 'Anuidade editada com sucesso'));

		endif;

	}

	public function getDelete( $idAnnuity = '' ){

		if( $idAnnuity == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_display_err'));

		else:

			$annuity = ORGAnnuities::find($idAnnuity);

			$delete = ORGAnnuities::destroy($idAnnuity);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.annuities_delete_err', array( 'title' => $annuity->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.annuities_delete', array( 'title' => $annuity->title )));

			endif;

		endif;

	}

}