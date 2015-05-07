<?php

class FrontendConsultoresController extends \BaseController {

	public static $route = '/consultores';

	public function getIndex(){

		$data = Input::get('area_de_especializacion');

		$consultores = ORGAssociates::where('classificados_view','=','1');

		if($data != null && $data != '-1'):

			$consultores = $consultores->where('area_de_especializacion','=',$data);

		endif;

		$consultores = $consultores->paginate(5);

		$args = array(
			'consultores' => $consultores,
			'data' => $data,
			'route' => self::$route,
			);

		return View::make('frontend.consultores.index')->with($args);

	}

}