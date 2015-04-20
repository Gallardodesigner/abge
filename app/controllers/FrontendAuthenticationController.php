<?php

class FrontendAuthenticationController extends \BaseController {

	protected static $route = '/entrar';

	public function getIndex(){

		$msg_error = Session::get('msg_error');

		if(Auth::user()->check()):
			if(Auth::user()->user()->type=="superadmin"):
				return Redirect::to('/dashboard');
			elseif(Auth::user()->user()->type=="associate"):
				return Redirect::to('/associados');
			else:
				Auth::logout();
				return Redirect::to('/');
			endif;
		else:
			return View::make('auth.blank')->with( array( 'msg_error' => $msg_error ) );
		endif;

	}

	public function postIndex(){

		$credentials = array(
			'email' => Input::get('login'),
			'password' => Input::get('password')
			);

		if(Auth::user()->attempt($credentials)):

			return Redirect::to( self::$route );

		else:

			return Redirect::to( self::$route )->with(array('msg_error'=>'Usuario o Contraseña Inválidos'));

		endif;

	}

}