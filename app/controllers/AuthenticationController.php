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

	public function getAssociate( $usertype ){

		$msg_error = Session::get('msg_error');
		$usertype = UserTypes::find( $usertype );
		$course = $usertype->course;
		$contents = $course->coursesections;

		$array = array( 
			'msg_error' => $msg_error, 
			'course' => $course, 
			'usertype' => $usertype, 
			'contents' => $contents 
			);

		return View::make('auth.associate')->with( $array );

	}

	public function postAssociate(){

		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
			);

		$usertype = UserTypes::find(Input::get('usertype'));

		$course = Courses::find(Input::get('course'));

		if(Auth::attempt($credentials)):

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = Auth::user()->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

			$array = array(
				'inscription' => $inscription
				);

			return Redirect::to('/courses/'.$course.'/signin')->with( $array );

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

					$inscription = new Inscriptions();
					$inscription->id_course = $course->id;
					$inscription->id_user = Auth::user()->id;
					$inscription->id_usertype = $usertype->id;
					$inscription->save();

					$array = array(
						'inscription' => $inscription
						);

					return Redirect::to('/courses/'.$course.'/signin')->with( $array );

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

						$inscription = new Inscriptions();
						$inscription->id_course = $course->id;
						$inscription->id_user = Auth::user()->id;
						$inscription->id_usertype = $usertype->id;
						$inscription->save();

						$array = array(
							'inscription' => $inscription
							);

						return Redirect::to('/courses/'.$course.'/signin')->with( $array );

					else:

						return View::make('auth.error')->with( 'msg_error', Lang::get('messages.login_error'));

					endif;

				else:

					return View::make('auth.error');

				endif;

			endif;

		endif;

	}

	public function getParticipant( $usertype ){

		$msg_error = Session::get('msg_error');
		$usertype = UserTypes::find($usertype);
		$course = $usertype->course;
		$contents = $course->coursesections;

		$array =  array( 
			'msg_error' => $msg_error, 
			'course' => $course, 
			'usertype' => $usertype, 
			'contents' => $contents 
			);

		return View::make('auth.participant')->with( $array );

	}

	public function postParticipant(){

		$credentials = array(
			'cpf' => Input::get('cpf')
			);

		$usertype = Input::get('usertype');
		$course = Input::get('course');

		$participant = Participants::getByCPF($credentials['cpf']);

		if(!empty($participant[0])):

			$participant = $participant[0];

			$user = User::find($participant->user);

			if($user):

				Auth::login($user);

				$inscription = new Inscriptions();
				$inscription->id_course = $course->id;
				$inscription->id_user = Auth::user()->id;
				$inscription->id_usertype = $usertype->id;
				$inscription->save();

				$array = array(
					'msg_success' => Lang::get('messages.login_welcome'),
					'usertype' => $usertype,
					'inscription' => $inscription
					);

				return Redirect::to('/courses/'.$course.'/signin')->with( $array );

			else:

				$user = new User();
				$user->email = $participant->email;
				$user->name = $participant->name;
				$user->status = 'publish';
				$user->type = 'participant';
				$user->save();

				$participant->user = $user->id;
				$participant->save();

				Auth::login($user);

				$inscription = new Inscriptions();
				$inscription->id_course = $course->id;
				$inscription->id_user = Auth::user()->id;
				$inscription->id_usertype = $usertype->id;
				$inscription->save();

				$array = array(
					'msg_success' => Lang::get('messages.login_welcome'),
					'usertype' => $usertype,
					'inscription' => $inscription
					);

				return Redirect::to('/courses/'.$course.'/signin')->with( $array );

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

				$inscription = new Inscriptions();
				$inscription->id_course = $course->id;
				$inscription->id_user = Auth::user()->id;
				$inscription->id_usertype = $usertype->id;
				$inscription->save();

				$array = array(
					'msg_success' => Lang::get('messages.login_welcome'),
					'usertype' => $usertype,
					'inscription' => $inscription
					);

				return Redirect::to('/course/'.$course.'/signin')->with( $array );

			else:

				$array = array( 
					'cpf' => $credentials['cpf'], 
					'msg_error' => Lang::get('messages.login_not_participant'), 
					'course' => $course,
					'usertype' => $usertype
					);

				return Redirect::to('/auth/register')->with( $array );

			endif;

		endif;

	}

	public function getRegister(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$usertype = UserTypes::find(Session::get('usertype'));

		$course = Courses::find(Session::get('course'));
		$contents = $course->coursesections;

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => $contents
			);

		return View::make('auth.register')->with( $array );

	}

	public function postRegister(){

		$course = Input::get('course');

		$usertype = Input::get('usertype');

		$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();
		$estado_empresa = ORGStates::where('id_estado', '=', Input::get('estado_empresa'))->take(1)->get();

		$participant = new ORGParticipants();
		$participant->nome = Input::get('nome');
		$participant->rg = Input::get('rg');
		$participant->cpf = Input::get('cpf');
		$participant->endereco = Input::get('endereco');
		$participant->numero = Input::get('numero');
		$participant->complemento = Input::get('complemento');
		$participant->cep = Input::get('cep');
		$participant->cidade = Input::get('cidade');
		$participant->estado = $estado[0]->name_estado;
		$participant->empresa = Input::get('empresa');
		$participant->cnpj = Input::get('cnpj_empresa');
		$participant->endereco_empresa = Input::get('endereco_empresa');
		$participant->numero_empresa = Input::get('nome');
		$participant->complemento_empresa = Input::get('complemento_empresa');
		$participant->cep_empresa = Input::get('cep_empresa');
		$participant->cidade_empresa = Input::get('cidade_empresa');
		$participant->estado_empresa = $estado_empresa[0]->name_estado;
		$participant->telefone = Input::get('telefone_empresa');
		$participant->celular = Input::get('celular_empresa');
		$participant->email = Input::get('email');
		$participant->save();

		$user = new User();
		$user->email = $participant->email;
		$user->name = $participant->nome;
		$user->status = 'publish';
		$user->type = 'participant';
		$user->save();

		$participant = ORGParticipants::getByCPF($participant->cpf);

		$part = new Participants();
		$part->participant = $participant[0]->id_participante;
		$part->user = $user->id;
		$part->email = $participant[0]->email;
		$part->name = $participant[0]->nome;
		$part->cpf = $participant[0]->cpf;
		$part->status = 'publish';
		$part->type = Input::get('type');
		$part->save();

		Auth::login($user);

		$inscription = new Inscriptions();
		$inscription->id_course = $course->id;
		$inscription->id_user = Auth::user()->id;
		$inscription->id_usertype = $usertype->id;
		$inscription->save();

		$array = array(
			'usertype' => $usertype,
			'inscription' => $inscription
			);

		return Redirect::to('/courses/'.$course.'/signin')->with( $array );

	}

}