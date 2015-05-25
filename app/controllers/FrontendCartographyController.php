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

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.cartography.trabalhos')->with($args);

	}

}