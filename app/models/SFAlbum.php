<?php

class SFAlbum extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'sf_album';

	public $primaryKey  = 'id_album';

	public $timestamps = false;

	public function galleries(){

		return $this->hasMany('SFGallery', 'id_album', 'id_album');

	}

	public function getGalleries($status = '1', $orderBy = 'sf_album_content.position', $sort = 'ASC' ){

		$galleries = $this->galleries();

		if($status != '-1'):

			$galleries = $galleries->where('status','=',$status);

		endif;

		$galleries = $galleries->orderBy($orderBy, $sort);

		return $galleries->get();

	}

	public function getFirstImage(){

		$image = $this->galleries()->take(1)->get();

		if(isset($image[0])):

			return $image[0];

		else:

			return null;

		endif;

	}

	public function getFirstImageURI(){

		$image = $this->getFirstImage();

		if($image != null):

			return $image->image;

		else:

			return null;

		endif;
		
	}

	public function getBitURI(){

		return $this->id_album.'-'.substr(BaseController::remove_spaces( ucwords(BaseController::remove_accents( $this->album_name ) ) ), 0, 7 );

	}

}