<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public static function money_format($number){

		return 'R$ '.number_format( (float) $number, 2, ',', '.');

	}

	public static function remove_accents($string) {

		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","À","ã","Ã","Ì","Ò","Ù","ç","Ç");

		   $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","a","A","I","O","U","c","C");

		$texto = str_replace($no_permitidas, $permitidas ,$string);

		return $texto;

	}

	public static function remove_spaces($string){

		$no_permitidas= array (" ","!","@","#","$","%","^","&","*","(",")","-","_","=","+","[","]",";",":","/","?",".",">",",","<","\\","'","\"","°");

		$texto = str_replace($no_permitidas, "" ,$string);

		return $texto;

	}

	public static function guide_spaces($string){

		$no_permitidas= array (" ","!","@","#","$","%","^","&","*","(",")","-","_","=","+","[","]",";",":","/","?",".",">",",","<","\\","'","\"","°");

		$texto = str_replace($no_permitidas, "-" ,$string);

		return $texto;

	}

}
