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

}