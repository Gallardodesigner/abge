<?php

class AuthenticationController extends \BaseController {

	public function getIndex(){

		$msg_error = Session::get('msg_error');

		return View::make('auth.index')->with( array( 'msg_error' => $msg_error ) );
	}

	public function postIndex(){

		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
			);

		if(Auth::attempt($credentials)):

			return Redirect::to('/dashboard');

		else:

			return View::make('auth.login')->with('err', 'Usuario o Contraseña Inválidos');

		endif;

	}

	public function getCheckin(){

		$user = new User();
		$user->login = 'AlexanderZon';
		$user->type = 'superadmin';
		$user->save();

		Auth::login($user);

		return Redirect::to('/auth/check');

		$msg_error = Session::get('msg_error');

		return View::make('auth.index')->with( array( 'msg_error' => $msg_error ) );
	}

	public function getCheck(){

		return dd(Auth::check());

	}

	public function getCheckout(){

		return Auth::logout();

	}

	public function getAssociate(){

		$msg_error = Session::get('msg_error');

		return View::make('auth.associate')->with( array( 'msg_error' => $msg_error ) );

	}

	public function postAssociate(){

		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
			);

		if(Auth::attempt($credentials)):

			return Redirect::to('/dashboard');

		else:

			$associate = Associates::getByEmail($credentials['email']);

			if(!empty($associate[0])):
				dd($associate[0]);
				if($associate[0]->password == md5($credentials['password']) ):
					return "Asociado encontrado";
				else:
					return "Contraseña inváida";
				endif;

			else:

				$associate = ORGAssociates::getByEmail($credentials['email']);

				if(!empty($associate[0])):

					if($associate[0]->senha == md5($credentials['password']) ):
						return "Asociado ORG encontrado";
					else:
						return "Contraseña ORG inváida";
					endif;

				else:

					return "Asociado no Inscrito";

				endif;

			endif;

		endif;

	}

	public function getParticipant(){

		$cpf = Session::get('cpf');

		return View::make('auth.index')->with( array( 'cpf' => $cpf ) );

	}

	public function postParticipant(){

	}

}