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

			return Redirect::to( self::$route )->with(array('msg_error'=>'Usuario o Contraseña Inválidos'));

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

			return Redirect::to( self::$route )->with(array('msg_error'=>'Usuario o Contraseña Inválidos'));

		endif;

	}

}