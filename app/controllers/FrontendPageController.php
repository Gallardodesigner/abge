<?php

class FrontendPageController extends \BaseController {

	public function getIndex( $name = ''){

		$page = Pages::getByName($name);

		if($page):

			$args = array(
				'page' => $page
				);

			return View::make('frontend.pages.index')->with($args);

		else:

		endif;

	}

}