<?php

class ORGAcademics extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'asociados_datos_academicos';

    public $timestamps = false;

	public $primaryKey  = 'id_datos_acad';

	public function training(){

		return $this->belongsTo('ORGTrainings', 'curso_realizado', 'id');

	}

}