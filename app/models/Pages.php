<?php

class Pages extends \Eloquent {

	protected $connection = 'mysql';

	protected $table = 'pages';

	public $primaryKey  = 'id';

	public function parent(){

		return $this->belongsTo('Pages', 'id_parent','id');
		
	}

	public function children(){

		return $this->hasMany('Pages', 'id_parent','id')->where('status','=','active');

	}

	public static function getByName( $name ){

		$page = self::where('name','=',$name)->take(1)->get();

		if(isset($page[0])):

			return $page[0];

		else:

			return false;

		endif;

	}

}