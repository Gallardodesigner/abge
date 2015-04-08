<?php

class InscriptionController extends \BaseController {

	public static $parent = '/dashboard/courses/';

	public static $route = '/dashboard/courses/{idCourse}/inscriptions';

	public function getIndex( $idCourse ){

		$course = Courses::find($idCourse);

		$inscriptions = $course->inscriptions;


		$array = array(
			'course' => $course,
			'inscriptions' => $inscriptions,
			'route' => self::parseRoute($course->id),
			'parent' => self::$parent,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			);

		return View::make('backend.inscriptions.index')->with( $array );

	}

	public function getPaid( $idCourse, $id = '' ){

		if( $id != '' ):

			$inscription = Inscriptions::find( $id );

			$inscription->paid = true;

			$inscription->save();

			return Redirect::to(self::parseRoute($idCourse))->with( 'msg_success', Lang::get('messages.payment_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse) );

		endif;
	}

	public function getNotpaid( $idCourse, $id = '' ){

		if( $id != '' ):

			$inscription = Inscriptions::find( $id );

			$inscription->paid = false;

			$inscription->save();

			return Redirect::to(self::parseRoute($idCourse))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse) );

		endif;
	}

	public function getExcelcourse( $idCourse, $id = '' ){

		if( $id != '' ):

			$inscription = Inscriptions::find( $id );

			Excel::create('Inscriptions_'.$inscription->course->title, function($excel) use ($inscription) {

			    $excel->sheet('Participants', function($sheet) {

			        $sheet->fromArray(array(
			            array('data1', 'data2'),
			            array('data3', 'data4')
			        ));

			    });

			})->export('xls');

			return Redirect::to(self::parseRoute($idCourse))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse) );

		endif;
	}

	public function getDescription( $idCourse, $idUser){

		$user = User::find($idUser);

		$args = array(
			'route' => self::parseRoute($idCourse),
			'user' => $user,
			'trainings' => ORGTrainings::all(),
			'estados' => ORGStates::all(),
			'backyards' => ORGBackyards::all(),
			'towns' => ORGTowns::all(),
			'categories' => ORGAssociateCategories::all(),
			);

		if( $user->type == 'associate'){
			return View::make('backend.inscriptions.associate')->with($args);
			}
		else{
			return View::make('backend.inscriptions.participant')->with($args);
		}

	}

	public function getDelete( $idCourse, $id ){

		$inscription = Inscriptions::find( $id );

		if( $inscription ):

			foreach( $inscription->files as $file ):

				if( file_exists(str_replace( '//', '/', public_path($file->url) ) ) ):

					unlink(public_path($file->url));

					Files::destroy($file->id);
					
				else:

					Files::destroy($file->id);

				endif;

			endforeach;

			Inscriptions::destroy( $inscription->id );

		endif;

		return Redirect::to(self::parseRoute($idCourse));

	}

	public function getAddparticipant($idCourse){

		$course = Courses::find($idCourse);
			
		$args = array(
			'route' => self::parseRoute($idCourse),
			'course' => $course,
			'usertypes' => $course->usertypes,
			'participants' => ORGParticipants::all()
			);

		return View::make('backend.inscriptions.addparticipant')->with($args);

	}

	public function postAddparticipant($idCourse){

		$course = Courses::find($idCourse);

		$usertype = UserTypes::find(Input::get('usertype'));

		$participant = ORGParticipants::find(Input::get('participante'));

		if($participant->participant == null):

			$user = new User();
			$user->name = $participant->nome;
			$user->email = $participant->email;
			$user->type = 'participant';
			$user->save();

			$new_participant = new Participants();
			$new_participant->participant = $participant->id_participante;
			$new_participant->user = $user->id;
			$new_participant->name = $participant->nome;
			$new_participant->email = $participant->email;
			$new_participant->cpf = $participant->cpf;
			$new_participant->type = 'participant';
			$new_participant->status = 'publish';
			$new_participant->save();

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $user->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		else:

			$this_participant = $participant->participant;

			if($this_participant->user == null):

				$user = new User();
				$user->name = $participant->nome;
				$user->email = $participant->email;
				$user->type = 'participant';
				$user->save();

				$this_participant->user = $user->id;
				$this_participant->save();

			endif;

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $this_participant->user;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		endif;

		return Redirect::to(self::parseRoute($idCourse));

	}

	public function getAddassociate($idCourse){

		$course = Courses::find($idCourse);

		$args = array(
			'route' => self::parseRoute($idCourse),
			'course' => $course,
			'usertypes' => $course->usertypes,
			'associates' => ORGAssociates::all()
			);

		return View::make('backend.inscriptions.addassociate')->with($args);

	}

	public function postAddassociate($idCourse){

		// dd(Input::get('usertype'));

		$course = Courses::find($idCourse);

		$usertype = UserTypes::find(Input::get('usertype'));

		$associate = ORGAssociates::find(Input::get('associado'));

		// dd($usertype);

		if($associate->associate == null):

			$user = new User();
			$user->name = $associate->nombre_completo;
			$user->email = $associate->email;
			$user->type = 'associate';
			$user->save();

			$new_associate = new Associates();
			$new_associate->associate = $associate->id_asociado;
			$new_associate->user = $user->id;
			$new_associate->name = $associate->nombre_completo;
			$new_associate->email = $associate->email;
			$new_associate->password = $associate->senha;
			$new_associate->cpf = $associate->cpf;
			$new_associate->type = 'associate';
			$new_associate->save();

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $user->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		else:

			$this_associate = $associate->associate;

			if($this_associate->user == null):

				$user = new User();
				$user->name = $associate->nombre_completo;
				$user->email = $associate->email;
				$user->type = 'associate';
				$user->save();

				$this_associate->user = $user->id;
				$this_associate->save();

			endif;

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $this_associate->user;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		endif;

		return Redirect::to(self::parseRoute($idCourse));

	}

	public static function parseRoute( $idCourse ){

		return str_replace('{idCourse}', $idCourse, self::$route );

	}

	public function getExportinscriptions($idCourse){
		$course = Courses::find($idCourse);

		$inscriptions = $course->inscriptions;
		$users = array();


		$trainings = ORGTrainings::all();
		$states = ORGStates::all();
		
		$towns = ORGTowns::all();
		$h=0;
		foreach ($inscriptions as $ins) {
			# code...
			// var_dump($ins->id);
			if ($ins->user->type =="associate" || $ins->user->id==127):
				// var_dump($ins->user->id);
				// var_dump($ins->user->type);
				$tempuser=Associates::where('user', '=', $ins->user->id)->take(1)->get();
				$users[$ins->id]=$tempuser[0]->asociado;
			elseif($ins->user->type =="participant" && $ins->user->id!=127):
				$tempuser=Participants::where('user', '=', $ins->user->id)->take(1)->get();
				// if($h==8){
				// 	dd($ins->id);
				// }else{
				// 	var_dump($tempuser[0]->participante->nome);
					$users[$ins->id]=$tempuser[0]->participante;
				// }
				/*if(isset($tempuser[0])):
					$users[$ins->id]=$tempuser[0]->participante;
				else:
					var_dump($ins->user->type);
					dd($ins->user->id);
				endif;*/
			endif;
			$h++;
		}
		    // foreach($inscriptions as $inscription):
		    // 	// $total["name"] = $inscription->user->name;
		    // 	// $total["email"] = $inscription->user->email;
		    // 	// $total["paid"] = $inscription->paid;
		    // 	// $total["date"] = date_format(date_create($inscription->created_at), 'd-m-Y');
		    // 	// $total["type"] = $inscription->usertype->title;
		    // 	$total= ["nome" => $inscription->user->name,
		    // 			 "email" => $inscription->user->email,
		    // 			 "paid" => $inscription->paid,
		    // 			 "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
		    // 			 "type" => $inscription->usertype->title
		    // 			 ];
		    // 	// break;
		    // 	// array_push($total,$inscription->user->name,$inscription->user->email);
		    // endforeach;
		        // dd($inscriptions);

		Excel::create('Export Inscriptions '. $course->title ."-". rand(2, 700*date("H"))."-".date("d-m-Y"), function($excel) use ($inscriptions, $users){

		    $excel->sheet('Excel sheet', function($sheet) use ($inscriptions, $users){
				
		        $sheet->setOrientation('portrait');
		    $n=2;

		    // $sheet->appendRow(1,array("Codigo Asociado","Nome","RG","Email", "Telefone", "Celular", "CPF", "Tipo Pessoa","Pagamento", "Fecha", "User Type", "Endereço", "Complemento", "CEP", "Cidade", "Estado", "Empresa", "Endereço Empresa", "Complemento Empresa", "Telefone Empresa", "CNPJ", "Cargo" ));
			// $inscriptions = $inscriptions;
			foreach($inscriptions as $inscription):
		    	// $total["name"] = $inscription->user->name;
		    	// $total["email"] = $inscription->user->email;
		    	// $total["paid"] = $inscription->paid;
		    	// $total["date"] = date_format(date_create($inscription->created_at), 'd-m-Y');
		    	// $total["type"] = $inscription->usertype->title;
		    	if($inscription->paid == 0):
		    		$paid="Não";
		    	else:
		    		$paid="Sim";
		    	endif;

		    	if($inscription->user->type == 'associate' || $inscription->user->id == 127):
		    		// if(isset($users[$inscription->id]->codigo_asoc)){
		    		// 	var_dump($users[$inscription->id]->nombre_completo);
		    		// }else{
		    		// 	dd($inscription->user->id);
		    		// }
		    		$cod_aso = $users[$inscription->id]->id_asociado;
		    		$nome = $users[$inscription->id]->nombre_completo;
		    		$rg = $users[$inscription->id]->rg;
		    		//No agregados
		    		$incripcion_estadual = $users[$inscription->id]->inscripcion_estadual;
		    		$incripcion_municipal = $users[$inscription->id]->inscripcion_municipal;
		    		$data_nascimento = $users[$inscription->id]->data_nascimento;
		    		$training = ORGTrainings::find($users[$inscription->id]->formacao);
		    			if($training):
		    				$training = $training->nome;
		    			else:
		    				$training = "";
		    			endif;
		    		$categoria_titulo = ORGAssociateCategories::all();
			    		foreach($categoria_titulo as $cat):
	                        if($users[$inscription->id]->categoria == $cat->id_categoria_asociado):
	                            $categoria_titulo = $cat->nombre_categoria;
	                            break;
	                        endif;
	                    endforeach;
	                $logradouro_res ="";
	                $backyards = ORGBackyards::all();
			    		foreach($backyards as $backyard):
	                        if($users[$inscription->id]->logradouro_res == $backyard->id_logradouro):
	                            $logradouro_res=$backyard->nombre;
	                        break;
	                        endif;
	                    endforeach;
	                $logradouro_com ="";
			    		foreach($backyards as $backyard):
	                        if($users[$inscription->id]->logradouro_com == $backyard->id_logradouro):
	                            $logradouro_res=$backyard->nombre;
	                        break;
	                        endif;
	                    endforeach;

	                $barrio_res = $users[$inscription->id]->bairro_res;
	                $barrio_com = $users[$inscription->id]->bairro_com;
		    		$pasaporte =  $users[$inscription->id]->passaporte;
		    		$website =  $users[$inscription->id]->web_site;
		    		$responsable =  $users[$inscription->id]->responsavel;
		    		$publicaciones =  $users[$inscription->id]->publicacoes;
		    		$nombre_cientifico =  $users[$inscription->id]->nome_cientifico;
		    		//Fin de no agregados
		    		//Campos participants no agregados

		    		$cidade_empresa = "";
		    		$estado_empresa = "";
		    		$cep_empresa =  $users[$inscription->id]->cep_com;
		    		$state = "";
		    			
		    		//Fin de campos participants no agregados
		    		$cpf = $users[$inscription->id]->cpf;
		    		$razon_social = $users[$inscription->id]->razon_social;
		    		$celular = $users[$inscription->id]->celular_res;
		    		$tipo_pessoa = $users[$inscription->id]->tipo_pessoa;
		    		$data_nascimento = $users[$inscription->id]->data_nascimento;
		    		$email = $users[$inscription->id]->email;
		    		$data_cadastro = $users[$inscription->id]->data_cadastro;
		    		$empresa = $users[$inscription->id]->empresa;
		    		$empresa_dir = $users[$inscription->id]->dir_com;
		    		$empresa_com = $users[$inscription->id]->complemento_com;
		    		$empresa_tel = $users[$inscription->id]->ddd_com . ' ' . $users[$inscription->id]->ddi_com . ' ' . $users[$inscription->id]->telefone_com;
		    		$cnpj = $users[$inscription->id]->cnpj;
		    		$cargo = $users[$inscription->id]->cargo;
		    		$dir = $users[$inscription->id]->dir_res;
		    		$cep = $users[$inscription->id]->cep_res;
		    		$complemento = $users[$inscription->id]->complemento_res;
		    		$telefone = $users[$inscription->id]->ddd_res . ' ' . $users[$inscription->id]->ddi_res . ' ' . $users[$inscription->id]->telefone_res;
 		    		$uf_empresa="";
                    $uf_residencia ="";
                    $ufs = ORGuf::all();
		    		foreach($ufs as $uf):
                        if($users[$inscription->id]->uf_res == $uf->id_uf):
                            $uf_residencia=$uf->name_uf;
                        break;
                        endif;
                    endforeach;
                    foreach($ufs as $uf):
                        if($users[$inscription->id]->uf_com == $uf->id_uf):
                            $uf_empresa=$uf->name_uf;
                        break;
                        endif;
                    endforeach;
 		    		$estado = $uf_residencia;
 		    		$estado_empresa=$uf_empresa;
		    		$cidade = '';
		    	elseif($inscription->user->type == 'participant'):
		    		$cod_aso = "";
		    		$nome = $users[$inscription->id]->nome;
		    		// Campos de asociados obligatorio
		    		$incripcion_estadual = "";
		    		$incripcion_municipal = "";
		    		$data_nascimento = "";
		    		$training = "";
		    		$categoria_titulo = "";
	                $logradouro_res =$users[$inscription->id]->endereco;
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

		    		$cidade_empresa = $users[$inscription->id]->cidade_empresa;
		    		$estado_empresa = $users[$inscription->id]->estado_empresa;
		    		$cep_empresa =  $users[$inscription->id]->cep_empresa;

		    		$state = ORGStates::all();
		    			foreach($state as $sta):
		    				if($users[$inscription->id]->estado==$sta->name_estado):
		    					$state=$users[$inscription->id]->estado;
		    					break;
		    				elseif($users[$inscription->id]->estado==$sta->id_estado):
		    					$state=$sta->name_estado;
		    					break;
		    				else:
		    					$state=$users[$inscription->id]->estado;
		    					break;
		    				endif;
		    			endforeach;
		    			
		    		//Fin de campos participants no agregados
		    		$cpf = $users[$inscription->id]->cpf;
		    		$rg = $users[$inscription->id]->rg;
		    		$razon_social = '';
		    		$celular = $users[$inscription->id]->celular ;
		    		$tipo_pessoa = 'F';
		    		$data_nascimento = $users[$inscription->id]->data_nascimento;
		    		$email = $users[$inscription->id]->email;
		    		$data_cadastro = $users[$inscription->id]->data_cadastro;
		    		$empresa = $users[$inscription->id]->empresa;
		    		$empresa_dir = $users[$inscription->id]->endereco_empresa;
		    		$empresa_com = $users[$inscription->id]->complemento_empresa;
		    		$empresa_tel = "";
		    		$cnpj = $users[$inscription->id]->cnpj;
		    		$cargo = "";
		    		$dir = $users[$inscription->id]->endereco;
		    		$cep = $users[$inscription->id]->cep;
		    		$complemento = $users[$inscription->id]->complemento;
		    		$telefone = $users[$inscription->id]->telefone;
		    		$estado = $state;
		    		$cidade = $users[$inscription->id]->cidade;
		    	endif;
		    $sheet->appendRow(1,array("Codigo Asociado",
		    						  "Nome",
		    						  "RG",
		    						  "Email",
		    						  "Telefone",
		    						  "Celular",
		    						  "CPF",
		    						  "Tipo Pessoa",
		    						  "Pagamento",
		    						  "Fecha",
		    						  "User Type",
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
		    			 "paid" => $paid,
		    			 "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
		    			 "type" => $inscription->usertype->title,
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
		    			 "logradouro_com" => $logradouro_com,
		    			 "empresa_dir" => $empresa_dir,
		    			 // "cidade_empresa" => $empresa_dir,
		    			 "estado_empresa" => $estado_empresa,
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

}