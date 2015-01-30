<?php

class UserTypes extends \Eloquent {

	protected $fillable = [];

	protected $table = 'usertypes';

	public function course(){
		return $this->belongsTo('Courses', 'course_id');
	}

	public function dates(){
		return $this->hasMany('Dates', 'usertype_id', 'id');
	}

	public function inscriptions(){
		return $this->hasMany('Inscriptions', 'id_usertype', 'id');
	}
	public static function _get( $arg = 'all' ){
		$operator = '=';
		$status = '';
		switch($arg){
			case 'all':
				$operator = '!=';
				$status = '0';
				break;
			case 'untrash':
				$operator = '!=';
				$status = 'trash';
				break;
			case 'publish':
			case 'draft':
			case 'trash':
			default:
				$status = $arg;
				break;
		}
		
		return self::where( 'status', $operator, $status )->orderBy('created_at', 'desc')->get();
	}

	public static function findRoute( $route ){

		$has = self::where( 'route', '=', $route )->orderBy('created_at', 'asc')->take(1)->get();

		if(count($has) > 0): 

			return $has[0];

		else:

			return false;

		endif;

	}

	public static function getPublish(){
		return self::_get('publish');
	}

	public static function getDraft(){
		return self::_get('draft');
	}

	public static function getTrash(){
		return self::_get('trash');
	}

	public static function getUntrash(){
		return self::_get('untrash');
	}

	public static function getAll(){
		return self::_get('all');
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

}