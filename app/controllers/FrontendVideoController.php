<?php

class FrontendVideoController extends \BaseController {

	public static $route = '/videos';

	public function getIndex(){

		$videos = SFVideos::all();

		$args = array(
			'videos' => $videos,
			'route' => self::$route
			);

		return View::make('frontend.video.index')->with($args);

	}

	public function getVer( $id ){

		$video = SFVideos::find(strstr($id, '-', true));

		if($video):

			$args = array(
				'video' => $video,
				'route' => self::$route,
				);

			return View::make('frontend.video.ver')->with($args);

		else:

			return View::make('specialpages.404');

		endif;

	}

}