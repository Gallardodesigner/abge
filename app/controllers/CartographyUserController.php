<?php

class CartographyUserController extends \BaseController {

	protected $parent = '/dashboard/cartography';

	protected $route = '/dashboard/cartography/users';

	public function getIndex(){

		return View::make('backend.cartographies.users.index', array(
			'cartography_users' => CartographyUser::all(),
			'route' => $this->route,
			'parent' => $this->parent,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function getCreate(){

		return View::make('backend.cartographies.users.create', array(
			'route' => $this->route,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			));

	}

	public function postCreate(){

		$exist_user = CartographyUser::where('username', '=', Input::get('username'))->get();
		$exist_email = CartographyUser::where('email', '=', Input::get('email'))->get();

		if(isset($exist_user[0])):

			return "Usuario ". Input::get('username')." já existe. ".HTML::link($this->route.'/create', 'Voltar');

		elseif(isset($exist_email[0])):

			return "Email ". Input::get('email')." já existe. ".HTML::link($this->route.'/create', 'Voltar');

		elseif(Input::get('password_1') == ''):

			return "Você deve digitar uma senha. ".HTML::link($this->route.'/create', 'Voltar');			

		elseif(Input::get('password_1') != Input::get('password_2')):

			return "As senhas devem corresponder. ".HTML::link($this->route.'/create', 'Voltar');			

		else:

			$cartography_user = new CartographyUser();
			$cartography_user->name = Input::get('name');
			$cartography_user->username = Input::get('username');
			$cartography_user->password = md5(Input::get('password_1'));
			$cartography_user->usertype = Input::get('usertype');
			$cartography_user->email = Input::get('email');
			$cartography_user->save();

			return Redirect::to( $this->route )->with(array('msg_success' => 'Cartografia adicionada com sucesso'));

		endif;

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.users_display_err'));

		else:

			$cartography_user = CartographyUser::find($id);

			return View::make('backend.cartographies.users.edit', array(
				'route' => $this->route,
				'cartography_user' => $cartography_user,
				'msg_success' => Session::get('msg_success'),
				'msg_error' => Session::get('msg_error')
				));

		endif;

	}

	public function postUpdate( $id = '' ){

		$cartography_user = CartographyUser::find($id);

		if(Input::get('password_1') != ''):			

			if(Input::get('password_1') != Input::get('password_2')):

				return "As senhas devem corresponder. ".HTML::link($this->route.'/create', 'Voltar');	

			else:

				$cartography_user->password = md5(Input::get('password_1'));

			endif;		

		endif;

		$cartography_user->name = Input::get('name');
		$cartography_user->usertype = Input::get('usertype');
		$cartography_user->save();

		return Redirect::to( $this->route )->with(array('msg_success' => 'Cartografia adicionada com sucesso'));

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.users_display_err'));

		else:

			$cartography_user = CartographyUser::find($id);

			$delete = CartographyUser::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.users_delete_err', array( 'title' => $cartography_user->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.users_delete', array( 'title' => $cartography_user->title )));

			endif;

		endif;

	}

}