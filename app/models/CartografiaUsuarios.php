<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CartografiaUsuarios extends Eloquent implements RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $connection = 'mysql_2';

	protected $table = 'usuario_cartografia';

	public $primaryKey  = 'id_user';

	public $timestamps = false;

	public function cartografias(){

		return $this->hasMany('Cartografias', 'id_user', 'id_user');

	}

	public function getAuthPassword(){

	    return $this->senha;

	}

}