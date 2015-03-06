<?php

class ORGAssociates extends Eloquent {

	public function courses(){
		return $this->hasMany('Courses', 'category_id', 'id');
	}

	public function associate(){
		return $this->hasOne('Associates', 'associate', 'id_asociado');
	}

	public function category(){
		return $this->hasOne('ORGAssociateCategories', 'id_categoria_asociado', 'categoria');
	}

	public function academics(){
		return $this->hasMany('ORGAcademics', 'id_asociado', 'id_asociado');
	}

	public function anuidade(){
		return $this->hasMany('ORGAssociatesAnuidade', 'id_asociado', 'id_asociado');
	}

	public function payments(){
		return $this->hasMany('ORGAssociateAnnuities', 'id_asociado', 'id_asociado');
	}

	public function hasPaymentByAnnuity( $annuity ){
		foreach( $this->payments as $payment ):
			if($payment->category->annuity->id == $annuity->id) return true;
		endforeach;
		return false;
	}

	public function getPaymentByAnnuity( $annuity ){
		foreach( $this->payments as $payment ):
			if($payment->category->annuity->id == $annuity->id) return $payment;
		endforeach;
		return false;
	}

	protected $connection = 'mysql_2';

	public $primaryKey  = 'id_asociado';

	protected $table = 'asociados';

    public $timestamps = false;

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
	}
}
