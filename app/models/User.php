<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

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
