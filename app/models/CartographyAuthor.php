<?php

class CartographyAuthor extends \Eloquent {

	protected $connection = 'mysql';

	protected $table = 'cartography_authors';

	public function cartography(){

		return $this->belongsTo('Cartography', 'cartography_id', 'id');

	}

}