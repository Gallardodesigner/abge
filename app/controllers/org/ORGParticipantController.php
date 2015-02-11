<?php

class ORGParticipantController extends \BaseController {
	
	protected $route = '/dashboard/clients/participants';

	public function getIndex(){

		$participants = ORGParticipants::all();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		$args = array(
			'participants' => $participants,
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			);

		return View::make('backend.clients.participants.index')->with($args);

	}

	public function getExportparticipantes(){
		$participants = ORGParticipants::all();
		$trainings = ORGTrainings::all();
		$states = ORGStates::all();
		
		$towns = ORGTowns::all();

		
		Excel::create('Export Participantes - '. rand(2, 700*date("H"))."-".date("d-m-Y"), function($excel) use ($participants){

		    $excel->sheet('Excel sheet', function($sheet) use ($participants){
				
		        $sheet->setOrientation('portrait');
		    $n=2;

		    // $sheet->appendRow(1,array("Codigo Asociado","Nome","RG","Email", "Telefone", "Celular", "CPF", "Tipo Pessoa","Pagamento", "Fecha", "User Type", "Endereço", "Complemento", "CEP", "Cidade", "Estado", "Empresa", "Endereço Empresa", "Complemento Empresa", "Telefone Empresa", "CNPJ", "Cargo" ));
			// $inscriptions = $inscriptions;
			foreach($participants as $parti):

		    		$cod_aso = "";
		    		$nome = $parti->nome;
		    		// Campos de asociados obligatorio
		    		$incripcion_estadual = "";
		    		$incripcion_municipal = "";
		    		$data_nascimento = "";
		    		$training = "";
		    		$categoria_titulo = "";
	                $logradouro_res ="";
	                $logradouro_com ="";
	                $barrio_res = "";
	                $barrio_com = "";
		    		$pasaporte =  "";
		    		$website =  "";
		    		$responsable =  "";
		    		$publicaciones =  "";
		    		$nombre_cientifico =  "";
		    		//fin de campos asociados obligatorios

		    		//Campos participants no agregados

		    		$cidade_empresa = $parti->cidade_empresa;
		    		$estado_empresa = $parti->estado_empresa;
		    		$cep_empresa =  $parti->cep_empresa;

		    		$state = ORGStates::all();
		    			foreach($state as $sta):
		    				if($parti->estado==$sta->name_estado):
		    					$state=$sta->name_estado;
		    					break;
		    				endif;
		    			endforeach;
		    			
		    		//Fin de campos participants no agregados
		    		$cpf = $parti->cpf;
		    		$rg = $parti->rg;
		    		$razon_social = '';
		    		$celular = $parti->celular ;
		    		$tipo_pessoa = 'F';
		    		$data_nascimento = $parti->data_nascimento;
		    		$email = $parti->email;
		    		$data_cadastro = $parti->data_cadastro;
		    		$empresa = $parti->empresa;
		    		$empresa_dir = $parti->endereco_empresa;
		    		$empresa_com = $parti->complemento_empresa;
		    		$empresa_tel = "";
		    		$cnpj = $parti->cnpj;
		    		$cargo = "";
		    		$dir = $parti->dir_res;
		    		$cep = $parti->cep;
		    		$complemento = $parti->complemento;
		    		$telefone = $parti->telefone;
		    		$estado = $parti->estado;
		    		$cidade = $parti->cidade;
		    $sheet->appendRow(1,array("Codigo Asociado",
		    						  "Nome",
		    						  "RG",
		    						  "Email",
		    						  "Telefone",
		    						  "Celular",
		    						  "CPF",
		    						  "Tipo Pessoa",
		    						  // "Pagamento",
		    						  // "Fecha",
		    						  // "User Type",
		    						  "Inscription estadual",
		    						  "Inscription municipal",
		    						  "Data Nascimento",
		    						  "Training",
		    						  "Category Title",
		    						  "Logradouro Residencia",
		    						  "Endereço",
		    						  "Complemento",
		    						  "Barrio Res",
		    						  "CEP",
		    						  "Cidade",
		    						  "Estado",
		    						  "Empresa",
		    						  "Logradouro Empresa",
		    						  "Endereço Empresa",
		    						  "Cidade Empresa",
		    						  "Estado Empresa",
		    						  "CEP Empresa",
		    						  "Complemento Empresa",
		    						  "Barrio Empresa",
		    						  "Telefone Empresa",
		    						  "CNPJ",
		    						  "Cargo",
		    						  "Pasaporte",
		    						  "Website",
		    						  "Responsavel",
		    						  "Nome Cientifico",
		    						  "Publicacoes" ));

		    	$total= ["codigo"=>$cod_aso,
		    			 "nome" => $nome,
		    			 "rg" => $rg,  
		    			 "email" => $email,
		    			 "telefone" => $telefone,
		    			 "celular" => $celular,
		    			 "cpf" => $cpf,
		    			 "tipo_pessoa" => $tipo_pessoa,
		    			 // "paid" => $paid,
		    			 // "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
		    			 // "type" => $inscription->usertype->title,
		    			 "inscription_est" => $incripcion_estadual,
		    			 "incripcion_municipal" => $incripcion_municipal,
		    			 "data_nascimento" => $data_nascimento,
		    			 "training" => $training,
		    			 "categoria_titulo" => $categoria_titulo,
		    			 "logradouro_res" => $logradouro_res, 
		    			 "dir" => $dir,
		    			 "complemento" => $complemento,
		    			 "barrio_res" => $barrio_res,
		    			 "cep" => $cep,
		    			 "cidade" => $cidade,
		    			 "estado" => $estado,
		    			 "empresa" => $empresa,
		    			 "empresa_dir" => $empresa_dir,
		    			 "logradouro_com" => $logradouro_com,
		    			 "empresa_cidade" => $cidade_empresa,
		    			 "empresa_estado" => $estado_empresa,
		    			 "cep_empresa" => $cep_empresa,
		    			 "empresa_com" => $empresa_com,
		    			 "barrio_com" => $barrio_com,
		    			 "empresa_tel" => $empresa_tel,
		    			 "cnpj" => $cnpj,
		    			 "cargo" => $cargo,
		    			 "pasaporte" => $pasaporte,
		    			 "website" => $website,
		    			 "responsable" => $responsable,
		    			 "nome_cientifico" => $nombre_cientifico,
		    			 "publicaciones" => $publicaciones
		    			 ];
		        	$sheet->appendRow($n,$total);

		    	// break;
		        	$n++;
		    	// array_push($total,$inscription->user->name,$inscription->user->email);
		    endforeach;

		    });

		})->export('xlsx');
		// Excel::create('Export Inscriptions '. $course->title ."-". rand(2, 700*date("H"))."-".date("d-m-Y"), function($excel) use ($total){

		//     $excel->sheet('Excel sheet', function($sheet) use ($total){
				
		//         $sheet->setOrientation('portrait');
		//         	// dd($total);
		//         	$sheet->fromArray($total, null, 'A1', true);

		//     });

		// })->export('xlsx');
	}
	public function getCreate(){

		$args = array(
			'route' => $this->route,
			'estados' => ORGStates::all(),
			);

		return View::make('backend.clients.participants.create')->with($args);

	}

	public function postCreate(){

		$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();
		$estado_empresa = ORGStates::where('id_estado', '=', Input::get('estado_empresa'))->take(1)->get();

		$participant = new ORGParticipants();
		$participant->nome = Input::get('nome');
		$participant->rg = Input::get('rg');
		$participant->cpf = Input::get('cpf');
		$participant->endereco = Input::get('endereco');
		$participant->numero = Input::get('numero');
		$participant->complemento = Input::get('complemento');
		$participant->cep = Input::get('cep');
		$participant->cidade = Input::get('cidade');
		$participant->estado = $estado[0]->name_estado;
		$participant->email = Input::get('email');
		$participant->telefone = Input::get('telefone');
		$participant->celular = Input::get('celular');
		$participant->save();

		if($participant->save()):

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.participants_create', array( 'nome' => $participant->nome )));

		else:

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_create_err', array( 'nome' => $participant->nome )));

		endif;

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$participant = ORGParticipants::find($id);

			if(!$participant):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));

			else:

				$args = array(
					'route' => $this->route,
					'participant' => $participant ,
					'estados' => ORGStates::all(),
					);

				return View::make('backend.clients.participants.update')->with($args);

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$participant = ORGParticipants::find($id);

			if(!$participant):

				return Redirect::to($this->route);

			else:

				$estado = ORGStates::where('id_estado', '=', Input::get('estado'))->take(1)->get();

				$participant->nome = Input::get('nome');
				$participant->rg = Input::get('rg');
				$participant->cpf = Input::get('cpf');
				$participant->endereco = Input::get('endereco');
				$participant->numero = Input::get('numero');
				$participant->complemento = Input::get('complemento');
				$participant->cep = Input::get('cep');
				$participant->cidade = Input::get('cidade');
				$participant->estado = $estado[0]->name_estado;
				$participant->email = Input::get('email');
				$participant->telefone = Input::get('telefone');
				$participant->celular = Input::get('celular');
				$participant->save();

				if($participant->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.participants_update', array( 'title' => $participant->title )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_update_err', array( 'title' => $participant->title )));

				endif;

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));

		else:

			$participant = ORGParticipants::find($id);

			$delete = ORGParticipants::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_delete_err', array( 'title' => $participant->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.participants_delete', array( 'title' => $participant->title )));

			endif;

		endif;

	}

}
