<?php

class AjaxController extends \BaseController {

	public function getAdicionarescolaridade($id_asociado){

		$array = array(
			'id_asociado' => $id_asociado,
			'formacoes' => ORGTrainings::all(),
			);

		return View::make('ajax.adicionarescolaridade')->with($array);

	}

	public function postAdicionarescolaridade($id_asociado){

		$academic = new ORGAcademics();
		$academic->tipo_graduacion = Input::get('tipo_graduacion');
		$academic->institucion = Input::get('institucion');
		$academic->facultad = Input::get('facultad');
		$academic->curso_realizado = Input::get('curso_realizado');
		$academic->ano_inicio = Input::get('ano_inicio');
		$academic->ano_finalizacion = Input::get('ano_finalizacion');
		$academic->id_asociado = $id_asociado;
		
		if($academic->save()):
			$curso_realizado = ORGTrainings::find($academic->curso_realizado);
			$tipo_graduacion = '';
			switch($academic->tipo_graduacion){
				case 0:
					$tipo_graduacion = 'DOUTORADO';
					break;
				case 1:
					$tipo_graduacion = 'ESPECIALIZAÇÃO';
					break;
				case 2:
					$tipo_graduacion = 'GRADUAÇÃO';
					break;
				case 3: 
					$tipo_graduacion = 'MESTRADO';
					break;
				case 4:
					$tipo_graduacion = 'PÓS-GRADUAÇÃO';
					break;
			}
			$json = array(
				'id_datos_acad' => $academic->id_datos_acad,
				'tipo_graduacion' => $tipo_graduacion,
				'institucion' => $academic->institucion,
				'facultad' => $academic->facultad,
				'curso_realizado' => $curso_realizado->nome,
				'ano_inicio' => $academic->ano_inicio,
				'ano_finalizacion' => $academic->ano_finalizacion
				);
			return Response::json($json);
		else:
			return false;
		endif;

	}

	public function getAtualizarescolaridade($id_escolaridade){

		$array = array(
			'academic' => ORGAcademics::find($id_escolaridade),
			'formacoes' => ORGTrainings::all(),
			);

		return View::make('ajax.atualizarescolaridade')->with($array);

	}

	public function postAtualizarescolaridade($id_escolaridade){

		$academic = ORGAcademics::find($id_escolaridade);
		$academic->tipo_graduacion = Input::get('tipo_graduacion');
		$academic->institucion = Input::get('institucion');
		$academic->facultad = Input::get('facultad');
		$academic->curso_realizado = Input::get('curso_realizado');
		$academic->ano_inicio = Input::get('ano_inicio');
		$academic->ano_finalizacion = Input::get('ano_finalizacion');
		
		if($academic->save()):
			$curso_realizado = ORGTrainings::find($academic->curso_realizado);
			$tipo_graduacion = '';
			switch($academic->tipo_graduacion){
				case 0:
					$tipo_graduacion = 'DOUTORADO';
					break;
				case 1:
					$tipo_graduacion = 'ESPECIALIZAÇÃO';
					break;
				case 2:
					$tipo_graduacion = 'GRADUAÇÃO';
					break;
				case 3: 
					$tipo_graduacion = 'MESTRADO';
					break;
				case 4:
					$tipo_graduacion = 'PÓS-GRADUAÇÃO';
					break;
			}
			$json = array(
				'id_datos_acad' => $academic->id_datos_acad,
				'tipo_graduacion' => $tipo_graduacion,
				'institucion' => $academic->institucion,
				'facultad' => $academic->facultad,
				'curso_realizado' => $curso_realizado->nome,
				'ano_inicio' => $academic->ano_inicio,
				'ano_finalizacion' => $academic->ano_finalizacion
				);
			return Response::json($json);
		else:
			return false;
		endif;

	}

	public function getDeletarescolaridade($id_escolaridade){

		$array = array(
			'academic' => ORGAcademics::find($id_escolaridade)
			);

		return View::make('ajax.deletarescolaridade')->with($array);

	}

	public function postDeletarescolaridade($id_escolaridade){

		$academic = ORGAcademics::find($id_escolaridade);
		
		if($academic->delete()):
			$array = array(
				'id_datos_acad' => $academic->id_datos_acad
				);
			return Response::json($array);
		else:
			return Response::json(false);
		endif;

	}

}