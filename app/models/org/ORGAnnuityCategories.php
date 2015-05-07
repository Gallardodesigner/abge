<?php

class ORGAnnuityCategories extends Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'anuidade_categoria';

	public function payments(){
		return $this->hasMany('ORGAssociateAnnuities', 'id_anuidade_categoria', 'id');
	}

	public function category(){
		return $this->belongsTo('ORGAssociateCategories', 'id_categoria_asociado', 'id_categoria_asociado');
	}

	public function dates(){
		return $this->hasMany('ORGAnnuityDates', 'id_anuidade_categoria', 'id');
	}

	public function annuity(){
		return $this->belongsTo('ORGAnnuities', 'id_anuidade', 'id');
	}

	public function hasPaid( $associate ){

		foreach( $this->payments as $payment ):

			if($payment->id_asociado == $associate->id_asociado AND $payment->status == 1):
				return true;
			endif;

		endforeach;

		return false;

	}

	public function hasPayment( $associate ){

		foreach( $this->payments as $payment ):

			if($payment->id_asociado == $associate->id_asociado):
				return $payment;
			endif;

		endforeach;

		return false;

	}

	public function getActualInterval(){

		$actual = false;

		$today = date_create(date('Y-m-d'));

		// dd($this->dates()->get());

		foreach($this->dates()->get() as $date):
			$datetime1 = date_create($date->data_inicio);
			$datetime3 = date_create($date->data_final);
			$interval1 = date_diff($datetime1, $today);
			$interval2 = date_diff($datetime3, $today);
			if(($interval1->format('%R') == '+') AND ($interval2->format('%R') == '-')):
				$actual = $date;
			endif;	
		endforeach;

		return $actual;

	}

	public function getCustomInterval( $date ){

		$actual = false;

		$today = date_create(date('Y-m-d', strtotime($date)));

		foreach($this->dates()->get() as $date):
			$datetime1 = date_create($date->data_inicio);
			$datetime3 = date_create($date->data_final);
			$interval1 = date_diff($datetime1, $today);
			$interval2 = date_diff($datetime3, $today);
			if(($interval1->format('%R') == '+') AND ($interval2->format('%R') == '-')):
				$actual = $date;
			endif;	
		endforeach;
		
		return $actual;

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
