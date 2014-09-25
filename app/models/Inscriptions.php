<?php

class Inscriptions extends Eloquent {

	public function course(){
		return $this->belongsTo('Courses', 'id_course');
	}

	public function usertype(){
		return $this->belongsTo('UserTypes', 'id_usertype');
	}

	public function user(){
		return $this->belongsTo('User', 'id_user');
	}

	public function files(){
		return $this->hasMany('Files', 'id_inscription', 'id');
	}

	public static function hasInscription( $idUser, $idCourse ){

		$has = self::where( 'id_course', '=', $idCourse )->where('id_user', '=', $idUser )->orderBy('created_at', 'desc')->take(1)->get();

		if(count($has) > 0): 

			return $has[0];

		else:

			return false;

		endif;

	}

}