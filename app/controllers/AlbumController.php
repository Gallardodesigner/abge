<?php

class AlbumController extends \BaseController {

	public static $route = '/dashboard/galleries';

	public function getIndex(){

		$albums = SFAlbum::all();

		$args = array(
			'route' => self::$route,
			'albums' => $albums,
			);

		return View::make('backend.albums.index')->with($args);

	}

	public function getCreate(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('backend.albums.create')->with($args);

	}

	public function postCreate(){

		$album = new SFAlbum();
		$album->album_name = Input::get('album_name');
		$album->leyenda = Input::get('leyenda');
		$album->fecha = date('Y-m-d', strtotime(Input::get('fecha')));
		$album->save();

		return Redirect::to(self::$route);

	}

	public function getUpdate($id){

		$album = SFAlbum::find($id);

		$args = array(
			'route' => self::$route,
			'album' => $album,
			);

		return View::make('backend.albums.edit')->with($args);

	}

	public function postUpdate($id){

		$album = SFAlbum::find($id);
		$album->album_name = Input::get('album_name');
		$album->leyenda = Input::get('leyenda');
		$album->fecha = date('Y-m-d', strtotime(Input::get('fecha')));
		$album->save();

		return Redirect::to(self::$route);

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to(self::$route)->with('msg_error', Lang::get('messages.albums_display_err'));

		else:

			$album = SFAlbum::find($id);

			$delete = SFAlbum::destroy($id);

			if(!$delete):

				return Redirect::to(self::$route)->with('msg_error', Lang::get('messages.albums_delete_err', array( 'title' => $album->title )));

			else:

				return Redirect::to(self::$route)->with('msg_success', Lang::get('messages.albums_delete', array( 'title' => $album->title )));

			endif;

		endif;

	}

}