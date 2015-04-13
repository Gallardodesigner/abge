<?php

class CartographyController extends \BaseController {

	protected $route = '/dashboard/cartography';

	public function getIndex(){

		return View::make('backend.cartographies.index', array(
			'cartographies' => Cartography::all(),
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

		$cartography = new Cartography();
		$cartography->user_id = Input::get('user_id');
		$cartography->work_title = Input::get('work_title');
		$cartography->region = Input::get('region');
		$cartography->scale = Input::get('scale');
		$cartography->backyard = Input::get('backyard');
		$cartography->keywords = Input::get('keywords');
		$cartography->maps = Input::get('maps');
		$cartography->geotechnical_testing = Input::get('geotechnical_testing');
		$cartography->institution = Input::get('institution');
		$cartography->year = Input::get('year');
		$cartography->pages = Input::get('pages');
		$cartography->concentration = Input::get('concentration');
		$cartography->teaching_unit = Input::get('teaching_unit');
		$cartography->cartography_institution = Input::get('cartography_institution');
		$cartography->locale = Input::get('locale');
		$cartography->subtitle = Input::get('subtitle');
		$cartography->approval_year = Input::get('approval_year');
		$cartography->summary = Input::get('summary');
		$cartography->link = Input::get('link');
		$cartography->save();

		return Redirect::to( $this->route )->with(array('msg_success' => 'Cartografia adicionada com sucesso'));

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_display_err'));

		else:

			$cartography = Cartography::find($id);

			return View::make('backend.cartographies.edit', array(
				'route' => $this->route,
				'cartography' => $cartography,
				'msg_success' => Session::get('msg_success'),
				'msg_error' => Session::get('msg_error')
				));

		endif;

	}

	public function postUpdate( $idAnnuity = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_display_err'));

		else:

			$cartography = Cartography::find($idAnnuity);
			$cartography->user_id = Input::get('user_id');
			$cartography->work_title = Input::get('work_title');
			$cartography->region = Input::get('region');
			$cartography->scale = Input::get('scale');
			$cartography->backyard = Input::get('backyard');
			$cartography->keywords = Input::get('keywords');
			$cartography->maps = Input::get('maps');
			$cartography->geotechnical_testing = Input::get('geotechnical_testing');
			$cartography->institution = Input::get('institution');
			$cartography->year = Input::get('year');
			$cartography->pages = Input::get('pages');
			$cartography->concentration = Input::get('concentration');
			$cartography->teaching_unit = Input::get('teaching_unit');
			$cartography->cartography_institution = Input::get('cartography_institution');
			$cartography->locale = Input::get('locale');
			$cartography->subtitle = Input::get('subtitle');
			$cartography->approval_year = Input::get('approval_year');
			$cartography->summary = Input::get('summary');
			$cartography->link = Input::get('link');
			$cartography->save();

			return Redirect::to( $this->route )->with(array('msg_success' => 'Cartografia editada com sucesso'));

		endif;

	}

	public function getDelete( $idAnnuity = '' ){

		if( $idAnnuity == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_display_err'));

		else:

			$cartography = Cartography::find($idAnnuity);

			$delete = Cartography::destroy($idAnnuity);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.cartographies_delete_err', array( 'title' => $cartography->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.cartographies_delete', array( 'title' => $cartography->title )));

			endif;

		endif;

	}

}