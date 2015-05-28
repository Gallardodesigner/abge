<?php

class FrontendCartographyController extends \BaseController {

	public static $route = '/cartografia';

	public function getIndex(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.cartography.index')->with($args);

	}

	public function getObjetivos(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.cartography.objetivos')->with($args);

	}

	public function getTrabalhos(){

		$trabalhos = null;
		$q = Input::get('q');

		if($q != null):
			$trabalhos = Cartografias::where('nome_autor1','LIKE','%'.$q.'%')
				->orWhere('nome_do_meio1','LIKE','%'.$q.'%')
				->orWhere('sobrenome1','LIKE','%'.$q.'%')
				->orWhere('nome_autor2','LIKE','%'.$q.'%')
				->orWhere('nome_do_meio2','LIKE','%'.$q.'%')
				->orWhere('sobrenome2','LIKE','%'.$q.'%')
				->orWhere('nome_autor3','LIKE','%'.$q.'%')
				->orWhere('nome_do_meio3','LIKE','%'.$q.'%')
				->orWhere('sobrenome3','LIKE','%'.$q.'%')
				->orWhere('nome_autor4','LIKE','%'.$q.'%')
				->orWhere('nome_do_meio4','LIKE','%'.$q.'%')
				->orWhere('sobrenome4','LIKE','%'.$q.'%')
				->orWhere('nome_autor5','LIKE','%'.$q.'%')
				->orWhere('nome_do_meio5','LIKE','%'.$q.'%')
				->orWhere('sobrenome5','LIKE','%'.$q.'%')
				->orWhere('nome_autor6','LIKE','%'.$q.'%')
				->orWhere('nome_do_meio6','LIKE','%'.$q.'%')
				->orWhere('sobrenome6','LIKE','%'.$q.'%')
				->orWhere('resumen','LIKE','%'.$q.'%')
				->orWhere('titulo_trabajo','LIKE','%'.$q.'%')
				->orWhere('titulo','LIKE','%'.$q.'%')
				->orWhere('municipio','LIKE','%'.$q.'%')
				->orWhere('region','LIKE','%'.$q.'%')
				->orWhere('institucion','LIKE','%'.$q.'%')
				->paginate(10);
		else:
			$trabalhos = Cartografias::paginate(10);
		endif;

		$args = array(
			'route' => self::$route,
			'trabalhos' => $trabalhos,
			'q' => $q
			);

		return View::make('frontend.cartography.trabalhos')->with($args);

	}

	public function getVer( $id ){

		$trabalho = Cartografias::find(str_replace('cartografo-', '', $id));

		if($trabalho):
			$args = array(
				'route' => self::$route,
				'trabalho' => $trabalho
				);
				
			return View::make('frontend.cartography.ver')->with($args);
		else:
			return Redirect::to(self::$route.'/trabalhos');
		endif;

	}

	public function getAcesso(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.cartography.acesso')->with($args);
		
	}

	public function postAcesso(){

		$credentials = array(
			'login' => Input::get('login'),
			'password' => Input::get('password'),
			);

		$usuario_cartografia = null;

		/*$login = Auth::cartography()->attempt(array(
			'username' => 'Igor',
			'password' => 'e10adc3949ba59abbe56e057f20f883e:pXp60N5wSQ0IIr6E',
			));

		dd(Auth::cartography()->check());*/

		if(strpos($credentials['login'], '@') === false):

			$usuario_cartografia = CartografiaUsuarios::where('username','=',$credentials['login'])->where('senha','LIKE','%'.md5($credentials['password']).'%')->get();

		else:
			
			$usuario_cartografia = CartografiaUsuarios::where('email_user','=',$credentials['login'])->where('senha','LIKE','%'.md5($credentials['password']).'%')->get();

		endif;

		if(isset($usuario_cartografia[0])):

			$usuario_cartografia = $usuario_cartografia[0];

			// dd($usuario_cartografia);

			$login = Auth::cartography()->login($usuario_cartografia);

			dd($login);

			if($login):
				dd('Usuario Autenticado');
			else:
				dd('La fuerza que en ti se encuentra no es suficiente para la republica');
			endif;

		else:

		endif;

		dd($usuario_cartografia);

	}

	public function getCadastro(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.cartography.cadastro')->with($args);

	}

	public function postCadastro(){


	}

}