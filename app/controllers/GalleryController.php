<?php

class GalleryController extends \BaseController {

	protected $parent = '/dashboard/galleries/';

	protected $route = '/dashboard/galleries/{idAlbum}/pictures';

	public function getIndex( $idAlbum ){

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		$album = SFAlbum::find($idAlbum);

		if($album):

			return View::make('backend.albums.pictures.index', array(
			'album' => $album,
			'pictures' => $album->galleries,
			'parent' => $this->parent,
			'route' => self::parseRoute($idAlbum),
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

		else:

			return Redirect::to($this->parent)->with(array('msg_error' => Lang::get('messages.album_not_found')));

		endif;

	}

	public function getCreate( $idAlbum ){

		$album = SFAlbum::find($idAlbum);

		if($album):

			return View::make('backend.albums.pictures.create', array(
				'album' => $album,
				'route' => self::parseRoute($idAlbum),
				));

		else:

			return Redirect::to($this->parent)->with(array('msg_error' => Lang::get('messages.album_not_found')));

		endif;

	}

	public function postCreate( $idAlbum ){

		$image = Input::file('url');

		$validator = Validator::make(
			array(
				'image' => $image
				), 
			array(
				'image' => 'required|mimes:png,jpeg,gif'
				),
			array(
				'mimes' => 'Tipo de imagen inválido, solo se admite los formatos PNG, JPEG, y GIF'
				)
			);

		if($validator->fails()):

			return Redirect::to(self::parseRoute($idAlbum).'/create')->with('msg_succes', Lang::get('messages.companies_create_img_err'));

		else:

			$filename = $this->uploadImage($image);

			$picture = new SFGallery();
			$picture->id_album = $idAlbum;
			$picture->status = 1;
			$picture->position = 0;
			$picture->image = $filename;

			if($picture->save()):

				return Redirect::to(self::parseRoute($idAlbum));

			else:

				return Redirect::to(self::parseRoute($idAlbum));

			endif;

		endif;

	}

	public function getDelete( $idAlbum, $idPicture = '' ){

		if( $idPicture == '' ):

			return Redirect::to(self::parseRoute($idAlbum))->with('msg_error', Lang::get('messages.pictures_display_err'));

		else:

			$picture = SFGallery::find($idPicture);

			$delete = SFGallery::destroy($idPicture);

			if(!$delete):

				return Redirect::to(self::parseRoute($idAlbum))->with('msg_error', Lang::get('messages.pictures_delete_err', array( 'title' => $picture->title )));

			else:

				return Redirect::to(self::parseRoute($idAlbum))->with('msg_success', Lang::get('messages.pictures_delete', array( 'title' => $picture->title )));

			endif;

		endif;

	}

	public function parseRoute( $idAlbum ){

		return str_replace('{idAlbum}', $idAlbum, $this->route );

	}

	public function uploadImage($image){

		//dd(storage_path('uploads/'));

		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$newheight=array();
		$width=array("100","220",$info_image[0]);
		#$filename = "prueba.".$image->getClientOriginalExtension();
		$filename = str_replace('/', '!', Hash::make($image->getClientOriginalName().date('Y-m-d H:i:s'))).".".$image->getClientOriginalExtension();
		$nombres=["small_".$filename,"medium_".$filename,"big_".$filename];

		for ($i=0; $i <count($width) ; $i++):

			$path = public_path('uploads/photo_album/'.$nombres[$i]);
			Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
		
		endfor;

		return $filename;
		
	}

}