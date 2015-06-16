<?php

class FrontendConsultoresController extends \BaseController {

	public static $route = '/consultores';

	//Listado de palabras para obviar en la busqueda
	public $deleted_words = array(
		'el',
		'la',
		'los',
		'de',
		'del',
		'para',
		'que',
		'cual',
		'como'
		);

	public function getIndex(){

		$data = Input::get('area_de_especializacion');

		$consultores = ORGAssociates::where('classificados_view','=','1');

		if($data != null && $data != '-1'):

			$consultores = $consultores->where('area_de_especializacion','=',$data);

		endif;

		$consultores = $consultores->paginate(5);

		$args = array(
			'consultores' => $consultores,
			'data' => $data,
			'route' => self::$route,
			);

		return View::make('frontend.consultores.index')->with($args);

	}

	public function getBusqueda(){

		$quest = Input::get('q');

		$pk = 'id_asociado';

		$results = $this->engine($quest, $pk);

		dd($results);

	}

	public function nombre($quest, $pk){

		$results = ORGAssociates::whereNested(function($query) use($quest){

			$query->where('nombre_completo', 'LIKE', '%'.$quest.'%');
			$query->where('classificados_view', '=', '1');

		})->select(array( $pk ))
		  ->get();

		return $this->modelToArray($results, $pk);

	}

	public function email($quest, $pk){

		$results = ORGAssociates::whereNested(function($query) use($quest){

			$query->where('email', 'LIKE', '%'.$quest.'%');
			$query->where('classificados_view', '=', '1');

		})->select(array( $pk ))
		  ->get();

		return $this->modelToArray($results, $pk);

	}

	public function conteudo($quest, $pk){

		$results = ORGAssociates::whereNested(function($query) use($quest){

			$query->where('classificados_conteudo', 'LIKE', '%'.$quest.'%');
			$query->where('classificados_view', '=', '1');

		})->select(array( $pk ))->get();

		return $this->modelToArray($results, $pk);

	}

	public function engine($quest, $primary_key){

		$name_results = $this->nombre($quest, $primary_key);
		$email_results = $this->email($quest, $primary_key);
		$conteudo_results = $this->conteudo($quest, $primary_key);

		$top_results = $this->arrayMergin($name_results, $email_results);
		$top_results = $this->arrayMergin($top_results, $conteudo_results);

		$pieces = strtolower(trim($quest));

		$pieces = explode(" ",$pieces);	

		$deleted_positions = array();

		//Registrar posiciones de palabras a eliminar
		for ($position = 0; $position < count($pieces); $position++) :
			# code...
			if(in_array($pieces[$position], $this->deleted_words)):
				$deleted_positions[] = $position;
			else:
				$pieces[$position] = ' '.$pieces[$position].' ';
			endif;

		endfor;

		//Eliminacion de palabras en el listado anterior
		foreach ($deleted_positions as $position) :
			# code...
			unset($pieces[$position]);
		endforeach;

		//Contruyendo Expresion regular a partir de las palabras de la busqueda
		$regexp = $this->arrayToText($pieces, '|');

		//Campo al cual se le hara la busqueda
		$field = 'classificados_conteudo';

		//Busqueda de coincidencias en el Modelo por expresion regular
		$results = ORGAssociates::whereNested(function($query) use($field, $regexp){

			$query->whereRaw($field.' REGEXP "('.$regexp.')"');

		})->select(array('id_asociado', 'classificados_conteudo'))
		  ->get();

		//Inicializacion de pesos e ids
		$weights = array();
		$ids = array();

		//Llenando estructura de pesos
		foreach( $results as $result ):
			$coincidences = 0;
			$coincidences += count($this->multiexplode($pieces, $result->$field));
			$weights[] = $coincidences;
			$ids[] = $result->$primary_key;
		endforeach;

		//Ordenando arreglos por peso
		array_multisort($weights, SORT_DESC, $ids );

		$list = $this->arrayMergin($top_results, $ids);

		$ins = $this->arrayToText($list, ',');

		//Busqueda de registros ordenados por pesos
		$results = ORGAssociates::whereNested(function($query) use($pieces, $regexp, $ins, $primary_key){

			$query->whereRaw($primary_key.' in ('.$ins.') ');

		})->select(array('id_asociado','nombre_completo','telefone_res','ddi_res','classificados_conteudo','classificados_imagem'))
		  ->orderByRaw(\DB::raw("FIELD(".$primary_key.", ".$ins.")"))->get();

		foreach( $results as $result ):
			$result->nombre_completo = str_replace($quest, ' <span style="background-color:#FFFF00">'.trim($quest).'</span> ', $result->nombre_completo);
			$result->email = str_replace($quest, ' <span style="background-color:#FFFF00">'.trim($quest).'</span> ', $result->email);
			$result->classificados_conteudo = str_replace($quest, ' <span style="background-color:#FFFF00">'.trim($quest).'</span> ', $result->classificados_conteudo);
			foreach( $pieces as $piece ):
				$result->$field = str_replace($piece, ' <span style="background-color:#FFFF00">'.trim($piece).'</span> ', $result->$field);
			endforeach;
		endforeach;

		//Parametros para la vista
		$args = array(
			'results' => $results,
			'weights' => $weights,
			'list' => $list
			);

		//Construccion de vista con parametros ordenados
		return $args;

	}

	//Funcion para busqueda de coincidencias de un array en un string
	function multiexplode ($delimiters,$string) {
    
	    $ready = str_replace($delimiters, '############', $string);
	    $launch = explode('############', $ready);
	    return  $launch;

	}

	public function arrayToText($array, $separator){

		$text = '';
		$position = 0;

		//Contruyendo expresion regular a partir de los ids ordenados para hacer busqueda ordenada
		foreach ($array as $element) :
			# code...
			if($position++ > 0) $text .= $separator;
			$text .= $element;
		endforeach;

		return $text;

	}

	public function modelToArray($results, $pk){

		$array = array();

		foreach($results as $result):
			$array[] = $result->$pk;
		endforeach;

		return $array;

	}

	public function arrayMergin($array1, $array2){

		for($i = 0 ; $i < count($array2) ; $i++):
			$bool = false;
			for($j = 0 ; $j < count($array1) ; $j++):
				if($array2[$i] == $array1[$j]):
					$bool = true;
				endif;
			endfor;
			if(!$bool):
				$array1[] = $array2[$i];
			endif;
		endfor;

		return $array1;

	}

}