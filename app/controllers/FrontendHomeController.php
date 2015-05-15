<?php

class FrontendHomeController extends \BaseController {

	public static $route = '/';

	public function getIndex(){

		return View::make('frontend.home.index');
		
	}

}