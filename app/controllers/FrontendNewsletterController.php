<?php

class FrontendNewsletterController extends \BaseController {

	public static $route = '/noticias';

	public function getIndex(){

		$noticias = SFNews::where('status','=','1')->orderBy('date','DESC')->paginate(10);

		$args = array(
			'noticias' => $noticias,
			'route' => self::$route,
			);

		return View::make('frontend.noticias.index')->with($args);

	}

	public function getDetalle( $permalink = '' ){

		$noticia = SFNews::where('permalink','=',$permalink)->where('status','=','1')->take(1)->get();

		if(isset($noticia[0])):

			$args = array(
				'noticia' => $noticia[0],
				'route' => self::$route,
				);

			return View::make('frontend.noticias.detail')->with($args);

		else:

			return View::make('specialpages.404');

		endif;

	}

}