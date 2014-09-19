<?php

class FrontendController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
		return Redirect::to('http://abge.org.br');
	}


}
