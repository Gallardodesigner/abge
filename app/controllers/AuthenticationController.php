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

			if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

				$array = array(
					'msg_success' => Lang::get('messages.login_welcome'),
					'usertype' => $usertype,
					'inscription' => $inscription
					);

				return Redirect::to('/auth/updateassociate')->with( $array );

			else:

				$inscription = new Inscriptions();
				$inscription->id_course = $course->id;
				$inscription->id_user = Auth::user()->id;
				$inscription->id_usertype = $usertype->id;
				$inscription->save();

				$array = array(
					'inscription' => $inscription
					);

				return Redirect::to('/auth/updateassociate')->with( $array );

			endif;

		else:

			$associate = Associates::getByEmail($credentials['email']);

			if(!empty($associate[0])):

				$associate = $associate[0];

				if($associate->password == md5($credentials['password']) ):

					$user = new User();
					$user->email = $associate->email;
					if($associate->nombre_completo != null):
						$user->name = $associate->nombre_completo;
					else:
						$user->name = "User without name";
					endif;
					$user->status = 'publish';
					$user->type = 'associate';
					$user->password = Hash::make($credentials['password']);
					$user->save();

					$associate->user = $user->id;
					$associate->save();

					Auth::login($user);

					if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

						$array = array(
							'msg_success' => Lang::get('messages.login_welcome'),
							'usertype' => $usertype,
							'inscription' => $inscription
							);

						return Redirect::to('/auth/updateassociate')->with( $array );

					else:

						$inscription = new Inscriptions();
						$inscription->id_course = $course->id;
						$inscription->id_user = Auth::user()->id;
						$inscription->id_usertype = $usertype->id;
						$inscription->save();

						$array = array(
							'inscription' => $inscription
							);

						return Redirect::to('/auth/updateassociate')->with( $array );

					endif;

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
						if($associate->nombre_completo != null):
							$user->name = $associate->nombre_completo;
						else:
							$user->name = "User without name";
						endif;
						$user->status = 'publish';
						$user->type = 'associate';
						$user->password = Hash::make($credentials['password']);
						$user->save();

						$assoc = new Associates();
						$assoc->associate = $associate->id_asociado;
						$assoc->user = $user->id;
						$assoc->email = $associate->email;
						if($associate->nombre_completo != null):
							$assoc->name = $associate->nombre_completo;
						else:
							$assoc->name = "User without name";
						endif;
						$assoc->cpf = $associate->cpf;
						$assoc->password = $associate->senha;
						$assoc->status = 'publish';
						$assoc->type = 'associate';
						$assoc->save();

						Auth::login($user);

						if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

							$array = array(
								'msg_success' => Lang::get('messages.login_welcome'),
								'usertype' => $usertype,
								'inscription' => $inscription
								);

							return Redirect::to('/auth/updateassociate')->with( $array );

						else:

							$inscription = new Inscriptions();
							$inscription->id_course = $course->id;
							$inscription->id_user = Auth::user()->id;
							$inscription->id_usertype = $usertype->id;
							$inscription->save();

							$array = array(
								'inscription' => $inscription
								);

							return Redirect::to('/auth/updateassociate')->with( $array );

						endif;

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

		$usertype = UserTypes::find(Input::get('usertype'));
		$course = Courses::find(Input::get('course'));

		$participant = Participants::getByCPF($credentials['cpf']);

		if(!empty($participant[0])):

			$participant = $participant[0];

			$user = User::find($participant->user);

			if($user):

				Auth::login($user);

				if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

					$array = array(
						'msg_success' => Lang::get('messages.login_welcome'),
						'usertype' => $usertype,
						'inscription' => $inscription
						);

					return Redirect::to('/auth/updateparticipant')->with( $array );

				else:

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

					return Redirect::to('/auth/updateparticipant')->with( $array );

				endif;

			else:

				$user = new User();
				$user->email = $participant->email;
				if($participant->name != null):
					$user->name = $participant->name;
				else:
					$user->name = "User without name";
				endif;
				$user->status = 'publish';
				$user->type = 'participant';
				$user->save();

				$participant->user = $user->id;
				$participant->save();

				Auth::login($user);

				if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

					$array = array(
						'msg_success' => Lang::get('messages.login_welcome'),
						'usertype' => $usertype,
						'inscription' => $inscription
						);

					return Redirect::to('/auth/updateparticipant')->with( $array );

				else:

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

					return Redirect::to('/auth/updateparticipant')->with( $array );

				endif;

			endif;

		else:

			$participant = ORGParticipants::getByCPF($credentials['cpf']);

			if(!empty($participant[0])):

				$participant = $participant[0];

				$user = new User();
				$user->email = $participant->email;
				if($participant->name != null):
					$user->name = $participant->name;
				else:
					$user->name = "User without name";
				endif;
				$user->status = 'publish';
				$user->type = 'participant';
				$user->save();

				$part = new Participants();
				$part->participant = $participant->id_participante;
				$part->user = $user->id;
				$part->email = $participant->email;
				if($participant->name != null):
					$part->name = $participant->name;
				else:
					$part->name = "User without name";
				endif;
				$part->cpf = $participant->cpf;
				$part->status = 'publish';
				$part->type = 'participant';
				$part->save();

				Auth::login($user);

				if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

					$array = array(
						'msg_success' => Lang::get('messages.login_welcome'),
						'usertype' => $usertype,
						'inscription' => $inscription
						);

					return Redirect::to('/auth/updateparticipant')->with( $array );

				else:

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

					return Redirect::to('/auth/updateparticipant')->with( $array );

				endif;

			else:

				$array = array( 
					'cpf' => $credentials['cpf'], 
					'msg_error' => Lang::get('messages.login_not_participant'), 
					'course' => $course->id,
					'usertype' => $usertype->id
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
		if($participant->name != null):
			$user->name = $participant->name;
		else:
			$user->name = "User without name";
		endif;
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

		if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

			$array = array(
				'msg_success' => Lang::get('messages.login_welcome'),
				'usertype' => $usertype,
				'inscription' => $inscription
				);

			return Redirect::to('/courses/'.$course->id.'/signin')->with( $array );

		else:

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = Auth::user()->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

			$array = array(
				'usertype' => $usertype,
				'inscription' => $inscription
				);

		endif;

		return Redirect::to('/courses/'.$course.'/signin')->with( $array );

	}

	public function getUpdateparticipant(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$inscription = Session::get('inscription');

		$usertype = $inscription->usertype;

		$participant = $inscription->user->participant->participante;

		$course = $inscription->course;
		$contents = $course->coursesections;

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => $contents,
			'inscription' => $inscription,
			'participant' => $participant
			);

		return View::make('auth.update_participant')->with( $array );

	}

	public function postUpdateparticipant(){

		$course = Input::get('course');

		$usertype = Input::get('usertype');

		$inscription = Inscriptions::find(Input::get('inscription'));
		$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();
		$estado_empresa = ORGStates::where('id_estado', '=', Input::get('estado_empresa'))->take(1)->get();

		$participant = ORGParticipants::find(Input::get('id'));

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

		Auth::login($participant->participant->getuser);

		$array = array(
			'msg_success' => Lang::get('messages.login_welcome'),
			'usertype' => $usertype,
			'inscription' => $inscription
			);

		return Redirect::to('/courses/'.$inscription->course->id.'/signin')->with( $array );

	}

	public function getUpdateassociate(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$inscription = Session::get('inscription');

		$usertype = $inscription->usertype;

		$participant = $inscription->user->associate->asociado;

		$course = $inscription->course;
		$contents = $course->coursesections;

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => $contents,
			'inscription' => $inscription,
			'participant' => $participant
			);

		return View::make('auth.update_associate')->with( $array );

	}

	public function postUpdateassociate(){

		$course = Input::get('course');

		$usertype = Input::get('usertype');

		$inscription = Inscriptions::find(Input::get('inscription'));
		$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();
		$estado_empresa = ORGStates::where('id_estado', '=', Input::get('estado_empresa'))->take(1)->get();
		
		$participant = ORGAssociates::find(Input::get('id'));

		$participant->nombre_completo = Input::get('nombre_completo');
		$participant->razon_social = Input::get('razon_social');
		$participant->inscription_estadual = Input::get('inscription_estadual');
		$participant->inscription_municipal = Input::get('inscription_municipal');
		$participant->tipo_pessoa = Input::get('tipo_pessoa');
		$participant->formacao = Input::get('formacao');
		$participant->categoria = Input::get('categoria');
		$participant->cpf = Input::get('cpf');
		$participant->cnpj = Input::get('cnpj');
		$participant->passaporte = Input::get('passaporte');
		$participant->email = Input::get('email');
		$participant->web_site = Input::get('web_site');
		$participant->responsavel = Input::get('responsavel');
		$participant->observacao = Input::get('observacao');
		$participant->nombre_completo = Input::get('nombre_completo');
		$participant->rg = Input::get('rg');
		$participant->dir_res = Input::get('dir_res');
		$participant->numero_res = Input::get('numero_res');
		$participant->complemento_res = Input::get('complemento_res');
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

		Auth::login($participant->participant->user);

		if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

			$array = array(
				'msg_success' => Lang::get('messages.login_welcome'),
				'usertype' => $usertype,
				'inscription' => $inscription
				);

			return Redirect::to('/courses/'.$course->id.'/signin')->with( $array );

		else:

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = Auth::user()->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

			$array = array(
				'usertype' => $usertype,
				'inscription' => $inscription
				);

		endif;

		return Redirect::to('/courses/'.$course.'/signin')->with( $array );

	}

}