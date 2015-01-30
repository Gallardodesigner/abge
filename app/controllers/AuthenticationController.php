<?php

class AuthenticationController extends \BaseController {

	public function getIndex(){

		$msg_error = Session::get('msg_error');

		return View::make('auth.index')->with( array( 'msg_error' => $msg_error ) );
	}

	public function postIndex(){

		$credentials = array(
			'email' => Input::get('login'),
			'password' => Input::get('password')
			);

		if(Auth::attempt($credentials)):

			return Redirect::to('/dashboard');

		else:

			return Redirect::to('/gd-admin')->with(array('msg_error'=>'Usuario o Contraseña Inválidos'));

		endif;

	}

	public function getCheckin(){

		$user = new User();
		$user->login = 'AlexanderZon';
		$user->type = 'superadmin';
		$user->save();

		Auth::login($user);

		return Redirect::to('/autenticacao/check');

		$msg_error = Session::get('msg_error');

		return View::make('auth.index')->with( array( 'msg_error' => $msg_error ) );
	}

	public function getCheck(){

		return dd(Auth::check());

	}

	public function getCheckout(){

		return Auth::logout();

	}

	public function getAssociado( $usertype ){

		$msg_error = Session::get('msg_error');
		$usertype = UserTypes::find( $usertype );
		$course = $usertype->course;
		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

		$array = array( 
			'msg_error' => $msg_error, 
			'course' => $course, 
			'usertype' => $usertype, 
			'contents' => $contents 
			);

		return View::make('auth.associate')->with( $array );

	}

	public function postAssociado(){

		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
			);

		$usertype = UserTypes::find(Input::get('usertype'));

		$course = Courses::find(Input::get('course'));

		if(Auth::attempt($credentials)):

			/*if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):
				// dd($inscription->id);
				$inscription = Inscriptions::find($inscription->id);
				$array = array(
					'msg_success' => Lang::get('messages.login_welcome'),
					'usertype' => $usertype,
					'inscription' => $inscription
					);

				if($inscription->paid):
					return Redirect::to($inscription->course->route.'/pago')->with( $array );
				else:
					return Redirect::to($inscription->course->route.'/acesso')->with( $array );
				endif;

				// return Redirect::to('/autenticacao/actualizacaoassociado')->with( $array );

			else:*/

				$inscription = new Inscriptions();
				$inscription->id_course = $course->id;
				$inscription->id_user = Auth::user()->id;
				$inscription->id_usertype = $usertype->id;
				$inscription->save();

				$array = array(
					'inscription' => $inscription
					);

				return Redirect::to('/autenticacao/actualizacaoassociado')->with( $array );

			/*endif;*/

		else:

			$associate = Associates::getByEmail($credentials['email']);

			if(!empty($associate[0])):

				$associate = $associate[0];

				if($associate->password == md5($credentials['password']) ):

					$user_finded = User::where('email','=', $credentials['email'])->take(1)->get();

					$user = null;

					if(!empty($user_finded[0])):

						$user = $user_finded[0];					
						$user->password = Hash::make($credentials['password']);
						$user->save();

					else:

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

					endif;

					Auth::login($user);

					if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

						$array = array(
							'msg_success' => Lang::get('messages.login_welcome'),
							'usertype' => $usertype,
							'inscription' => $inscription
							);

						return Redirect::to('/autenticacao/actualizacaoassociado')->with( $array );

					else:

						$inscription = new Inscriptions();
						$inscription->id_course = $course->id;
						$inscription->id_user = Auth::user()->id;
						$inscription->id_usertype = $usertype->id;
						$inscription->save();

						$array = array(
							'inscription' => $inscription
							);

						return Redirect::to('/autenticacao/actualizacaoassociado')->with( $array );

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

								return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

							else:

								$inscription = new Inscriptions();
								$inscription->id_course = $course->id;
								$inscription->id_user = Auth::user()->id;
								$inscription->id_usertype = $usertype->id;
								$inscription->save();

								$array = array(
									'inscription' => $inscription
									);

								return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

							endif;

						else:

							$array = array(
								'course' => $course,
								'usertype' => $usertype,
								'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
								);

							return View::make('auth.error')->with( $array );

						endif;

					else:

						$array = array(
							'course' => $course,
							'usertype' => $usertype,
							'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
							);

						return View::make('auth.error')->with( $array );

					endif;

					$array = array(
						'course' => $course,
						'usertype' => $usertype,
						'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
						);

					return View::make('auth.error')->with( $array );

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

							return Redirect::to('/autenticacao/actualizacaoassociado')->with( $array );

						else:

							$inscription = new Inscriptions();
							$inscription->id_course = $course->id;
							$inscription->id_user = Auth::user()->id;
							$inscription->id_usertype = $usertype->id;
							$inscription->save();

							$array = array(
								'inscription' => $inscription
								);

							return Redirect::to('/autenticacao/actualizacaoassociado')->with( $array );

						endif;

					else:

						$array = array(
							'course' => $course,
							'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
							);

						return View::make('auth.error')->with( $array );

					endif;

				else:

					$array = array(
						'course' => $course,
						'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
						);

					return View::make('auth.error')->with($array);

				endif;

			endif;

		endif;

	}

	public function getParticipante( $usertype ){

		$msg_error = Session::get('msg_error');
		$usertype = UserTypes::find($usertype);
		$course = $usertype->course;
		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

		$array =  array( 
			'msg_error' => $msg_error, 
			'course' => $course, 
			'usertype' => $usertype, 
			'contents' => $contents 
			);

		return View::make('auth.participant')->with( $array );

	}

	public function postParticipante(){

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

				/*if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

					dd("hasInscription");

					$array = array(
						'msg_success' => Lang::get('messages.login_welcome'),
						'usertype' => $usertype,
						'inscription' => $inscription
						);
				
					if($inscription->paid):
						return Redirect::to($inscription->course->route.'/pago')->with( $array );
					else:
						return Redirect::to($inscription->course->route.'/acesso')->with( $array );
					endif;

					// return Redirect::to('/autenticacao/actualizacaoparticipante')->with( $array );

				else:*/

					$inscription = new Inscriptions();
					$inscription->id_course = $course->id;
					$inscription->id_user = Auth::user()->id;
					$inscription->id_usertype = $usertype->id;
					$inscription->save();

					$array = array(
						'msg_success' => Lang::get('messages.login_welcome'),
						'usertype' => $usertype,
						'inscription' => $inscription,
						'participant' => $participant
						);

					return Redirect::to('/autenticacao/actualizacaoparticipante')->with( $array );

				/*endif;*/

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

					return Redirect::to('/autenticacao/actualizacaoparticipante')->with( $array );

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

					return Redirect::to('/autenticacao/actualizacaoparticipante')->with( $array );

				endif;

			endif;

		else:

			$participant = ORGParticipants::getByCPF($credentials['cpf']);

			if(!empty($participant[0])):

				$participant = $participant[0];

				$user = new User();
				$user->email = $participant->email;
				if($participant->nome != null):
					$user->name = $participant->nome;
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
				if($participant->nome != null):
					$part->name = $participant->nome;
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

					return Redirect::to('/autenticacao/actualizacaoparticipante')->with( $array );

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

					return Redirect::to('/autenticacao/actualizacaoparticipante')->with( $array );

				endif;

			else:

				$array = array( 
					'cpf' => $credentials['cpf'], 
					'msg_error' => Lang::get('messages.login_not_participant'), 
					'course' => $course->id,
					'usertype' => $usertype->id
					);

				return Redirect::to('/autenticacao/cadastro')->with( $array );

			endif;

		endif;

	}

	public function getCadastro(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$usertype = UserTypes::find(Session::get('usertype'));

		$course = Courses::find(Session::get('course'));

		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => FrontendCourseController::getOrderedContent($contents),
			'formacoes' => ORGTrainings::all(),
			);

		switch ($course->type) {
			case 'gratuito':
				# code...
				return View::make('auth.register_gratuito')->with( $array );
				break;
			case 'pago':
				# code...
				return View::make('auth.register_pago')->with( $array );
				break;
			case 'pagseguro':
				# code...
				return View::make('auth.register_pagseguro')->with( $array );
				break;
			default:
				# code...
				return View::make('auth.register')->with( $array );
				break;
		}

	}

	public function postCadastro(){

		$course = Courses::find(Input::get('course'));

		$usertype = UserTypes::find(Input::get('usertype'));

		$participant = new ORGParticipants();

		$participant->nome = Input::get('nome') != null ? Input::get('nome') : '';
		$participant->rg = Input::get('rg') != null ? Input::get('rg') : '';
		$participant->cpf = Input::get('cpf') != null ? Input::get('cpf') : '';
		$participant->formacao = Input::get('formacao') != null ? Input::get('formacao') : '';
		$participant->endereco = Input::get('endereco') != null ? Input::get('endereco') : '';
		$participant->numero = Input::get('numero') != null ? Input::get('numero') : '';
		$participant->complemento = Input::get('complemento') != null ? Input::get('complemento') : '';
		$participant->bairro = Input::get('bairro') != null ? Input::get('bairro') : '';
		$participant->cidade = Input::get('cidade') != null ? Input::get('cidade') : '';
		$participant->estado = Input::get('estado') != null ? Input::get('estado') : '';
		$participant->cep = Input::get('cep') != null ? Input::get('cep') : '';
		$participant->empresa = Input::get('empresa') != null ? Input::get('empresa') : '';
		$participant->cnpj = Input::get('cnpj_empresa') != null ? Input::get('cnpj_empresa') : '';
		$participant->endereco_empresa = Input::get('endereco_empresa') != null ? Input::get('endereco_empresa') : '';
		$participant->numero_empresa = Input::get('nome') != null ? Input::get('nome') : '';
		$participant->complemento_empresa = Input::get('complemento_empresa') != null ? Input::get('complemento_empresa') : '';
		$participant->bairro_empresa = Input::get('bairro_empresa') != null ? Input::get('bairro_empresa') : '';
		$participant->cidade_empresa = Input::get('cidade_empresa') != null ? Input::get('cidade_empresa') : '';
		$participant->estado_empresa = Input::get('estado_empresa') != null ? Input::get('estado_empresa') : '';
		$participant->cep_empresa = Input::get('cep_empresa') != null ? Input::get('cep_empresa') : '';
		$participant->telefone = Input::get('telefone') != null ? Input::get('telefone') : '';
		$participant->celular = Input::get('celular') != null ? Input::get('celular') : '';
		$participant->email = Input::get('email') != null ? Input::get('email') : '';
		$participant->pagamento_empresa = Input::get('pagamento_empresa') != null ? Input::get('pagamento_empresa') : '';
		$participant->pagamento_participante = Input::get('pagamento_participante') != null ? Input::get('pagamento_participante') : '';
		$participant->save();

		$user = new User();
		$user->email = $participant->email;
		if($participant->nome != null):
			$user->name = $participant->nome;
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
		$part->type = 'participant';
		$part->save();

		Auth::login($user);

		if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

			$array = array(
				'msg_success' => Lang::get('messages.login_welcome'),
				'usertype' => $usertype,
				'inscription' => $inscription
				);

			return Redirect::to($course->route.'/acesso')->with( $array );

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

			return Redirect::to($course->route.'/acesso')->with( $array );
		
		endif;

	}

	public function getActualizacaoparticipante(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$inscription = Session::get('inscription');

		$usertype = $inscription->usertype;

		$participant = $inscription->user->participant->participante;

		$course = $inscription->course;

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => FrontendCourseController::getOrderedContent($course->coursesections),
			'formacoes' => ORGTrainings::all(),
			'inscription' => $inscription,
			'participant' => $participant
			);

		switch ($course->type) {
			case 'gratuito':
				# code...
				return View::make('auth.update_participant_gratuito')->with( $array );
				break;
			case 'pago':
				# code...
				return View::make('auth.update_participant_pago')->with( $array );
				break;
			case 'pagseguro':
				# code...
				return View::make('auth.update_participant_pagseguro')->with( $array );
				break;
			default:
				# code...
				return View::make('auth.update_participant')->with( $array );
				break;
		}


	}

	public function postActualizacaoparticipante(){

		$course = Input::get('course');

		$usertype = Input::get('usertype');

		$inscription = Inscriptions::find(Input::get('inscription'));

		$participant = ORGParticipants::find(Input::get('id'));

		$participant->nome = Input::get('nome') != null ? Input::get('nome') : $participant->nome;
		$participant->rg = Input::get('rg') != null ? Input::get('rg') : $participant->rg;
		$participant->cpf = Input::get('cpf') != null ? Input::get('cpf') : $participant->cpf;
		$participant->formacao = Input::get('formacao') != null ? Input::get('formacao') : $participant->formacao;
		$participant->endereco = Input::get('endereco') != null ? Input::get('endereco') : $participant->endereco;
		$participant->numero = Input::get('numero') != null ? Input::get('numero') : $participant->numero;
		$participant->complemento = Input::get('complemento') != null ? Input::get('complemento') : $participant->complemento;
		$participant->bairro = Input::get('bairro') != null ? Input::get('bairro') : $participant->bairro;
		$participant->cidade = Input::get('cidade') != null ? Input::get('cidade') : $participant->cidade;
		$participant->estado = Input::get('estado') != null ? Input::get('estado') : $participant->estado;
		$participant->cep = Input::get('cep') != null ? Input::get('cep') : $participant->cep;
		$participant->empresa = Input::get('empresa') != null ? Input::get('empresa') : $participant->empresa;
		$participant->cnpj = Input::get('cnpj_empresa') != null ? Input::get('cnpj_empresa') : $participant->cnpj;
		$participant->endereco_empresa = Input::get('endereco_empresa') != null ? Input::get('endereco_empresa') : $participant->endereco_empresa;
		$participant->numero_empresa = Input::get('nome') != null ? Input::get('nome') : $participant->numero_empresa;
		$participant->complemento_empresa = Input::get('complemento_empresa') != null ? Input::get('complemento_empresa') : $participant->complemento_empresa;
		$participant->bairro_empresa = Input::get('bairro_empresa') != null ? Input::get('bairro_empresa') : $participant->bairro_empresa;
		$participant->cidade_empresa = Input::get('cidade_empresa') != null ? Input::get('cidade_empresa') : $participant->cidade_empresa;
		$participant->estado_empresa = Input::get('estado_empresa') != null ? Input::get('estado_empresa') : $participant->estado_empresa;
		$participant->cep_empresa = Input::get('cep_empresa') != null ? Input::get('cep_empresa') : $participant->cep_empresa;
		$participant->telefone = Input::get('telefone') != null ? Input::get('telefone') : $participant->telefone;
		$participant->celular = Input::get('celular') != null ? Input::get('celular') : $participant->celular;
		$participant->email = Input::get('email') != null ? Input::get('email') : $participant->email;
		$participant->pagamento_empresa = Input::get('pagamento_empresa') != null ? Input::get('pagamento_empresa') : $participant->pagamento_empresa;
		$participant->pagamento_participante = Input::get('pagamento_participante') != null ? Input::get('pagamento_participante') : $participant->pagamento_participante;
		$participant->save();

		Auth::login($participant->participant->getuser);

		$array = array(
			'msg_success' => Lang::get('messages.login_welcome'),
			'usertype' => $usertype,
			'inscription' => $inscription
			);

		return Redirect::to($inscription->course->route.'/acesso')->with( $array );

	}

	public function getActualizacaoassociado(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$inscription = Session::get('inscription');

		$usertype = $inscription->usertype;

		$participant = $inscription->user->associate->asociado;

		$course = $inscription->course;

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => FrontendCourseController::getOrderedContent($course->coursesections),
			'formacoes' => ORGTrainings::all(),
			'logradouros' => ORGBackyards::all(),
			'inscription' => $inscription,
			'participant' => $participant
			);

		switch ($course->type) {
			case 'gratuito':
				# code...
				return View::make('auth.update_associate_gratuito')->with( $array );
				break;
			case 'pago':
				# code...
				return View::make('auth.update_associate_pago')->with( $array );
				break;
			case 'pagseguro':
				# code...
				return View::make('auth.update_associate_pagseguro')->with( $array );
				break;
			default:
				# code...
				return View::make('auth.update_associate')->with( $array );
				break;
		}

	}

	public function postActualizacaoassociado(){

		$course = Input::get('course');

		$usertype = Input::get('usertype');

		$inscription = Inscriptions::find(Input::get('inscription'));
		
		$participant = ORGAssociates::find(Input::get('id'));
		
		$participant->nombre_completo = Input::get('nombre_completo') != null ?  Input::get('nombre_completo') : $participant->nombre_completo;
		$participant->rg = Input::get('rg') != null ? Input::get('rg') : $participant->rg;
		$participant->cpf = Input::get('cpf') != null ?  Input::get('cpf') : $participant->cpf;
		$participant->formacao = Input::get('formacao') != null ? Input::get('formacao') : $participant->formacao;
		$participant->dir_res = Input::get('dir_res') != null ?  Input::get('dir_res') : $participant->dir_res;
		$participant->numero_res = Input::get('numero_res') != null ?  Input::get('numero_res') : $participant->numero_res;
		$participant->complemento_res = Input::get('complemento_res') != null ?  Input::get('complemento_res') : $participant->complemento_res;
		$participant->bairro_res = Input::get('bairro_res') != null ?  Input::get('bairro_res') : $participant->bairro_res;
		$participant->logradouro_res = Input::get('logradouro_res') != null ?  Input::get('logradouro_res') : $participant->logradouro_res;
		$participant->uf_res = Input::get('uf_res') != null ?  Input::get('uf_res') : $participant->uf_res;
		$participant->cep_res = Input::get('cep_res') != null ?  Input::get('cep_res') : $participant->cep_res;
		$participant->empresa = Input::get('empresa') != null ?  Input::get('empresa') : $participant->empresa;
		$participant->cnpj = Input::get('cnpj') != null ?  Input::get('cnpj') : $participant->cnpj;
		$participant->dir_com = Input::get('dir_com') != null ?  Input::get('dir_com') : $participant->dir_com;
		$participant->numero_com = Input::get('numero_com') != null ?  Input::get('numero_com') : $participant->numero_com;
		$participant->complemento_com = Input::get('complemento_com') != null ?  Input::get('complemento_com') : $participant->complemento_com;
		$participant->bairro_com = Input::get('bairro_com') != null ?  Input::get('bairro_com') : $participant->bairro_com;
		$participant->logradouro_com = Input::get('logradouro_com') != null ?  Input::get('logradouro_com') : $participant->logradouro_com;
		$participant->uf_com = Input::get('uf_com') != null ?  Input::get('uf_com') : $participant->uf_com;
		$participant->cep_com = Input::get('cep_com') != null ?  Input::get('cep_com') : $participant->cep_com;
		$participant->ddi_res = Input::get('ddi_res') != null ?  Input::get('ddi_res') : $participant->ddi_res;
		$participant->ddd_res = Input::get('ddd_res') != null ?  Input::get('ddd_res') : $participant->ddd_res;
		$participant->telefone_res = Input::get('telefone_res') != null ?  Input::get('telefone_res') : $participant->telefone_res;
		$participant->ddi_cel_res = Input::get('ddi_cel_res') != null ?  Input::get('ddi_cel_res') : $participant->ddi_cel_res;
		$participant->ddd_cel_res = Input::get('ddd_cel_res') != null ?  Input::get('ddd_cel_res') : $participant->ddd_cel_res;
		$participant->celular_res = Input::get('celular_res') != null ?  Input::get('celular_res') : $participant->celular_res;
		$participant->email = Input::get('email') != null ?  Input::get('email') : $participant->email;
		$participant->pagamento_empresa = Input::get('pagamento_empresa') != null ? Input::get('pagamento_empresa') : $participant->pagamento_empresa;
		$participant->pagamento_participante = Input::get('pagamento_participante') != null ? Input::get('pagamento_participante') : $participant->pagamento_participante;
		
		$participant->razon_social = Input::get('razon_social') != null ?  Input::get('razon_social') : $participant->razon_social;
		$participant->inscripcion_estadual = Input::get('inscription_estadual') != null ?  Input::get('inscription_estadual') : $participant->inscripcion_estadual;
		$participant->inscripcion_municipal = Input::get('inscription_municipal') != null ?  Input::get('inscription_municipal') : $participant->inscripcion_municipal;
		$participant->tipo_pessoa = Input::get('tipo_pessoa') != null ?  Input::get('tipo_pessoa') : $participant->tipo_pessoa;
		$participant->passaporte = Input::get('passaporte') != null ?  Input::get('passaporte') : $participant->passaporte;
		$participant->web_site = Input::get('web_site') != null ?  Input::get('web_site') : $participant->web_site;
		$participant->responsavel = Input::get('responsavel') != null ?  Input::get('responsavel') : $participant->responsavel;
		$participant->observacao = Input::get('observacao') != null ?  Input::get('observacao') : $participant->observacao;
		$participant->cargo = Input::get('cargo') != null ?  Input::get('cargo') : $participant->cargo;
		$participant->pais_res = Input::get('pais_res') != null ?  Input::get('pais_res') : $participant->pais_res;
		$participant->pais_com = Input::get('pais_com') != null ?  Input::get('pais_com') : $participant->pais_com;
		$participant->municipio_res = Input::get('municipio_res') != null ?  Input::get('municipio_res') : $participant->municipio_res;
		$participant->municipio_com = Input::get('municipio_com') != null ?  Input::get('municipio_com') : $participant->municipio_com;
		$participant->ddi_com = Input::get('ddi_com') != null ?  Input::get('ddi_com') : $participant->ddi_com;
		$participant->ddd_com = Input::get('ddd_com') != null ?  Input::get('ddd_com') : $participant->ddd_com;
		$participant->ddi_two_res = Input::get('ddi_two_res') != null ?  Input::get('ddi_two_res') : $participant->ddi_two_res;
		$participant->ddi_two_com = Input::get('ddi_two_com') != null ?  Input::get('ddi_two_com') : $participant->ddi_two_com;
		$participant->ddd_two_res = Input::get('ddd_two_res') != null ?  Input::get('ddd_two_res') : $participant->ddd_two_res;
		$participant->ddd_two_com = Input::get('ddd_two_com') != null ?  Input::get('ddd_two_com') : $participant->ddd_two_com;
		$participant->ddi_cel_com = Input::get('ddi_cel_com') != null ?  Input::get('ddi_cel_com') : $participant->ddi_cel_com;
		$participant->telefone_com = Input::get('telefone_com') != null ?  Input::get('telefone_com') : $participant->telefone_com;
		$participant->telefone_seg_res = Input::get('telefone_seg_res') != null ?  Input::get('telefone_seg_res') : $participant->telefone_seg_res;
		$participant->telefone_seg_com = Input::get('telefone_seg_com') != null ?  Input::get('telefone_seg_com') : $participant->telefone_seg_com;
		$participant->ddd_cel_com = Input::get('ddd_cel_com') != null ?  Input::get('ddd_cel_com') : $participant->ddd_cel_com;
		$participant->celular_com = Input::get('celular_com') != null ?  Input::get('celular_com') : $participant->celular_com;
		$participant->save();

		Auth::login($participant->associate->getuser);

		$array = array(
			'msg_success' => Lang::get('messages.login_welcome'),
			'usertype' => $usertype,
			'inscription' => $inscription
			);

		return Redirect::to($inscription->course->route.'/acesso')->with( $array );

	}

	/* ----------------------------------------------- */

	public function getTrabalhoassociado ( $usertype = '' ){

		//dd(Input::all());

		$msg_error = Session::get('msg_error');
		$usertype = UserTypes::find( $usertype );
		$course = $usertype->course;

		$array = array( 
			'msg_error' => $msg_error, 
			'course' => $course, 
			'usertype' => $usertype, 
			'contents' => FrontendCourseController::getOrderedContent($course->coursesections) 
			);

		return View::make('auth.associate')->with( $array );

	}

	public function postTrabalhoassociado (){

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

				return Redirect::to('/autenticacao/trabalhoactualizacaoassociado/')->with( $array );

			else:

				$inscription = new Inscriptions();
				$inscription->id_course = $course->id;
				$inscription->id_user = Auth::user()->id;
				$inscription->id_usertype = $usertype->id;
				$inscription->save();

				$array = array(
					'inscription' => $inscription
					);

				return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

			endif;

		else:

			$associate = Associates::getByEmail($credentials['email']);

			//var_dump($associate[0]);
			/*
			echo "Tipeado: " . $credentials['password'] . '<br>';

			die(md5($credentials['password']) . '<br>'. $associate[0]->password);*/

			if(!empty($associate[0])):

				$associate = $associate[0];

				if($associate->password == md5($credentials['password']) ):

					$user_finded = User::where('email','=', $credentials['email'])->take(1)->get();

					$user = null;

					if(!empty($user_finded[0])):

						$user = $user_finded[0];					
						$user->password = Hash::make($credentials['password']);
						$user->save();

					else:

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

					endif;

					$associate->user = $user->id;
					$associate->save();

					Auth::login($user);

					if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

						$array = array(
							'msg_success' => Lang::get('messages.login_welcome'),
							'usertype' => $usertype,
							'inscription' => $inscription
							);

						return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

					else:

						$inscription = new Inscriptions();
						$inscription->id_course = $course->id;
						$inscription->id_user = Auth::user()->id;
						$inscription->id_usertype = $usertype->id;
						$inscription->save();

						$array = array(
							'inscription' => $inscription
							);

						return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

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

								return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

							else:

								$inscription = new Inscriptions();
								$inscription->id_course = $course->id;
								$inscription->id_user = Auth::user()->id;
								$inscription->id_usertype = $usertype->id;
								$inscription->save();

								$array = array(
									'inscription' => $inscription
									);

								return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

							endif;

						else:

							$array = array(
								'course' => $course,
								'usertype' => $usertype,
								'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
								);

							return View::make('auth.error')->with( $array );

						endif;

					else:

						$array = array(
							'course' => $course,
							'usertype' => $usertype,
							'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
							);

						return View::make('auth.error')->with( $array );

					endif;

					$array = array(
						'course' => $course,
						'usertype' => $usertype,
						'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
						);

					return View::make('auth.error')->with( $array );

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

							return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

						else:

							$inscription = new Inscriptions();
							$inscription->id_course = $course->id;
							$inscription->id_user = Auth::user()->id;
							$inscription->id_usertype = $usertype->id;
							$inscription->save();

							$array = array(
								'inscription' => $inscription
								);

							return Redirect::to('/autenticacao/trabalhoactualizacaoassociado')->with( $array );

						endif;

					else:

						$array = array(
							'course' => $course,
							'usertype' => $usertype,
							'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
							);

						return View::make('auth.error')->with( $array );

					endif;

				else:

					$array = array(
						'course' => $course,
						'usertype' => $usertype,
						'contents' => FrontendCourseController::getOrderedContent($course->coursesections)
						);

					return View::make('auth.error')->with( $array );

				endif;

			endif;

		endif;

	}

	public function getTrabalhoparticipante( $usertype ){

		$msg_error = Session::get('msg_error');
		$usertype = UserTypes::find($usertype);
		$course = $usertype->course;
		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

		$array =  array( 
			'msg_error' => $msg_error, 
			'course' => $course, 
			'usertype' => $usertype, 
			'contents' => $contents 
			);

		return View::make('auth.participant')->with( $array );

	}

	public function postTrabalhoparticipante(){

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

					return Redirect::to('/autenticacao/trabalhoactualizacaoparticipante')->with( $array );

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

					return Redirect::to('/autenticacao/trabalhoactualizacaoparticipante')->with( $array );

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

					return Redirect::to('/autenticacao/trabalhoactualizacaoparticipante')->with( $array );

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

					return Redirect::to('/autenticacao/trabalhoactualizacaoparticipante')->with( $array );

				endif;

			endif;

		else:

			$participant = ORGParticipants::getByCPF($credentials['cpf']);

			if(!empty($participant[0])):

				$participant = $participant[0];

				$user = new User();
				$user->email = $participant->email;
				if($participant->nome != null):
					$user->name = $participant->nome;
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
				if($participant->nome != null):
					$part->name = $participant->nome;
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

					return Redirect::to('/autenticacao/trabalhoactualizacaoparticipante')->with( $array );

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

					return Redirect::to('/autenticacao/trabalhoactualizacaoparticipante')->with( $array );

				endif;

			else:

				$array = array( 
					'cpf' => $credentials['cpf'], 
					'msg_error' => Lang::get('messages.login_not_participant'), 
					'course' => $course->id,
					'usertype' => $usertype->id
					);

				return Redirect::to('/autenticacao/trabalhocadastro')->with( $array );

			endif;

		endif;

	}

	public function getTrabalhocadastro(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$usertype = UserTypes::find(Session::get('usertype'));

		$course = Courses::find(Session::get('course'));
		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

		$array = array(
			'cpf' => $cpf,
			'estados' => $estados,
			'usertype' => $usertype,
			'course' => $course,
			'contents' => $contents
			);

		return View::make('auth.register')->with( $array );

	}

	public function postTrabalhocadastro(){

		$course = Courses::find(Input::get('course'));

		$usertype = UserTypes::find(Input::get('usertype'));

		$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();
		$estado_empresa = ORGStates::where('id_estado', '=', Input::get('estado_empresa'))->take(1)->get();

		//dd(Input::all());

		$participant = new ORGParticipants();
		$participant->nome = Input::get('nome') != null ? Input::get('nome') : '';
		$participant->rg = Input::get('rg') != null ? Input::get('rg') : '';
		$participant->cpf = Input::get('cpf') != null ? Input::get('cpf') : '';
		$participant->endereco = Input::get('endereco') != null ? Input::get('endereco') : '';
		$participant->numero = Input::get('numero') != null ? Input::get('numero') : '';
		$participant->complemento = Input::get('complemento') != null ? Input::get('complemento') : '';
		$participant->cep = Input::get('cep') != null ? Input::get('cep') : '';
		$participant->cidade = Input::get('cidade') != null ? Input::get('cidade') : '';
		$participant->estado = isset($estado[0]->name_estado) ? $estado[0]->name_estado : '';
		/*$participant->empresa = Input::get('empresa') != null ? Input::get('empresa') : '';
		$participant->cnpj = Input::get('cnpj_empresa') != null ? Input::get('cnpj_empresa') : '';
		$participant->endereco_empresa = Input::get('endereco_empresa') != null ? Input::get('endereco_empresa') : '';
		$participant->numero_empresa = Input::get('nome') != null ? Input::get('nome') : '';
		$participant->complemento_empresa = Input::get('complemento_empresa') != null ? Input::get('complemento_empresa') : '';
		$participant->cep_empresa = Input::get('cep_empresa') != null ? Input::get('cep_empresa') : '';
		$participant->cidade_empresa = Input::get('cidade_empresa') != null ? Input::get('cidade_empresa') : '';
		$participant->estado_empresa = isset($estado_empresa[0]->name_estado) ? $estado_empresa[0]->name_estado : '';
		$participant->celular = Input::get('celular_empresa') != null ? Input::get('celular_empresa') : '';*/
		$participant->telefone = Input::get('telefone_empresa') != null ? Input::get('telefone_empresa') : '';
		$participant->email = Input::get('email') != null ? Input::get('email') : '';
		$participant->save();

		$user = new User();
		$user->email = $participant->email;
		if($participant->nome != null):
			$user->name = $participant->nome;
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
		$part->type = 'participant';
		$part->save();

		Auth::login($user);

		if($inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id )):

			$array = array(
				'msg_success' => Lang::get('messages.login_welcome'),
				'usertype' => $usertype,
				'inscription' => $inscription
				);

			return Redirect::to($course->route.'/arquivos')->with( $array );

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
		
			return Redirect::to($course->route.'/arquivos')->with( $array );

		endif;

	}

	public function getTrabalhoactualizacaoparticipante(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$inscription = Session::get('inscription');

		$usertype = $inscription->usertype;

		$participant = $inscription->user->participant->participante;

		$course = $inscription->course;
		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

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

	public function postTrabalhoactualizacaoparticipante(){

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
		/*$participant->cnpj = Input::get('cnpj_empresa');
		$participant->endereco_empresa = Input::get('endereco_empresa');
		$participant->numero_empresa = Input::get('nome');
		$participant->complemento_empresa = Input::get('complemento_empresa');
		$participant->cep_empresa = Input::get('cep_empresa');
		$participant->cidade_empresa = Input::get('cidade_empresa');
		$participant->estado_empresa = $estado_empresa[0]->name_estado;
		$participant->celular = Input::get('celular_empresa');*/
		$participant->telefone = Input::get('telefone_empresa');
		$participant->email = Input::get('email');
		$participant->save();

		Auth::login($participant->participant->getuser);

		$array = array(
			'msg_success' => Lang::get('messages.login_welcome'),
			'usertype' => $usertype,
			'inscription' => $inscription
			);

		return Redirect::to($inscription->course->route.'/arquivos')->with( $array );

	}

	public function getTrabalhoactualizacaoassociado(){

		$estados = ORGStates::all();
		$cpf = Session::get('cpf');

		$msg_error = Session::get('msg_error');

		$inscription = Session::get('inscription');

		$usertype = $inscription->usertype;

		$participant = $inscription->user->associate->asociado;

		$course = $inscription->course;
		$contents = FrontendCourseController::getOrderedContent($course->coursesections);

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

	public function postTrabalhoactualizacaoassociado(){

		$course = Input::get('course');

		$usertype = Input::get('usertype');

		$inscription = Inscriptions::find(Input::get('inscription'));
		$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();
		$estado_empresa = ORGStates::where('id_estado', '=', Input::get('estado_empresa'))->take(1)->get();
		
		$participant = ORGAssociates::find(Input::get('id'));

		$participant->nombre_completo = Input::get('nombre_completo') != null ?  Input::get('nombre_completo') : $participant->nombre_completo;
		$participant->rg = Input::get('rg') != null ? Input::get('rg') : $participant->rg;
		$participant->razon_social = Input::get('razon_social') != null ?  Input::get('razon_social') : $participant->razon_social;
		$participant->inscripcion_estadual = Input::get('inscription_estadual') != null ?  Input::get('inscription_estadual') : $participant->inscripcion_estadual;
		$participant->inscripcion_municipal = Input::get('inscription_municipal') != null ?  Input::get('inscription_municipal') : $participant->inscripcion_municipal;
		$participant->tipo_pessoa = Input::get('tipo_pessoa') != null ?  Input::get('tipo_pessoa') : $participant->tipo_pessoa;
		$participant->cpf = Input::get('cpf') != null ?  Input::get('cpf') : $participant->cpf;
		$participant->cnpj = Input::get('cnpj') != null ?  Input::get('cnpj') : $participant->cnpj;
		$participant->passaporte = Input::get('passaporte') != null ?  Input::get('passaporte') : $participant->passaporte;
		$participant->email = Input::get('email') != null ?  Input::get('email') : $participant->email;
		$participant->web_site = Input::get('web_site') != null ?  Input::get('web_site') : $participant->web_site;
		$participant->responsavel = Input::get('responsavel') != null ?  Input::get('responsavel') : $participant->responsavel;
		$participant->observacao = Input::get('observacao') != null ?  Input::get('observacao') : $participant->observacao;
		$participant->empresa = Input::get('empresa') != null ?  Input::get('empresa') : $participant->empresa;
		$participant->cargo = Input::get('cargo') != null ?  Input::get('cargo') : $participant->cargo;
		$participant->cep_res = Input::get('cep_res') != null ?  Input::get('cep_res') : $participant->cep_res;
		$participant->cep_com = Input::get('cep_com') != null ?  Input::get('cep_com') : $participant->cep_com;
		$participant->logradouro_res = Input::get('logradouro_res') != null ?  Input::get('logradouro_res') : $participant->logradouro_res;
		$participant->logradouro_com = Input::get('logradouro_com') != null ?  Input::get('logradouro_com') : $participant->logradouro_com;
		$participant->dir_res = Input::get('dir_res') != null ?  Input::get('dir_res') : $participant->dir_res;
		$participant->dir_com = Input::get('dir_com') != null ?  Input::get('dir_com') : $participant->dir_com;
		$participant->complemento_res = Input::get('complemento_res') != null ?  Input::get('complemento_res') : $participant->complemento_res;
		$participant->complemento_com = Input::get('complemento_com') != null ?  Input::get('complemento_com') : $participant->complemento_com;
		$participant->numero_res = Input::get('numero_res') != null ?  Input::get('numero_res') : $participant->numero_res;
		$participant->numero_com = Input::get('numero_com') != null ?  Input::get('numero_com') : $participant->numero_com;
		$participant->bairro_res = Input::get('bairro_res') != null ?  Input::get('bairro_res') : $participant->bairro_res;
		$participant->bairro_com = Input::get('bairro_com') != null ?  Input::get('bairro_com') : $participant->bairro_com;
		$participant->pais_res = Input::get('pais_res') != null ?  Input::get('pais_res') : $participant->pais_res;
		$participant->pais_com = Input::get('pais_com') != null ?  Input::get('pais_com') : $participant->pais_com;
		$participant->municipio_res = Input::get('municipio_res') != null ?  Input::get('municipio_res') : $participant->municipio_res;
		$participant->municipio_com = Input::get('municipio_com') != null ?  Input::get('municipio_com') : $participant->municipio_com;
		$participant->uf_res = Input::get('uf_res') != null ?  Input::get('uf_res') : $participant->uf_res;
		$participant->uf_com = Input::get('uf_com') != null ?  Input::get('uf_com') : $participant->uf_com;
		$participant->ddi_res = Input::get('ddi_res') != null ?  Input::get('ddi_res') : $participant->ddi_res;
		$participant->ddi_com = Input::get('ddi_com') != null ?  Input::get('ddi_com') : $participant->ddi_com;
		$participant->ddd_res = Input::get('ddd_res') != null ?  Input::get('ddd_res') : $participant->ddd_res;
		$participant->ddd_com = Input::get('ddd_com') != null ?  Input::get('ddd_com') : $participant->ddd_com;
		$participant->ddi_two_res = Input::get('ddi_two_res') != null ?  Input::get('ddi_two_res') : $participant->ddi_two_res;
		$participant->ddi_two_com = Input::get('ddi_two_com') != null ?  Input::get('ddi_two_com') : $participant->ddi_two_com;
		$participant->ddd_two_res = Input::get('ddd_two_res') != null ?  Input::get('ddd_two_res') : $participant->ddd_two_res;
		$participant->ddd_two_com = Input::get('ddd_two_com') != null ?  Input::get('ddd_two_com') : $participant->ddd_two_com;
		$participant->ddi_cel_res = Input::get('ddi_cel_res') != null ?  Input::get('ddi_cel_res') : $participant->ddi_cel_res;
		$participant->ddi_cel_com = Input::get('ddi_cel_com') != null ?  Input::get('ddi_cel_com') : $participant->ddi_cel_com;
		$participant->telefone_res = Input::get('telefone_res') != null ?  Input::get('telefone_res') : $participant->telefone_res;
		$participant->telefone_com = Input::get('telefone_com') != null ?  Input::get('telefone_com') : $participant->telefone_com;
		$participant->telefone_seg_res = Input::get('telefone_seg_res') != null ?  Input::get('telefone_seg_res') : $participant->telefone_seg_res;
		$participant->telefone_seg_com = Input::get('telefone_seg_com') != null ?  Input::get('telefone_seg_com') : $participant->telefone_seg_com;
		$participant->ddd_cel_res = Input::get('ddd_cel_res') != null ?  Input::get('ddd_cel_res') : $participant->ddd_cel_res;
		$participant->ddd_cel_com = Input::get('ddd_cel_com') != null ?  Input::get('ddd_cel_com') : $participant->ddd_cel_com;
		$participant->celular_res = Input::get('celular_res') != null ?  Input::get('celular_res') : $participant->celular_res;
		$participant->celular_com = Input::get('celular_com') != null ?  Input::get('celular_com') : $participant->celular_com;
		$participant->save();

		Auth::login($participant->associate->getuser);

		$array = array(
			'msg_success' => Lang::get('messages.login_welcome'),
			'usertype' => $usertype,
			'inscription' => $inscription
			);

		return Redirect::to($inscription->course->route.'/arquivos')->with( $array );

	}

	/*public function getLogin(){

		return View::make('auth.login');

	}

	public function postLogin(){

		$credentials = array(
			'login' => Input::get('login'),
			'password' => Input::get('password')
			);

		if(Auth::attempt($credentials)):
			return Redirect::to('/dashboard');
			//return Redirect::to('/ingreso');

		else:
			return View::make('auth.login')->with('err', 'Usuario o Contraseña Inválidos');
		endif;

	}*/

}