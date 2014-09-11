<?php

class Promotioners extends Eloquent {

	public function courses(){
		return $this->belongsToMany('Courses', 'promotioners', 'company_id', 'course_id');
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
