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

				$associate = $associate[0];

				if($associate->password == md5($credentials['password']) ):

					$user = new User();
					$user->email = $associate->email;
					$user->name = $associate->nombre_completo;
					$user->status = 'publish';
					$user->type = 'associate';
					$user->password = Hash::make($credentials['password']);
					$user->save();

					$associate->user = $user->id;
					$associate->save();

					Auth::login($user);

					return Redirect::to('/dashboard')->with( 'msg_success', Lang::get('messages.login_welcome') );

				else:

					return View::make('auth.error')->with( 'msg_error', Lang::get('messages.login_error'));

				endif;

			else:

				$associate = ORGAssociates::getByEmail($credentials['email']);

				if(!empty($associate[0])):

					$associate = $associate[0];

					if($associate->senha == md5($credentials['password']) ):

						$user = new User();
						$user->email = $associate->email;
						$user->name = $associate->nombre_completo;
						$user->status = 'publish';
						$user->type = 'associate';
						$user->password = Hash::make($credentials['password']);
						$user->save();

						$assoc = new Associates();
						$assoc->associate = $associate->id_asociado;
						$assoc->user = $user->id;
						$assoc->email = $associate->email;
						$assoc->name = $associate->nombre_completo;
						$assoc->cpf = $associate->cpf;
						$assoc->password = $associate->senha;
						$assoc->status = 'publish';
						$assoc->type = 'associate';
						$assoc->save();

						Auth::login($user);

						return Redirect::to('/dashboard')->with( 'msg_success', Lang::get('messages.login_welcome') );

					else:

						return View::make('auth.error')->with( 'msg_error', Lang::get('messages.login_error'));

					endif;

				else:

					return View::make('auth.error');

				endif;

			endif;

		endif;

	}

	public function getParticipant(){

		$msg_error = Session::get('msg_error');

		return View::make('auth.participant')->with( array( 'msg_error' => $msg_error ) );

	}

	public function postParticipant(){

		$credentials = array(
			'cpf' => Input::get('cpf')
			);

		$participant = Participants::getByCPF($credentials['cpf']);

		if(!empty($participant[0])):

			$participant = $participant[0];

			$user = User::find($participant->user);

			if($user):

				Auth::login($user);

				return Redirect::to('/dashboard')->with( 'msg_success', Lang::get('messages.login_welcome') );

			else:

				$user = new User();
				$user->email = $participant->email;
				$user->name = $participant->name;
				$user->status = 'publish';
				$user->type = 'participant';
				$user->save();

				$participant->user = $user->id;
				$participant->save();

				return Redirect::to('/dashboard')->with( 'msg_success', Lang::get('messages.login_welcome') );

			endif;

		else:

			$participant = ORGParticipants::getByCPF($credentials['cpf']);

			if(!empty($participant[0])):

				$participant = $participant[0];

				$user = new User();
				$user->email = $participant->email;
				$user->name = $participant->nome;
				$user->status = 'publish';
				$user->type = 'participant';
				$user->save();

				$part = new Participants();
				$part->participant = $participant->id_participante;
				$part->user = $user->id;
				$part->email = $participant->email;
				$part->name = $participant->nome;
				$part->cpf = $participant->cpf;
				$part->status = 'publish';
				$part->type = 'participant';
				$part->save();

				Auth::login($user);

				return Redirect::to('/dashboard')->with( 'msg_success', Lang::get('messages.login_welcome') );

			else:

				return View::make('auth.error');

			endif;

		endif;

	}

}