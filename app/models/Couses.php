<?php

class Courses extends Eloquent {

	protected $guarded = array();

	public function teachers(){
		return $this->belongsToMany('Teachers', 'course_teacher', 'course_id', 'teacher_id');
	}

	public function promotioners(){
		return $this->belongsToMany('Companies', 'promotioners', 'course_id', 'company_id');
	}

	public function supporters(){
		return $this->belongsToMany('Companies', 'supporters', 'course_id', 'company_id');
	}

	public function category(){
		return $this->belongsTo('Categories', 'category_id');
	}

	public function company(){
		return $this->belongsTo('Companies', 'company_id');
	}


/* --------------------------- */

	public function _get( $arg = 'all' ){
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
		return self::where( 'status', $operator, $status )->take()->get();
	}

	public function getPublish(){
		return self::_get('publish');
	}

	public function getDraft(){
		return self::_get('draft');
	}

	public function getTrash(){
		return self::_get('trash');
	}

	public function getUntrash(){
		return self::_get('untrash');
	}

	public function getAll(){
		return self::_get('all');
	}

	public function _edit($id, $arg = 'draft'){
		$reg = self::find($id);
		$reg->status = $arg;
		$reg->save();
		return true;
	}

	public function publish($id){
		return self::_edit($id, 'publish');
	}

	public function draft($id){
		return self::_edit($id, 'draft');
	}

	public function trash($id){
		return self::_edit($id, 'trash');
	}

}
