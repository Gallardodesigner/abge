<?php

class FrontendGalleryController extends \BaseController {

	public static $route = '/galeria';

	public function getIndex(){

		$albums = SFAlbum::all();

		$args = array(
			'albums' => $albums,
			'route' => self::$route
			);

		return View::make('frontend.galleries.index')->with($args);

	}

	public function getVer( $id ){

		$album = SFAlbum::find(strstr($id, '-', true));

		if($album):

			$args = array(
				'album' => $album,
				'galleries' => $album->galleries,
				'route' => self::$route,
				);

			return View::make('frontend.galleries.view')->with($args);

		else:

			return View::make('specialpages.404');

		endif;

	}

}