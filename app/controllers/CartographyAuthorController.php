<?php

class CartographyAuthorController extends \BaseController {

	protected $parent = '/dashboard/cartography';

	public static $route = '/dashboard/cartography/{idCartography}/authors';

	public function getIndex( $idCartography ){

		$cartography = Cartography::find($idCartography);

		return View::make('backend.cartographies.authors.index', array(
			'cartography' => $cartography,
			'cartography_authors' => $cartography->authors,
			'route' => self::parseRoute($idCartography),
			'parent' => $this->parent,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function getCreate( $idCartography){

		return View::make('backend.cartographies.authors.create', array(
			'cartography' => Cartography::find($idCartography),
			'parent' => $this->parent,
			'route' => self::parseRoute($idCartography),
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function postCreate($idCartography){

		$cartography = Cartography::find($idCartography);

		$cartography_author = new CartographyAuthor();
		$cartography_author->cartography_id = $cartography->id;
		$cartography_author->first_name = Input::get('first_name');
		$cartography_author->middle_name = Input::get('middle_name');
		$cartography_author->last_name = Input::get('last_name');
		$cartography_author->institution = Input::get('institution');
		$cartography_author->email = Input::get('email');
		$cartography_author->save();

		return Redirect::to( self::parseRoute($idCartography) )->with(array('msg_success' => 'Cartografia adicionada com sucesso'));

	}

	public function getUpdate( $idCartography, $id = '' ){

		if( $id == '' ):

			return Redirect::to(self::parseRoute($idCartography))->with('msg_error', Lang::get('messages.authors_display_err'));

		else:

			$cartography_author = CartographyAuthor::find($id);

			return View::make('backend.cartographies.authors.edit', array(
				'route' => self::parseRoute($idCartography),
				'cartography' => $cartography_author->cartography,
				'cartography_author' => $cartography_author,
				'msg_success' => Session::get('msg_success'),
				'msg_error' => Session::get('msg_error')
				));

		endif;

	}

	public function postUpdate( $idCartography, $id = '' ){

		$cartography_author = CartographyAuthor::find($id);

		$cartography_author->first_name = Input::get('first_name');
		$cartography_author->middle_name = Input::get('middle_name');
		$cartography_author->last_name = Input::get('last_name');
		$cartography_author->institution = Input::get('institution');
		$cartography_author->email = Input::get('email');
		$cartography_author->save();

		return Redirect::to( self::parseRoute($idCartography) )->with(array('msg_success' => 'Cartografia atualizada com sucesso'));

	}

	public function getDelete( $idCartography, $id = '' ){

		if( $id == '' ):

			return Redirect::to(self::parseRoute($idCartography))->with('msg_error', Lang::get('messages.authors_display_err'));

		else:

			$cartography_author = CartographyAuthor::find($id);

			$delete = CartographyAuthor::destroy($id);

			if(!$delete):

				return Redirect::to(self::parseRoute($idCartography))->with('msg_error', Lang::get('messages.authors_delete_err', array( 'title' => $cartography_author->title )));

			else:

				return Redirect::to(self::parseRoute($idCartography))->with('msg_success', Lang::get('messages.authors_delete', array( 'title' => $cartography_author->title )));

			endif;

		endif;

	}

	public static function parseRoute( $idCartography ){

		return str_replace('{idCartography}', $idCartography, self::$route );

	}

}