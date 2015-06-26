<?php

class FrontendConsultoresController extends \BaseController {

	public static $route = '/consultores';

	//Listado de palabras para obviar en la busqueda
	public $deleted_words = array(
		'a',
		'e',
		'ao',
		'da',
		'das',
		'de',
		'do',
		'dos',
		'na',
		'no',
		'em',
		'para',
		'com',
		'pelo',
		 );

	public function getBusqueda(){

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

	public function getIndex(){

		$quest = Input::get('q');

		$area = Input::get('area_de_especializacion');

		$per_page = 5;

		if($quest != null):

			$pk = 'id_asociado';

			$parameters = $this->engine($quest, $pk, $area);

			$pieces = $parameters['pieces'];
			$regexp = $parameters['regexp'];
			$ins = $parameters['ins'];
			$primary_key = $parameters['primary_key'];

			$consultores = ORGAssociates::whereNested(function($query) use($pieces, $regexp, $ins, $primary_key){

				$query->whereRaw($primary_key.' in ('.$ins.') ');

			})->select(array('id_asociado','nombre_completo','email', 'telefone_res','ddi_res','sexo','classificados_conteudo','classificados_imagem'))
			  ->orderByRaw(\DB::raw("FIELD(".$primary_key.", ".$ins.")"))->paginate($per_page);

			// Lighthing top_results
			foreach( $consultores as $result ):
				$result->nombre_completo = str_replace(trim($quest), '<span style="background-color:#FFFF00">'.trim($quest).'</span>', $result->nombre_completo);
				$result->nombre_completo = str_replace(mb_strtoupper(trim($quest), 'UTF-8'), '<span style="background-color:#FFFF00">'.trim(mb_strtoupper($quest, 'UTF-8')).'</span>', $result->nombre_completo);
				$result->nombre_completo = str_replace(mb_strtolower(trim($quest), 'UTF-8'), '<span style="background-color:#FFFF00">'.trim(mb_strtolower($quest, 'UTF-8')).'</span>', $result->nombre_completo);
				$result->nombre_completo= str_replace(mb_convert_case(trim($quest), MB_CASE_TITLE, 'UTF-8'), '<span style="background-color:#FFFF00">'.trim(mb_convert_case($quest, MB_CASE_TITLE, 'UTF-8')).'</span>', $result->nombre_completo);
				$result->light_email = str_replace(trim($quest), '<span style="background-color:#FFFF00">'.trim($quest).'</span>', $result->email);
				$result->classificados_conteudo = str_replace(trim($quest), '<span style="background-color:#FFFF00">'.trim($quest).'</span>', $result->classificados_conteudo);
				$result->classificados_conteudo = str_replace(mb_strtoupper(trim($quest), 'UTF-8'), '<span style="background-color:#FFFF00">'.trim(mb_strtoupper($quest, 'UTF-8')).'</span>', $result->classificados_conteudo);
				$result->classificados_conteudo = str_replace(mb_strtolower(trim($quest), 'UTF-8'), '<span style="background-color:#FFFF00">'.trim(mb_strtolower($quest, 'UTF-8')).'</span>', $result->classificados_conteudo);
				$result->classificados_conteudo= str_replace(mb_convert_case(trim($quest), MB_CASE_TITLE, 'UTF-8'), '<span style="background-color:#FFFF00">'.trim(mb_convert_case($quest, MB_CASE_TITLE, 'UTF-8')).'</span>', $result->classificados_conteudo);
				foreach( $pieces as $piece ):
					$result->classificados_conteudo= str_replace($piece, ' <span style="background-color:#FFFF00">'.trim($piece).'</span> ', $result->classificados_conteudo);
					$result->classificados_conteudo= str_replace(mb_strtoupper($piece,'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_strtoupper($piece,'UTF-8')).'</span> ', $result->classificados_conteudo);
					$result->classificados_conteudo= str_replace(mb_strtolower($piece,'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_strtolower($piece,'UTF-8')).'</span> ', $result->classificados_conteudo);
					$result->classificados_conteudo= str_replace(mb_convert_case($piece, MB_CASE_TITLE, 'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_convert_case($piece, MB_CASE_TITLE, 'UTF-8')).'</span> ', $result->classificados_conteudo);
				endforeach;
			endforeach;

		elseif ($area != '-1' && $area != null):
			# code...

			$consultores = ORGAssociates::where('classificados_view','=','1')->where('area_de_especializacion','=',$area)->paginate($per_page);

		else:

			$consultores = ORGAssociates::where('classificados_view','=','1')->paginate($per_page);

		endif;

		$args = array(
			'q' => $quest,
			'consultores' => $consultores,
			'data' => $area,
			'route' => self::$route,
			);

		return View::make('frontend.consultores.engine')->with($args);

	}

	public function nombre($quest, $pk, $area){

		$results = ORGAssociates::whereNested(function($query) use($quest, $area){

			$query->where('nombre_completo', 'LIKE', '%'.$quest.'%');
			$query->where('classificados_view', '=', '1');

			if($area != null && $area != '-1') $query->where('area_de_especializacion', '=', $area);

		})->select(array( $pk ))
		  ->get();

		return $this->modelToArray($results, $pk);

	}

	public function email($quest, $pk, $area){

		$results = ORGAssociates::whereNested(function($query) use($quest, $area){

			$query->where('email', 'LIKE', '%'.$quest.'%');
			$query->where('classificados_view', '=', '1');

			if($area != null && $area != '-1') $query->where('area_de_especializacion', '=', $area);

		})->select(array( $pk ))
		  ->get();

		return $this->modelToArray($results, $pk);

	}

	public function conteudo($quest, $pk, $area){

		$results = ORGAssociates::whereNested(function($query) use($quest, $area){

			$query->where('classificados_conteudo', 'LIKE', '%'.$quest.'%');
			$query->where('classificados_view', '=', '1');

			if($area != null && $area != '-1') $query->where('area_de_especializacion', '=', $area);

		})->select(array( $pk ))->get();

		return $this->modelToArray($results, $pk);

	}

	public function engine($quest, $primary_key, $area){

		$name_results = $this->nombre($quest, $primary_key, $area);
		$email_results = $this->email($quest, $primary_key, $area);
		$conteudo_results = $this->conteudo($quest, $primary_key, $area);

		$top_results = $this->arrayMergin($name_results, $email_results);
		$top_results = $this->arrayMergin($top_results, $conteudo_results);

		$pieces = strtolower(trim($quest));

		$pieces = $this->explodePieces($pieces);

		//Contruyendo Expresion regular a partir de las palabras de la busqueda
		$regexp = $this->arrayToText($pieces, '|');

		//Campo al cual se le hara la busqueda
		$field = 'classificados_conteudo';

		//Busqueda de coincidencias en el Modelo por expresion regular
		$results = ORGAssociates::whereNested(function($query) use($field, $regexp, $area){

			$query->whereRaw($field.' REGEXP "('.$regexp.')"');
			$query->where('classificados_view', '=', '1');

			if($area != null && $area != '-1') $query->where('area_de_especializacion', '=', $area);

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

		if($ins == '') $ins = '0';

		return array(
			'pieces' => $pieces,
			'regexp' => $regexp,
			'ins' => $ins,
			'primary_key' => $primary_key
			);

		//Busqueda de registros ordenados por pesos
		/*$results = ORGAssociates::whereNested(function($query) use($pieces, $regexp, $ins, $primary_key){

			$query->whereRaw($primary_key.' in ('.$ins.') ');

		})->select(array('id_asociado','nombre_completo','email', 'telefone_res','ddi_res','sexo','classificados_conteudo','classificados_imagem'))
		  ->orderByRaw(\DB::raw("FIELD(".$primary_key.", ".$ins.")"))->paginate(2);

		foreach( $results as $result ):
			$result->nombre_completo = str_replace($quest, ' <span style="background-color:#FFFF00">'.trim($quest).'</span> ', $result->nombre_completo);
			$result->email = str_replace($quest, ' <span style="background-color:#FFFF00">'.trim($quest).'</span> ', $result->email);
			$result->classificados_conteudo = str_replace($quest, ' <span style="background-color:#FFFF00">'.trim($quest).'</span> ', $result->classificados_conteudo);
			$result->classificados_conteudo = str_replace(mb_strtoupper($quest, 'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_strtoupper($quest, 'UTF-8')).'</span> ', $result->classificados_conteudo);
			$result->classificados_conteudo = str_replace(mb_strtolower($quest, 'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_strtolower($quest, 'UTF-8')).'</span> ', $result->classificados_conteudo);
			$result->classificados_conteudo= str_replace(mb_convert_case($quest, MB_CASE_TITLE, 'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_convert_case($quest, MB_CASE_TITLE, 'UTF-8')).'</span> ', $result->classificados_conteudo);
			foreach( $pieces as $piece ):
				$result->classificados_conteudo= str_replace($piece, ' <span style="background-color:#FFFF00">'.trim($piece).'</span> ', $result->classificados_conteudo);
				$result->classificados_conteudo= str_replace(mb_strtoupper($piece,'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_strtoupper($piece,'UTF-8')).'</span> ', $result->classificados_conteudo);
				$result->classificados_conteudo= str_replace(mb_strtolower($piece,'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_strtolower($piece,'UTF-8')).'</span> ', $result->classificados_conteudo);
				$result->classificados_conteudo= str_replace(mb_convert_case($piece, MB_CASE_TITLE, 'UTF-8'), ' <span style="background-color:#FFFF00">'.trim(mb_convert_case($piece, MB_CASE_TITLE, 'UTF-8')).'</span> ', $result->classificados_conteudo);
				//var_dump($result->classificados_conteudo);
				//var_dump('<br>');
				//var_dump($piece);
				//var_dump('<br>');
				//var_dump(strtoupper($piece));
				//var_dump('<br>');
				//var_dump(mb_strtoupper($piece,'UTF-8'));
				//var_dump('<br>');
				//var_dump(utf8_encode($piece));
				//var_dump('<br>');
				//var_dump(utf8_decode($piece));
				//var_dump('<br>');
				//var_dump('<br>');
			endforeach;
		endforeach;

		//Parametros para la vista
		$args = array(
			'results' => $results,
			'weights' => $weights,
			'list' => $list
			);

		//Construccion de vista con parametros ordenados
		return $results;*/

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

	public function explodePieces( $pieces ){

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

		return $pieces;

	}

}