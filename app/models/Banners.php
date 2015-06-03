<?php

class Banners extends \Eloquent {

	protected $connection = 'mysql';

	protected $table = 'banners';

	public static $images_folder = 'uploads/openx/images/';

/* --------------------------- */

	public static function _get( $type, $status = 'all' ){
		$status_operator = '=';
		switch($status){
			case 'all':
				$status_operator = '!=';
				break;
			case 'untrash':
				$status_operator = '!=';
				$status = 'trash';
				break;
			case 'publish':
			case 'draft':
			case 'trash':
			default:
				$status = $status;
				break;
		}
		switch($type){
			case 'all':
				$type_operator = 'NOT LIKE';
				break;
			case 'not_publicaciones':
				$type_operator = 'NOT LIKE';
				$type = 'publicaciones';
				break;
			default:
				$type_operator = 'LIKE';
				break;
		}
		
		return self::where( 'type',$type_operator, '%'.$type.'%' )->where( 'status', $status_operator, $status )->orderBy('created_at', 'desc')->get();
	}

	public static function getRand( $type, $status = 'publish'){

		$banners = self::_get($type, $status);

		$pos = rand(0, count($banners)-1);

		return $banners[$pos];

	}

	public static function getImage($type){

		$banner = self::getRand($type, 'publish');

		return '<img width="250" src="/'.self::$images_folder.$banner->image.'"/>';

	}

	public static function getOldPublicaciones(){

		$publicaciones = self::_get('publicaciones');

		$pos1 = rand(0, count($publicaciones)-1);
		$pos2 = self::getPubRand(count($publicaciones)-1, $pos1);
		return '<img src="/'.self::$images_folder.$publicaciones[$pos1]->image.'"/><img src="/'.self::$images_folder.$publicaciones[$pos2]->image.'"/>';

	}

	public static function getPubRand($length,$pos){

		$ptmp = rand(0, $length);

		if($ptmp == $pos) return self::getPubRand($length,$pos);

		return $ptmp;

	}

	public static function _edit($id, $arg = 'draft'){
		$reg = self::find($id);
		$reg->status = $arg;
		$reg->save();
		return true;
	}

	public static function publish($id){
		return self::_edit($id, 'publish');
	}

	public static function draft($id){
		return self::_edit($id, 'draft');
	}

	public static function trash($id){
		return self::_edit($id, 'trash');
	}

	public static function upload($image){

		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$newheight=array();
		$width=array("100","200","400",$info_image[0]);
		#$filename = "prueba.".$image->getClientOriginalExtension();
		$filename = str_replace('/', '!', Hash::make($image->getClientOriginalName().date('Y-m-d H:i:s'))).".".$image->getClientOriginalExtension();
		$nombres=["thumb_".$filename,"small_".$filename,"medium_".$filename,$filename];

		for ($i=0; $i <count($width) ; $i++):

			$path = public_path(self::$images_folder.$nombres[$i]);
			Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
		
		endfor;

		return $filename;
		
	}

}



	# ----------------------- OLD -------------------------- #

	/**/