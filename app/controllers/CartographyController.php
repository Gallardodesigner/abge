<?php

class CartographyController extends \BaseController {

	protected $route = '/dashboard/cartographies';

	public function getIndex(){

		return View::make('backend.cartographies.index', array(
			'cartographies' => Cartography::where('id','!=',0)->orderBy('ano','DESC')->get(),
			'route' => $this->route,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function getCreate(){

		return View::make('backend.cartographies.create', array(
			'route' => $this->route,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function postCreate(){

		$carography = new Cartography();
		$carography->ano = Input::get('ano');
		$carography->save();

		return Redirect::to( $this->route )->with(array('msg_success' => 'Cartografia adicionada com sucesso'));

	}

	public function getUpdate( $idAnnuity = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_display_err'));

		else:

			$carography = Cartography::find($idAnnuity);

			return View::make('backend.cartographies.edit', array(
				'route' => $this->route,
				'carography' => $carography,
				'msg_success' => Session::get('msg_success'),
				'msg_error' => Session::get('msg_error')
				));

		endif;

	}

	public function postUpdate( $idAnnuity = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_display_err'));

		else:

			$carography = Cartography::find($idAnnuity);

			$carography->ano = Input::get('ano');
			$carography->save();

			return Redirect::to( $this->route )->with(array('msg_success' => 'Cartografia editada com sucesso'));

		endif;

	}

	public function getDelete( $idAnnuity = '' ){

		if( $idAnnuity == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_display_err'));

		else:

			$carography = Cartography::find($idAnnuity);

			$delete = Cartography::destroy($idAnnuity);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_delete_err', array( 'title' => $carography->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.cartographies_delete', array( 'title' => $carography->title )));

			endif;

		endif;

	}

}