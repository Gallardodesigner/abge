<?php

class NewsletterController extends \BaseController {

	public static $route = '/dashboard/newsletters';

	public function getIndex(){

		$newsletters = Newsletters::paginate(50);

		$args = array(
			'route' => self::$route,
			'newsletters' => $newsletters,
			'filter' => '',
			);

		return View::make('backend.newsletters.index')->with($args);

	}

	public function getCreate(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('backend.newsletters.create')->with($args);

	}

	public function postCreate(){

		$newsletter = new Newsletters();
		$newsletter->name = Input::get('name');
		$newsletter->email = Input::get('email');
		$newsletter->save();

		return Redirect::to(self::$route);

	}

	public function getUpdate($id){

		$newsletter = Newsletters::find($id);

		$args = array(
			'route' => self::$route,
			'newsletter' => $newsletter,
			);

		return View::make('backend.newsletters.edit')->with($args);

	}

	public function postUpdate($id){

		$newsletter = Newsletters::find($id);
		$newsletter->name = Input::get('name');
		$newsletter->email = Input::get('email');
		$newsletter->save();

		return Redirect::to(self::$route);

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to(self::$route)->with('msg_error', Lang::get('messages.newsletters_display_err'));

		else:

			$newsletter = Newsletters::find($id);

			$delete = Newsletters::destroy($id);

			if(!$delete):

				return Redirect::to(self::$route)->with('msg_error', Lang::get('messages.newsletters_delete_err', array( 'title' => $newsletter->title )));

			else:

				return Redirect::to(self::$route)->with('msg_success', Lang::get('messages.newsletters_delete', array( 'title' => $newsletter->title )));

			endif;

		endif;

	}

}