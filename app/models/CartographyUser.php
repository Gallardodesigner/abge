<?php

class CartographyUser extends \Eloquent {

	protected $connection = 'mysql';

	protected $table = 'cartography_users';

	public function cartographies(){

		return $this->hasMany('Cartography', 'user_id', 'id');

	}

}