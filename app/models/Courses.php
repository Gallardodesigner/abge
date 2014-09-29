<?php

class Courses extends Eloquent {

	protected $guarded = array();

	public function teachers(){
		return $this->belongsToMany('Teachers', 'course_teacher', 'course_id', 'teacher_id');
	}

	public function sections(){
		return $this->belongsToMany('Sections', 'course_section', 'course_id', 'section_id');
	}

	public function coursesections(){
		return $this->hasMany('CoursesSection', 'course_id', 'id');
	}

	public function promotioners(){
		return $this->belongsToMany('Companies', 'promotioners', 'course_id', 'company_id');
	}

	public function supporters(){
		return $this->belongsToMany('Companies', 'supporters', 'course_id', 'company_id');
	}
	
	public function helpers(){
		return $this->belongsToMany('Companies', 'helpers', 'course_id', 'company_id');
	}

	public function category(){
		return $this->belongsTo('Categories', 'category_id');
	}

	public function event(){
		return $this->belongsTo('Events', 'event_id');
	}

	public function company(){
		return $this->belongsTo('Companies', 'company_id');
	}

	public function usertypes(){
		return $this->hasMany('UserTypes', 'course_id', 'id');
	}

	public function inscriptions(){
		return $this->hasMany('Inscriptions', 'id_course', 'id');
	}

	public function files(){
		return $this->hasMany('Files', 'id_course', 'id');
	}

/* --------------------------- */

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
