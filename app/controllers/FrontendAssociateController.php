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

		return View::make('frontend.associates.anuidades')->with($args);

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

		return View::make('frontend.associates.ajuda')->with($args);

	}

	public function getCadastro(){

		$associate = Auth::user()->user()->associate->asociado;
		$categories = ORGAssociateCategories::all();
		$logradouros = ORGBackyards::all();
		$ufs = ORGuf::all();

		$args = array(
			'associate' => $associate,
			'categories' => $categories,
			'logradouros' => $logradouros,
			'ufs' => $ufs,
			'route' => self::$route,
			'module' => 'associados_cadastro',
			);

		return View::make('frontend.associates.cadastro')->with($args);

	}

	public function postCadastro(){

		dd(Input::all());

	}

	public function postMunicipios(){

		$uf = ORGuf::find(Input::get('id'));
		$html = '';

		foreach ($uf->towns as $municipio):
			$html .= "<option value='".$municipio->id_municipio."'>". $municipio->name_municipio ."</option>";
		endforeach;

		return $html;

	}

}