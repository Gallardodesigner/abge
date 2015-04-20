<?php

class FrontendAssociateController extends \BaseController {

	protected static $route = '/associados';

	protected static $module = 'frontend_associate';

	public function getIndex(){

		$associate = Auth::user()->user()->associate->asociado;

		$args = array(
			'associate' => $associate,
			'route' => self::$route,
			'module' => 'associados_index',
			);

		return View::make('frontend.associates.index')->with($args);

	}

	public function getAnuidades(){

		$associate = Auth::user()->user()->associate->asociado;
		$annuities = $associate->payments;

		$args = array(
			'associate' => $associate,
			'annuities' => $annuities,
			'route' => self::$route,
			'module' => self::$module,
			);

		return View::make('frontend.associate.anuidades')->with($args);

	}

	public function getAjuda(){

		$associate = Auth::user()->user()->associate->asociado;
		$annuities = $associate->payments;

		$args = array(
			'associate' => $associate,
			'annuities' => $annuities,
			'route' => self::$route,
			'module' => self::$module,
			);

		return View::make('frontend.associate.ajuda')->with($args);

	}

}