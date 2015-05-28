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
			return View::make('auth.associates')->with( array( 'msg_error' => $msg_error, 'route' => self::$route ) );
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

			return Redirect::to( self::$route )->with(array('msg_error'=>'Usuário ou Senha Invalida!'));

		endif;

	}

	public function getCadastro(){

		$page = Pages::where('name','=','cadastro')->take(1)->get();
		if(isset($page[0])) $page = $page[0];
		else $page = false;

		$args = array(
			'route' => self::$route,
			'page' => $page,
			);

		return View::make('auth.cadastro')->with($args);

	}

	public function getSenha(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('auth.senha')->with($args);

	}

	public function postSenha(){

		$associate = ORGAssociates::where('email','=',Input::get('login'))->take(1)->get();

		if(isset($associate[0])):

			$new_password = Hashids::encode(date('YmdHis'));

			$associate = $associate[0];

			$associate->senha = md5($new_password);
			$associate->save();

			$user = null;

			if($associate->associate != null):

				$user = $associate->associate->getuser;
				$user->password = Hash::make($new_password);
				$user->save();

			else:

				$user = new User();
				$user->type = 'associate';
				$user->email = $associate->email;
				$user->password = Hash::make($new_password);
				$user->name = $associate->nombre_completo;
				$user->status = 'publish';
				$user->save();

				$assoc = new Associates();
				$assoc->associate = $associate->id_asociado;
				$assoc->user = $user->id;
				$assoc->name = $associate->nombre_completo;
				$assoc->email = $associate->email;
				$assoc->password = $associate->senha;
				$assoc->cpf = $associate->cpf;
				$assoc->type = 'associate';
				$assoc->status = 'publish';
				$assoc->save();

			endif;

			$data = array(
			    'associate' => $associate,
			    // 'user' => $user,
			    'password' => $new_password
			);

			Mail::send(array('html' => 'emails.password'), $data, function($message) use ($associate)
			{
				$message->from('teste@abge.org.br', 'ABGE');
			    $message->to($associate->email, $associate->nombre_completo)->subject('Esqueci minha senha!');
			    /*$message->to('amontenegro.sistemas@gmail.com', $associate->nombre_completo)->subject('Esqueci minha senha!');*/
			    $message->to('igor@gallardodesigner.com.br', $associate->nombre_completo)->subject('Esqueci minha senha!');
			});

			return Redirect::to(self::$route);

		else:

			dd('email no encontrado');

		endif;

		return Redirect::to(self::$route);

	}

	public function postCadastrofisica(){

		if(count(ORGAssociates::where('email','=', Input::get('login'))->get()) > 0):

			return Redirect::to(self::$route.'/cadastrofisica')->with(array('msg_error'=>'Email Cadastrado'));

		elseif(count(User::where('email','=',Input::get('login'))->get()) > 0):

			return Redirect::to(self::$route.'/cadastrofisica')->with(array('msg_error'=>'Email Cadastrado'));

		else:

		$org_associate = new ORGAssociates();
		$org_associate->email = Input::get('login');
		$org_associate->senha = md5(Input::get('password'));
		$org_associate->tipo_pessoa = 'F';
		$org_associate->save();

		$user = new User();
		$user->email = Input::get('login');
		$user->password = Hash::make(Input::get('password'));
		$user->type = 'associate';
		$user->status = 'publish';
		$user->save();

		$associate = new Associates();
		$associate->email = Input::get('login');
		$associate->password = md5(Input::get('password'));
		$associate->user = $user->id;
		$associate->associate = $org_associate->id_asociado;
		$associate->type = 'associate';
		$associate->status = 'publish';
		$associate->save();

		Auth::user()->login($user);

		return Redirect::to(self::$route);
			
		endif;
		
	}

	public function postCadastrojuridica(){

		if(count(ORGAssociates::where('email','=', Input::get('login'))->get()) > 0):

			return Redirect::to(self::$route.'/cadastrojuridica')->with(array('msg_error'=>'Email Cadastrado'));

		elseif(count(User::where('email','=',Input::get('login'))->get()) > 0):

			return Redirect::to(self::$route.'/cadastrojuridica')->with(array('msg_error'=>'Email Cadastrado'));

		else:

		$org_associate = new ORGAssociates();
		$org_associate->email = Input::get('login');
		$org_associate->senha = md5(Input::get('password'));
		$org_associate->tipo_pessoa = 'J';
		$org_associate->save();

		$user = new User();
		$user->email = Input::get('login');
		$user->password = Hash::make(Input::get('password'));
		$user->type = 'associate';
		$user->status = 'publish';
		$user->save();

		$associate = new Associates();
		$associate->email = Input::get('login');
		$associate->password = md5(Input::get('password'));
		$associate->user = $user->id;
		$associate->associate = $org_associate->id_asociado;
		$associate->type = 'associate';
		$associate->status = 'publish';
		$associate->save();

		Auth::user()->login($user);

		return Redirect::to(self::$route);
			
		endif;
		
	}

	public function getCadastrofisica(){

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
			return View::make('auth.index')->with( array( 'msg_error' => $msg_error ) );
		endif;

	}

	public function getCadastrojuridica(){

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
			return View::make('auth.index')->with( array( 'msg_error' => $msg_error ) );
		endif;

	}

	public function getBlank(){

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

	public function postBlank(){

		$credentials = array(
			'email' => Input::get('login'),
			'password' => Input::get('password')
			);

		if(Auth::user()->attempt($credentials)):

			return Redirect::to( self::$route );

		else:

			return Redirect::to( self::$route )->with(array('msg_error'=>'Usuário ou Senha Invalida!'));

		endif;

	}

}