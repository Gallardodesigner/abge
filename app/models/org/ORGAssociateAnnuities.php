<?php

class ORGAssociateAnnuities extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'anuidade_asociado';

	public function associate(){
		return $this->belongsTo('ORGAssociates', 'id_asociado', 'id_asociado');
	}

	public function category(){
		return $this->belongsTo('ORGAnnuityCategories', 'id_anuidade_categoria', 'id');
	}
	
	public static function hasAnnuity( $user ){

		$user = User::find( $user->id );
		$associate = $user->associate->asociado;
		$category = $associate->category;

		$annuity = ORGAnnuities::getLastAnnuity();

		$annuityCategory = $annuity->getAnnuityCategoryByAssociateCategory($category);

		return $annuityCategory->hasPaid( $associate );

	}

/* --------------------------- */

	/*public static function _get( $arg = 'all' ){
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

	public static function getByEmail($email){
		return self::where( 'email', '=', $email )->take(1)->get();
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
	}*/
}
