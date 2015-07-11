<?php

class ORGAssociateController extends \BaseController {
	
	protected $route = '/dashboard/clients/associates';

	public function getIndex(){

		if(!empty(Input::all())):

			$associates = new ORGAssociates();

			if(Input::get('nombre_completo') != '' AND Input::get('nombre_completo') != '0'):
				$associates = $associates->where('nombre_completo','LIKE', '%'.Input::get('nombre_completo').'%')->orWhere('id_asociado','=', Input::get('nombre_completo'));
			endif;

			$categoria = Input::get('categoria');

			if(Input::get('categoria') != '0'):
				$associates = $associates->where('categoria', '=',Input::get('categoria'));
			endif;

			if(Input::get('tipo_pessoa') != '0'):
				$categories = ORGAssociateCategories::where('tipo_usuario','=',Input::get('tipo_pessoa'))->get();
				foreach($categories as $category):
					$associates = $associates->orWhere('categoria','=',$category->id_categoria_asociado);
				endforeach;
			endif;

			if(Input::get('pagamento') != '0'):
				$annuity = ORGAnnuities::getLastAnnuity();
				$temps = $associates->get();
				switch(Input::get('pagamento')){
					case 'paid':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity )):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'paid_active':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity ) AND $payment->status):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'paid_inactive':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity ) AND !$payment->status):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'notpaid':
						foreach($temps as $temp):
							if(!$temp->getPaymentByAnnuity( $annuity )):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
				}
			endif;

			$associates = $associates->paginate(30);

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.clients.associates.index', array(
				'filter' => array('nombre_completo' => Input::get('nombre_completo'), 'categoria' => Input::get('categoria'), 'tipo_pessoa' => Input::get('tipo_pessoa'), 'pagamento' => Input::get('pagamento')),
				'associates' => $associates,
				'categories' => ORGAssociateCategories::all(),
				'annuity' => ORGAnnuities::getLastAnnuity(),
				'route' => $this->route,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));

		else:

			$associates = ORGAssociates::paginate(30);

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.clients.associates.index', array(
				'filter' => array('nombre_completo' => '0', 'categoria' => '0', 'tipo_pessoa' => '0', 'pagamento' => '0'),
				'associates' => $associates,
				'categories' => ORGAssociateCategories::all(),
				'annuity' => ORGAnnuities::getLastAnnuity(),
				'route' => $this->route,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));

		endif;


	}

	public function postIndex(){

		// dd(Input::get('nombre_completo'));

		$associates = new ORGAssociates();

		if(Input::get('nombre_completo') != ''):
			$associates = $associates->where('nombre_completo','LIKE', '%'.Input::get('nombre_completo').'%');
		endif;

		$categoria = Input::get('categoria');

		if(Input::get('categoria') != '0'):
			$associates = $associates->where('categoria', '=',Input::get('categoria'));
		endif;

		if(Input::get('tipo_pessoa') != '0'):
			$categories = ORGAssociateCategories::where('tipo_usuario','=',Input::get('tipo_pessoa'))->get();
			foreach($categories as $category):
				$associates = $associates->orWhere('categoria','=',$category->id_categoria_asociado);
			endforeach;
		endif;

		if(Input::get('pagamento') != '0'):
			$annuity = ORGAnnuities::getLastAnnuity();
			$temps = $associates->get();
			$associates = new ORGAssociates();
			switch(Input::get('pagamento')){
				case 'paid':
					foreach($temps as $temp):
						if($payment = $temp->getPaymentByAnnuity( $annuity )):
							$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
						endif;
					endforeach;
					break;
				case 'paid_active':
					foreach($temps as $temp):
						if($payment = $temp->getPaymentByAnnuity( $annuity ) AND $payment->status):
							$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
						endif;
					endforeach;
					break;
				case 'paid_inactive':
					foreach($temps as $temp):
						if($payment = $temp->getPaymentByAnnuity( $annuity ) AND !$payment->status):
							$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
						endif;
					endforeach;
					break;
				case 'notpaid':
					foreach($temps as $temp):
						if(!$temp->getPaymentByAnnuity( $annuity )):
							$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
						endif;
					endforeach;
					break;
			}
		endif;

		$associates = $associates->paginate(30);

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.clients.associates.index', array(
			'filter' => array('nombre_completo' => Input::get('nombre_completo'), 'categoria' => Input::get('categoria'), 'tipo_pessoa' => Input::get('tipo_pessoa'), 'pagamento' => Input::get('pagamento')),
			'associates' => $associates,
			'categories' => ORGAssociateCategories::all(),
			'annuity' => ORGAnnuities::getLastAnnuity(),
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));
	}

	public function postProcesstickets(){

		$boleto = new Ticket();
				
		foreach (Input::get('chk') as $gr => $val):
	    	$boleto->buildHtml();
	    	$boleto->setAsociado($val);
	    	$boleto->inicialize();
	    	$boleto->printTcPdf();
	    	$corpo = $boleto->buildHtmlBoleto();
	    	$boleto->buildHtml($corpo);
	    	$boleto->addPagePdf();
	    	$boleto->creaPaginaBoleto();
	    	$boleto->endPagePdf();
	    	$boleto->inicializaHtml();
	    endforeach;
      	
      	$boleto->downloadPdf('associados');

	}

	public function getExportasociados($nome = '', $categoria = '', $tipo_pessoa = '', $pagamento = ''){

		/*if( $nome == '0' AND $categoria == '0' AND $tipo_pessoa == '0'):

			$associates = ORGAssociates::all();

		else:

			$associates = new ORGAssociates();

			if($nome != '' AND $nome != '0'):
				$associates = $associates->where('nombre_completo','LIKE', '%'.$nome.'%')->orWhere('id_asociado','=', Input::get('nombre_completo'));
			endif;

			if($categoria != '0'):
				$associates = $associates->where('categoria', '=',$categoria);
			endif;

			if($tipo_pessoa != '0'):
				$categories = ORGAssociateCategories::where('tipo_usuario','=',$tipo_pessoa)->get();
				foreach($categories as $category):
					$associates = $associates->orWhere('categoria','=',$category->id_categoria_asociado);
				endforeach;
			endif;

			if($pagamento != '0'):
				$annuity = ORGAnnuities::getLastAnnuity();
				$temps = $associates->get();
				switch($pagamento){
					case 'paid':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity )):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'paid_active':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity ) AND $payment->status):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'paid_inactive':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity ) AND !$payment->status):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'notpaid':
						foreach($temps as $temp):
							if(!$temp->getPaymentByAnnuity( $annuity )):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
				}
			endif;

			$associates = $associates->get();

		endif;*/


			$associates = new ORGAssociates();

			if($nome != '' AND $nome != '0'):
				$associates = $associates->where('nombre_completo','LIKE', '%'.$nome.'%')->orWhere('id_asociado','=', $nome);
			endif;

			if($categoria != '0'):
				$associates = $associates->where('categoria', '=',$categoria);
			endif;

			if($tipo_pessoa != '0'):
				$categories = ORGAssociateCategories::where('tipo_usuario','=',$tipo_pessoa)->get();
				foreach($categories as $category):
					$associates = $associates->orWhere('categoria','=',$category->id_categoria_asociado);
				endforeach;
			endif;

			if($pagamento != '0'):
				$annuity = ORGAnnuities::getLastAnnuity();
				$temps = $associates->get();
				switch($pagamento){
					case 'paid':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity )):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'paid_active':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity ) AND $payment->status):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'paid_inactive':
						foreach($temps as $temp):
							if($payment = $temp->getPaymentByAnnuity( $annuity ) AND !$payment->status):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
					case 'notpaid':
						foreach($temps as $temp):
							if(!$temp->getPaymentByAnnuity( $annuity )):
								$associates = $associates->orWhere('id_asociado','=',$temp->id_asociado);
							endif;
						endforeach;
						break;
				}
			endif;

			$associates = $associates->get();
		
		Excel::create('Export Asociados - '. rand(2, 700*date("H"))."-".date("d-m-Y"), function($excel) use ($associates){

		    $excel->sheet('Excel sheet', function($sheet) use ($associates){
				
		        $sheet->setOrientation('portrait');
		    	
		    	$n =2;

				$annuity_categories = array();

				/*foreach(ORGAnnuityCategories::all() as $annuity_category):
					$annuity_categories[$annuity_category->id] = array(
						'id_anuidade' => $annuity_category->id_anuidade,
						'id_categoria_asociado' => $annuity_category->id_categoria_asociado
						);
				endforeach;*/

				$counter = 0;

				foreach($associates as $aso):
			    	
			    	$cod_aso = $aso->id_asociado;
			    	$nome = $aso->nombre_completo;
			    	$razon_social = $aso->razon_social;
			    	$incripcion_estadual = $aso->inscripcion_estadual;
			    	$incripcion_municipal = $aso->inscripcion_municipal;
			    	$cpf = $aso->cpf;
			    	$tipo_pessoa = $aso->tipo_pessoa;
			    	$rg = $aso->rg;
			    	$celular_residencia = $aso->celular_res;
			    	$email = $aso->email;
			    	$telefone_residencia = $aso->ddd_res . ' ' . $aso->ddi_res . ' ' . $aso->telefone_res;
			    	$data_nascimento = date('d-m-Y', strtotime($aso->data_nascimento));
			    	$tipo_correspondencia = $aso->tipo_correspondencia;
			    	$training = ORGTrainings::find($aso->formacao);
			    	$training = $training ? $training->nome : '';
			    	$categoria_titulo = $aso->categoria != '' ? $aso->category->nombre_categoria : "";
				   		/*foreach(ORGAssociateCategories::all() as $cat):
	              	        if($aso->categoria == $cat->id_categoria_asociado):
	              	            $categoria_titulo = $cat->nombre_categoria;
	              	            break;
	              	        endif;
	              	    endforeach;*/
		              	// $logradouro_res ="";
	              	$backyard = ORGBackyards::find($aso->logradouro_res);
	              	$logradouro_res= $backyard ? $backyard->nombre : '';
				   		/*foreach($backyards as $backyard):
		              	        if($aso->logradouro_res == $backyard->id_logradouro):
		              	            $logradouro_res=$backyard->nombre;
		              	        break;
		              	        endif;
		              	    endforeach;*/
			    	$municipio_residencia = ORGTowns::find($aso->municipio_res);
			    	$direccion_residencia = $aso->dir_res;
			    	$complemento_residencia= $aso->complemento_res;
		            $barrio_residencia = $aso->bairro_res;
			    	$numero_residencia = $aso->numero_res;
			    	$cep_residencia = $aso->cep_res;
			    	// $uf_residencia ="";
			    	$ufs = ORGuf::find($aso->uf_res);
			    	$uf_residencia= $ufs ? $ufs->name_uf : '';
			    	/*foreach($ufs as $uf):
	                  	    if($aso->uf_res == $uf->id_uf):
	                  	        $uf_residencia=$uf->name_uf;
	                  	    break;
	                  	    endif;
	                  	endforeach;*/
			    	$pais_residencia = $aso->pais_res;
			    	$empresa = $aso->empresa;
		            $logradouro_com ="";
		            $backyard = ORGBackyards::find($aso->logradouro_res);
	              	$logradouro_com = $backyard ? $backyard->nombre : '';
				   		/*foreach($backyards as $backyard):
		              	        if($aso->logradouro_com == $backyard->id_logradouro):
		              	            $logradouro_com=$backyard->nombre;
		              	        break;
		              	        endif;
		              	    endforeach;*/
			    	$municipio_empresa = ORGTowns::find($aso->municipio_com);
			    	$direccion_empresa = $aso->dir_com;
			    	$uf_empresa="";
			    	$ufs = ORGuf::find($aso->uf_com);
			    	$uf_empresa= $ufs ? $ufs->name_uf : '';
	                  	/*foreach($ufs as $uf):
	                  	    if($aso->uf_com == $uf->id_uf):
	                  	        $uf_empresa=$uf->name_uf;
	                  	    break;
	                  	    endif;
	                  	endforeach;*/
			    	$numero_empresa = $aso->numero_com;
			    	$cep_empresa = $aso->cep_com;
		              	$barrio_empresa = $aso->bairro_com;
			    	$complemento_empresa = $aso->complemento_com;
			    	$pais_empresa = $aso->pais_com;
			    	$empresa_tel = $aso->ddd_com . ' ' . $aso->ddi_com . ' ' . $aso->telefone_com;
			    	$celular_empresa = $aso->celular_com;
			    	$cnpj = $aso->cnpj;
			    	$cargo = $aso->cargo;
			    	$pasaporte = $aso->passaporte;
			    	$website =  $aso->web_site;
			    	$responsable =  $aso->responsavel;
			    	$nombre_cientifico= $aso->nome_cientifico;
			    	$publicacoes = $aso->publicacoes;
			    	$observacao = $aso->observacao;
			    	$institucion = $aso->institucion;
			    	$data_cadastro = date('d-m-Y', strtotime($aso->data_cadastro));
			    	
			    	// $area_de_especializacion_empresa=$aso->area_de_especializacion_otro;
			    	

				    /*$cols = array(
						"Codigo Asociado",
						"Nome Completo",
						"Razon Social",
						"Inscription estadual",
						"Inscription municipal",
						"CPF",
						"Tipo Pessoa",
						"RG",
						"Celular",
						"Email",
						"Telefone",
				    	);

				    $annuities = ORGAnnuities::all();

				    foreach($annuities as $annuity):
				    	$cols = array_merge($cols, array('valor_anuidade_'.$annuity->ano, 'valor_pago_'.$annuity->ano) );
				    endforeach;

				    $cols = array_merge($cols, array(
				    	"Data Nascimento",
						"Formação",
						"Tipo de Categoria",
						"Tipo de Correspondencia",
						"Logradouro Res",
						"Municipio Res",
						"Endereço Res",
						"Complemento Res",
						"Barrio Res",
						"Numero Res",
						"CEP Res",
						// "Cidade",
						"Estado Res",
						"Pais Res",
						"Empresa",
						"Logradouro Empresa",
						"Municipio Empresa",
						"Endereço Empresa",
						// "Cidade Empresa",
						"Estado Empresa",
						"Numero Empresa",
						"CEP Empresa",
						"Complemento Empresa",
						"Barrio Empresa",
						"Telefone Empresa",
						"Celular Empresa",
						"CNPJ",
						"Cargo",
						"Pasaporte",
						"Website",
						"Responsavel",
						// "Nome Cientifico",
						// "Publicacoes",
						// "Observaçoes",
						"Institucion",
						"Data Cadastro"
				    ));*/

				    // $sheet->appendRow(1, $cols);
			    	
			    	$sheet->appendRow(1,array("Codigo Asociado",
			    						  "Nome Completo",
			    						  "Razon Social",
			    						  "Inscription estadual",
			    						  "Inscription municipal",
			    						  "CPF",
			    						  "Tipo Pessoa",
			    						  "RG",
			    						  "Celular",
			    						  "Email",
			    						  "Telefone",
			    						  "valor_anuidade_".date('Y'),
			    						  "valor_pago_".date('Y'),
			    						  // "Pagamento",
			    						  // "Fecha",
			    						  // "User Type",
			    						  "Data Nascimento",
			    						  "Formação",
			    						  "Tipo de Categoria",
			    						  "Tipo de Correspondencia",
			    						  "Logradouro Res",
			    						  "Municipio Res",
			    						  "Endereço Res",
			    						  "Complemento Res",
			    						  "Barrio Res",
			    						  "Numero Res",
			    						  "CEP Res",
			    						  // "Cidade",
			    						  "Estado Res",
			    						  "Pais Res",
			    						  "Empresa",
			    						  "Logradouro Empresa",
			    						  "Municipio Empresa",
			    						  "Endereço Empresa",
			    						  // "Cidade Empresa",
			    						  "Estado Empresa",
			    						  "Numero Empresa",
			    						  "CEP Empresa",
			    						  "Complemento Empresa",
			    						  "Barrio Empresa",
			    						  "Telefone Empresa",
			    						  "Celular Empresa",
			    						  "CNPJ",
			    						  "Cargo",
			    						  "Pasaporte",
			    						  "Website",
			    						  "Responsavel",
			    						  // "Nome Cientifico",
			    						  // "Publicacoes",
			    						  // "Observaçoes",
			    						  "Institucion",
			    						  "Data Cadastro" ));

					/*$anuidade_2013 = null;
					$anuidade_2014 = null;
					$anuidade_2015 = null;
					
					foreach ($aso->anuidades as $anuidade):
						
						switch($anuidade->ano){
							case "2013":
								$anuidade_2013 = $anuidade;
								break;
							case "2014":
								$anuidade_2014 = $anuidade;
								break;
							case "2015":
								$anuidade_2015 = $anuidade;
								break;
							default:
								break;
						} 

					endforeach;*/

					$total = [
						"codigo"=>$cod_aso,
			    		"nome" => $nome,
			    		"razon_social"=>$razon_social,
			    		"inscription_est" => $incripcion_estadual,
			    		"incripcion_municipal" => $incripcion_municipal,
			    		"cpf" => $cpf,
			    		"tipo_pessoa" => $tipo_pessoa,
			    		"rg" => $rg,  
			    		"celular" => $celular_residencia,
			    		"email" => $email,
			    		"telefone" => $telefone_residencia,
					];

					$counter++;
					$inter_counter = 0;

					foreach(ORGAnnuities::where('ano','=',date('Y'))->take(1)->get() as $annuity):
					
						/*if($payment = $aso->getPaymentByAnnuity($annuity)):
							$interval = $payment->category->getCustomInterval( $payment->data_pagamento );
							$total = array_merge($total, array(
								// 'anuidade_'.$annuity->ano => $annuity->ano,
								'valor_anuidade_'.$annuity->ano => $interval->preco,
								'valor_pago_'.$annuity->ano => $payment->pagamento,
								)
							);
						else:
							$category = $annuity->getAnnuityCategoryByAssociateCategory($aso->category);
							if($category == null):
								$total = array_merge($total, array(
									// 'anuidade_'.$annuity->ano => $annuity->ano,
									'valor_anuidade_'.$annuity->ano => 'Não tem anuidade',
									'valor_pago_'.$annuity->ano => 'Não tem anuidade',
									)
								);
							else:

								$interval = $category->dates;

								$total = array_merge($total, array(
									// 'anuidade_'.$annuity->ano => $annuity->ano,
									'valor_anuidade_'.$annuity->ano => $interval[count($interval)-1]->preco,
									'valor_pago_'.$annuity->ano => 'Não tem anuidade',
									)
								);

							endif;

						endif;*/

							$inter_counter++;
							
							if($payment = $aso->getPaymentByAnnuity($annuity)):
								$interval = $payment->category->getCustomInterval($payment->data_pagamento);
								if($interval == null OR $interval == false):
									$interval = $payment->category->dates;
									if(isset($interval[0])) $interval = $interval[0];
								endif;
								// if($counter >= 40){dd($interval->isEmpty());}
								if(isset($interval->preco)):
									$total = array_merge($total, array(
										// 'anuidade_'.$annuity->ano => $annuity->ano,
										'valor_anuidade_'.$annuity->ano => $interval->preco,
										'valor_pago_'.$annuity->ano => $payment->pagamento,
										)
									);
								else:
									$total = array_merge($total, array(
										// 'anuidade_'.$annuity->ano => $annuity->ano,
										'valor_anuidade_'.$annuity->ano => "Não há dados",
										'valor_pago_'.$annuity->ano => $payment->pagamento,
										)
									);
								endif;
							else:
								if($aso->categoria != ''):
									$dates = $annuity->getAnnuityCategoryByAssociateCategory($aso->category);
									if($dates == null) :
										$dates = $dates;
									else:
										$dates = $dates->dates;
									endif;
									if(isset($dates[0])):
										$interval = $dates[0];
										$total = array_merge($total, array(
											// 'anuidade_'.$annuity->ano => $annuity->ano,
											'valor_anuidade_'.$annuity->ano => $interval->preco,
											'valor_pago_'.$annuity->ano => 'Não tem anuidade',
											)
										);
									else:
										$total = array_merge($total, array(
											// 'anuidade_'.$annuity->ano => $annuity->ano,
											'valor_anuidade_'.$annuity->ano => 'Não tem anuidade',
											'valor_pago_'.$annuity->ano => 'Não tem anuidade',
											)
										);
									endif;
								else:
									// dd($aso);

									$total = array_merge($total, array(
										// 'anuidade_'.$annuity->ano => $annuity->ano,
										'valor_anuidade_'.$annuity->ano => 'Não tem anuidade',
										'valor_pago_'.$annuity->ano => 'Não tem anuidade',
										)
									);
								endif;
							endif;


					endforeach;

					$total = array_merge($total, array(
						"data_nascimento" => $data_nascimento,
			    		"training" => $training,
			    		 
				 		// "paid" => $paid,
			    		// "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
			    		// "type" => $inscription->usertype->title,
			    		"categoria_titulo" => $categoria_titulo,
			    		"tipo_correspondencia" => $tipo_correspondencia,
			    		"logradouro_res" => $logradouro_res, 
			    		"municipio_residencia" => isset($municipio_residencia->name_municipio) ? $municipio_residencia->name_municipio : '',
			    		"direccion_residencia" => $direccion_residencia,
			    		"complemento_residencia" => $complemento_residencia,
			    		"barrio_residencia" => $barrio_residencia,
			    		"numero_residencia" => $numero_residencia,
			    		"cep_residencia" => $cep_residencia,
			    		// "cidade" => $cidade,
			    		"estado_residencia" => $uf_residencia,
			    		"pais_residencia" => $pais_residencia,
			    		"empresa" => $empresa,
			    		"logradouro_com" => $logradouro_com,
			    		"municipio_empresa" => isset($municipio_empresa->name_municipio) ? $municipio_empresa->name_municipio : '',
			    		"direccion_empresa" => $direccion_empresa,
			    		"estado_empresa" => $uf_empresa,
			    		"numero_empresa" => $numero_empresa,
			    		"cep_empresa" => $cep_empresa,
			    		"complemento_empresa" => $complemento_empresa,
			    		"barrio_empresa" => $barrio_empresa,
			    		// "pais_empresa" => $pais_empresa,
			    		"empresa_tel" => $empresa_tel,
			    		"celular_empresa" => $celular_empresa,
			    		"cnpj" => $cnpj,
			    		"cargo" => $cargo,
			    		"pasaporte" => $pasaporte,
			    		"website" => $website,
			    		"responsable" => $responsable,
			    		// "nombre_cientifico" => $nombre_cientifico,
			    		// "publicaciones" => $publicacoes,
			    		// "observaciones" => $observacao,
			    		"institucion" => $institucion,
			    		"data_cadastro" => $data_cadastro
					));

			    	/*$total= ["codigo"=>$cod_aso,
			    			 "nome" => $nome,
			    			 "razon_social"=>$razon_social,
			    			 "inscription_est" => $incripcion_estadual,
			    			 "incripcion_municipal" => $incripcion_municipal,
			    			 "cpf" => $cpf,
			    			 "tipo_pessoa" => $tipo_pessoa,
			    			 "rg" => $rg,  
			    			 "celular" => $celular_residencia,
			    			 "email" => $email,
			    			 "telefone" => $telefone_residencia,
							 "anuidade_2013" => ($anuidade_2013 != null) ? $anuidade_2013->ano : "Não tem anuidade",
							 "valor_anuidade_2013" => ($anuidade_2013 != null) ? $anuidade_2013->valor : "Não tem anuidade",
							 "valor_pago_2013" => ($anuidade_2013 != null) ? $anuidade_2013->valor_pago : "Não tem anuidade",
							 "data_anuidade_2013" => ($anuidade_2013 != null) ? $anuidade_2013->data : "Não tem anuidade",
							 "anuidade_2014" => ($anuidade_2014 != null) ? $anuidade_2014->ano : "Não tem anuidade" ,
							 "valor_anuidade_2014" => ($anuidade_2014 != null) ? $anuidade_2014->valor : "Não tem anuidade",
							 "valor_pago_2014" => ($anuidade_2014 != null) ? $anuidade_2014->valor_pago : "Não tem anuidade",
							 "data_anuidade_2014" => ($anuidade_2014 != null) ? $anuidade_2014->data : "Não tem anuidade",
							 "anuidade_2015" => ($anuidade_2015 != null) ? $anuidade_2015->ano : "Não tem anuidade",
							 "valor_anuidade_2015" => ($anuidade_2015 != null) ? $anuidade_2015->valor : "Não tem anuidade",
							 "valor_pago_2015" => ($anuidade_2015 != null) ? $anuidade_2015->valor_pago : "Não tem anuidade",
							 "data_anuidade_2015" => ($anuidade_2015 != null) ? $anuidade_2015->data : "Não tem anuidade",
			    			 "data_nascimento" => $data_nascimento,
			    			 "training" => $training,
			    			  
				 			 // "paid" => $paid,
			    			 // "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
			    			 // "type" => $inscription->usertype->title,
			    			 "categoria_titulo" => $categoria_titulo,
			    			 "tipo_correspondencia" => $tipo_correspondencia,
			    			 "logradouro_res" => $logradouro_res, 
			    			 "municipio_residencia" => isset($municipio_residencia->name_municipio) ? $municipio_residencia->name_municipio : '',
			    			 "direccion_residencia" => $direccion_residencia,
			    			 "complemento_residencia" => $complemento_residencia,
			    			 "barrio_residencia" => $barrio_residencia,
			    			 "numero_residencia" => $numero_residencia,
			    			 "cep_residencia" => $cep_residencia,
			    			 // "cidade" => $cidade,
			    			 "estado_residencia" => $uf_residencia,
			    			 "pais_residencia" => $pais_residencia,
			    			 "empresa" => $empresa,
			    			 "logradouro_com" => $logradouro_com,
			    			 "municipio_empresa" => isset($municipio_empresa->name_municipio) ? $municipio_empresa->name_municipio : '',
			    			 "direccion_empresa" => $direccion_empresa,
			    			 "estado_empresa" => $uf_empresa,
			    			 "numero_empresa" => $numero_empresa,
			    			 "cep_empresa" => $cep_empresa,
			    			 "complemento_empresa" => $complemento_empresa,
			    			 "barrio_empresa" => $barrio_empresa,
			    			 // "pais_empresa" => $pais_empresa,
			    			 "empresa_tel" => $empresa_tel,
			    			 "celular_empresa" => $celular_empresa,
			    			 "cnpj" => $cnpj,
			    			 "cargo" => $cargo,
			    			 "pasaporte" => $pasaporte,
			    			 "website" => $website,
			    			 "responsable" => $responsable,
			    			 // "nombre_cientifico" => $nombre_cientifico,
			    			 // "publicaciones" => $publicacoes,
			    			 // "observaciones" => $observacao,
			    			 "institucion" => $institucion,
			    			 "data_cadastro" => $data_cadastro
			    			 ];*/
			    			 // var_dump($total);
			        $sheet->appendRow($n,$total);

			        $n++;

			        // if($n>500) dd('meta');
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
			'formacoes' => ORGTrainings::all(),
			'logradouros' => ORGBackyards::all(),
			'categorias' => ORGAssociateCategories::all(),
			);

		return View::make('backend.clients.associates.create')->with($args);

	}

	public function postCreate(){

		$associate = new ORGAssociates();
		$category = ORGAssociateCategories::find(Input::get('categoria')); 
		
		$associate->nombre_completo = Input::get('nombre_completo');
		$associate->email = Input::get('email');
		$associate->edo_civil = Input::get('edo_civil');
		$associate->passaporte = Input::get('passaporte');
		$associate->institucion = Input::get('institucion');
		$associate->empresa = Input::get('empresa');
		$associate->rg = Input::get('rg');
		$associate->tipo_correspondencia = Input::get('tipo_correspondencia');
		$associate->data_nascimento = date('Y-m-d', strtotime(Input::get('data_nascimento')));
		$associate->sexo = Input::get('sexo');
		$associate->senha = md5(Input::get('senha'));
		$associate->web_site = Input::get('web_site');
		$associate->categoria = Input::get('categoria');
		$associate->tipo_pessoa = $category->tipo_usuario;
		$associate->cargo = Input::get('cargo');
		$associate->cpf = Input::get('cpf');

		/*		
		$associate->status_asso = Input::get('status_asso');
		$associate->es_associado = 1;
		$associate->estado_matricula = Input::get('estado_matricula');
		$associate->codigo_matricula = Input::get('codigo_matricula');
		$associate->tipo_pessoa = Input::get('tipo_pessoa');
		$associate->formacao = Input::get('formacao');
		$associate->razon_social = Input::get('razon_social');
		$associate->cpf = Input::get('cpf');
		$associate->cnpj = Input::get('cnpj');
		$associate->web_site = Input::get('web_site');
		$associate->responsavel = Input::get('responsavel');
		$associate->observacao = Input::get('observacao');
		*/

		$associate->cep_res = Input::get('cep_res');
		$associate->numero_res = Input::get('numero_res');
		$associate->complemento_res = Input::get('complemento_res');
		$associate->pais_res = Input::get('pais_res');
		$associate->logradouro_res = Input::get('logradouro_res');
		$associate->dir_res = Input::get('dir_res');
		$associate->bairro_res = Input::get('bairro_res');
		$associate->ciudad_internacional_res = Input::get('ciudad_internacional_res');
		$associate->ddd_res = Input::get('ddd_res');
		$associate->ddi_res = Input::get('ddi_res');
		$associate->telefone_res = Input::get('telefone_res');
		$associate->ddd_two_res = Input::get('ddd_two_res');
		$associate->ddi_two_res = Input::get('ddi_two_res');
		$associate->telefone_seg_res = Input::get('telefone_seg_res');
		$associate->ddd_cel_res = Input::get('ddd_cel_res');
		$associate->ddi_cel_res = Input::get('ddi_cel_res');
		$associate->celular_res = Input::get('celular_res');
		
		$associate->cep_com = Input::get('cep_com');
		$associate->numero_com = Input::get('numero_com');
		$associate->complemento_com = Input::get('complemento_com');
		$associate->pais_com = Input::get('pais_com');
		$associate->logradouro_com = Input::get('logradouro_com');
		$associate->dir_com = Input::get('dir_com');
		$associate->bairro_com = Input::get('bairro_com');
		$associate->ciudad_internacional_com = Input::get('ciudad_internacional_com');
		$associate->ddd_com = Input::get('ddd_com');
		$associate->ddi_com = Input::get('ddi_com');
		$associate->telefone_com = Input::get('telefone_com');
		$associate->ddd_two_com = Input::get('ddd_two_com');
		$associate->ddi_two_com = Input::get('ddi_two_com');
		$associate->telefone_seg_com = Input::get('telefone_seg_com');
		$associate->ddd_cel_com = Input::get('ddd_cel_com');
		$associate->ddi_cel_com = Input::get('ddi_cel_com');
		$associate->celular_com = Input::get('cel_com');

		$associate->data_cadastro = date('Y-m-d');
		$associate->codigo_matricula = Input::get('codigo_matricula');
		$associate->status_asso = Input::get('status_asso');

		if($associate->save()):

			$academic = new ORGAcademics();
			$academic->tipo_graduacion = Input::get('tipo_graduacion');
			$academic->institucion = Input::get('institucion');
			$academic->facultad = Input::get('facultad');
			$academic->curso_realizado = Input::get('curso_realizado');
			$academic->ano_inicio = Input::get('ano_inicio');
			$academic->ano_finalizacion = Input::get('ano_finalizacion');
			$academic->id_asociado = $associate->id_asociado;
			$academic->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.associates_create', array( 'title' => $associate->nombre_completo )));

		else:

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_create_err', array( 'title' => $associate->nombre_completo )));

		endif;

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$associate = ORGAssociates::find($id);

			if(!$associate):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_display_err'));

			else:

				$args = array(
					'route' => $this->route,
					'estados' => ORGStates::all(),
					'formacoes' => ORGTrainings::all(),
					'logradouros' => ORGBackyards::all(),
					'categorias' => ORGAssociateCategories::all(),
					'ufs' => ORGuf::all(),
					'associate' => $associate,
					);

				return View::make('backend.clients.associates.update')->with($args);

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$associate = ORGAssociates::find($id);

			if(!$associate):

				return Redirect::to($this->route);

			else:

				if(Input::get('senha') != ''):

					$new_password = Input::get('senha');

					if($associate->associate != null):

						$user = $associate->associate->getuser;
						$user->password = Hash::make($new_password);
						$user->save();

					else:

						$user = new User();
						$user->type = 'associate';
						$user->email = $associate->email;
						$user->password = Hash::make($new_password);
						$user->name = $associate->nombre_completo;
						$user->status = 'publish';
						$user->save();

						$assoc = new Associates();
						$assoc->associate = $associate->id_asociado;
						$assoc->user = $user->id;
						$assoc->name = $associate->nombre_completo;
						$assoc->email = $associate->email;
						$assoc->password = $associate->senha;
						$assoc->cpf = $associate->cpf;
						$assoc->type = 'associate';
						$assoc->status = 'publish';
						$assoc->save();

					endif;

				endif;

				if(Input::get('email') != $associate->email):

					$new_email = Input::get('email');

					$asocs = ORGAssociates::where('email','=',$new_email)->get();

					$users = User::where('email','=',$new_email)->get();

					$bool = false;

					if(isset($asocs[0])):
						foreach($asocs as $ascoc) if($ascoc->id_asociado != $associate->id_asociado) $bool = true;
					endif;

					if(isset($users[0])):
						foreach($users as $user): 
							if(!($user->type == 'associate' AND $user->associate->asociado->id_asociado == $associate->id_asociado)) $bool = true;
						endforeach;
					endif;

					if(!$bool):

						if($associate->associate != null):

							$user = $associate->associate->getuser;
							$user->email = $new_email;
							$user->save();

						else:

							$user = new User();
							$user->type = 'associate';
							$user->email = $new_email;
							$user->name = $associate->nombre_completo;
							$user->status = 'publish';
							$user->save();

							$assoc = new Associates();
							$assoc->associate = $associate->id_asociado;
							$assoc->user = $user->id;
							$assoc->name = $associate->nombre_completo;
							$assoc->email = $new_email;
							$assoc->cpf = $associate->cpf;
							$assoc->type = 'associate';
							$assoc->status = 'publish';
							$assoc->save();

						endif;

					else:

						dd('Este correo ya le pertenece a un asociado registrado');

					endif;

				endif;
				
				$associate->status_asso = Input::get('status_asso') != null ? Input::get('status_asso') : $associate->status_asso;
				$associate->categoria = Input::get('categoria') != null ? Input::get('categoria') : $associate->categoria;
				// $associate->es_associado = 1 != null ? Input::get('es_associado') : $associate->es_associado;
				$associate->estado_matricula = Input::get('estado_matricula') != null ? Input::get('estado_matricula') : $associate->estado_matricula;
				$associate->institucion = Input::get('institucion') != null ? Input::get('institucion') : $associate->institucion;
				$associate->codigo_matricula = Input::get('codigo_matricula') != null ? Input::get('codigo_matricula') : $associate->codigo_matricula;
				$associate->nombre_completo = Input::get('nombre_completo') != null ? Input::get('nombre_completo') : $associate->nombre_completo;
				$associate->tipo_pessoa = Input::get('tipo_pessoa') != null ? Input::get('tipo_pessoa') : $associate->tipo_pessoa;
				$associate->formacao = Input::get('formacao') != null ? Input::get('formacao') : $associate->formacao;
				$associate->cpf = Input::get('cpf') != null ? Input::get('cpf') : $associate->cpf;
				$associate->data_cadastro = Input::get('data_cadastro') != null ? Input::get('data_cadastro') : $associate->data_cadastro;
				$associate->edo_civil = Input::get('edo_civil') != null ? Input::get('edo_civil') : $associate->edo_civil;
				$associate->senha = Input::get('senha') != null ? md5(Input::get('senha')) : $associate->senha;
				$associate->web_site = Input::get('web_site') != null ? Input::get('web_site') : $associate->web_site;
				$associate->rg = Input::get('rg') != null ? Input::get('rg') : $associate->rg;
				$associate->razon_social = Input::get('razon_social') != null ? Input::get('razon_social') : $associate->razon_social;
				$associate->sexo = Input::get('sexo') != null ? Input::get('sexo') : $associate->sexo;
				$associate->cpf = Input::get('cpf') != null ? Input::get('cpf') : $associate->cpf;
				$associate->cnpj = Input::get('cnpj') != null ? Input::get('cnpj') : $associate->cnpj;
				$associate->passaporte = Input::get('passaporte') != null ? Input::get('passaporte') : $associate->passaporte;
				$associate->tipo_correspondencia = Input::get('tipo_correspondencia') != null ? Input::get('tipo_correspondencia') : $associate->tipo_correspondencia;
				$associate->email = Input::get('email') != null ? Input::get('email') : $associate->email;
				$associate->web_site = Input::get('web_site') != null ? Input::get('web_site') : $associate->web_site;
				$associate->responsavel = Input::get('responsavel') != null ? Input::get('responsavel') : $associate->responsavel;
				$associate->observacao = Input::get('observacao') != null ? Input::get('observacao') : $associate->observacao;
				$associate->empresa = Input::get('empresa') != null ? Input::get('empresa') : $associate->empresa;
				$associate->cargo = Input::get('cargo') != null ? Input::get('cargo') : $associate->cargo;
				$associate->cep_res = Input::get('cep_res') != null ? Input::get('cep_res') : $associate->cep_res;
				$associate->logradouro_res = Input::get('logradouro_res') != null ? Input::get('logradouro_res') : $associate->logradouro_res;
				$associate->dir_res = Input::get('dir_res') != null ? Input::get('dir_res') : $associate->dir_res;
				$associate->complemento_res = Input::get('complemento_res') != null ? Input::get('complemento_res') : $associate->complemento_res;
				$associate->numero_res = Input::get('numero_res') != null ? Input::get('numero_res') : $associate->numero_res;
				$associate->bairro_res = Input::get('bairro_res') != null ? Input::get('bairro_res') : $associate->bairro_res;
				$associate->pais_res = Input::get('pais_res') != null ? Input::get('pais_res') : $associate->pais_res;
				$associate->ddd_res = Input::get('ddd_res') != null ? Input::get('ddd_res') : $associate->ddd_res;
				$associate->ddi_res = Input::get('ddi_res') != null ? Input::get('ddi_res') : $associate->ddi_res;
				$associate->telefone_res = Input::get('telefone_res') != null ? Input::get('telefone_res') : $associate->telefone_res;
				$associate->ddd_two_res = Input::get('ddd_two_res') != null ? Input::get('ddd_two_res') : $associate->ddd_two_res;
				$associate->ddi_two_res = Input::get('ddi_two_res') != null ? Input::get('ddi_two_res') : $associate->ddi_two_res;
				$associate->telefone_seg_res = Input::get('telefone_seg_res') != null ? Input::get('telefone_seg_res') : $associate->telefone_seg_res;
				$associate->ddd_cel_res = Input::get('ddd_cel_res') != null ? Input::get('ddd_cel_res') : $associate->ddd_cel_res;
				$associate->ddi_cel_res = Input::get('ddi_cel_res') != null ? Input::get('ddi_cel_res') : $associate->ddi_cel_res;
				$associate->celular_res = Input::get('celular_res') != null ? Input::get('celular_res') : $associate->celular_res;
				$associate->ciudad_internacional_res = Input::get('ciudad_internacional_res') != null ? Input::get('ciudad_internacional_res') : $associate->ciudad_internacional_res;
				$associate->uf_res = Input::get('uf_res') != null ? Input::get('uf_res') : $associate->uf_res;
				$associate->municipio_res = Input::get('municipio_res') != null ? Input::get('municipio_res') : $associate->municipio_res;
				$associate->cep_com = Input::get('cep_com') != null ? Input::get('cep_com') : $associate->cep_com;
				$associate->logradouro_com = Input::get('logradouro_com') != null ? Input::get('logradouro_com') : $associate->logradouro_com;
				$associate->dir_com = Input::get('dir_com') != null ? Input::get('dir_com') : $associate->dir_com;
				$associate->complemento_com = Input::get('complemento_com') != null ? Input::get('complemento_com') : $associate->complemento_com;
				$associate->numero_com = Input::get('numero_com') != null ? Input::get('numero_com') : $associate->numero_com;
				$associate->bairro_com = Input::get('bairro_com') != null ? Input::get('bairro_com') : $associate->bairro_com;
				$associate->pais_com = Input::get('pais_com') != null ? Input::get('pais_com') : $associate->pais_com;
				$associate->ddd_com = Input::get('ddd_com') != null ? Input::get('ddd_com') : $associate->ddd_com;
				$associate->ddi_com = Input::get('ddi_com') != null ? Input::get('ddi_com') : $associate->ddi_com;
				$associate->telefone_com = Input::get('telefone_com') != null ? Input::get('telefone_com') : $associate->telefone_com;
				$associate->ddd_two_com = Input::get('ddd_two_com') != null ? Input::get('ddd_two_com') : $associate->ddd_two_com;
				$associate->ddi_two_com = Input::get('ddi_two_com') != null ? Input::get('ddi_two_com') : $associate->ddi_two_com;
				$associate->telefone_seg_com = Input::get('telefone_seg_com') != null ? Input::get('telefone_seg_com') : $associate->telefone_seg_com;
				$associate->ddd_cel_com = Input::get('ddd_cel_com') != null ? Input::get('ddd_cel_com') : $associate->ddd_cel_com;
				$associate->ddi_cel_com = Input::get('ddi_cel_com') != null ? Input::get('ddi_cel_com') : $associate->ddi_cel_com;
				$associate->celular_com = Input::get('celular_com') != null ? Input::get('celular_com') : $associate->celular_com;
				$associate->ciudad_internacional_com = Input::get('ciudad_internacional_com') != null ? Input::get('ciudad_internacional_com') : $associate->ciudad_internacional_com;
				$associate->uf_com = Input::get('uf_com') != null ? Input::get('uf_com') : $associate->uf_com;
				$associate->municipio_com = Input::get('municipio_com') != null ? Input::get('municipio_com') : $associate->municipio_com;
				$associate->classificados_conteudo = Input::get('classificados_conteudo') != null ? Input::get('classificados_conteudo') : $associate->classificados_conteudo;
				$associate->classificados_view = Input::get('classificados_view') != null ? Input::get('classificados_view') : $associate->classificados_view;
				$associate->area_de_especializacion = Input::get('area_de_especializacion') != null ? Input::get('area_de_especializacion') : $associate->area_de_especializacion;

				$image = Input::file('classificados_imagem');

				$validator = Validator::make(
					array(
						'image' => $image
						), 
					array(
						'image' => 'required|mimes:png,jpeg,gif'
						),
					array(
						'mimes' => 'Tipo de imagen inválido, solo se admite los formatos PNG, JPEG, y GIF'
						)
					);

				if(!$validator->fails()):

					$associate->classificados_imagem = $this->uploadImage($image);

				endif;

				if($associate->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.associates_update', array( 'title' => $associate->title )));

				else:

					dd('Error');

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_update_err', array( 'title' => $associate->title )));

				endif;

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_display_err'));

		else:

			$associate = ORGAssociates::find($id);

			$delete = ORGAssociates::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_delete_err', array( 'title' => $associate->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.associates_delete', array( 'title' => $associate->title )));

			endif;

		endif;

	}

	public function getEs( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_display_err'));

		else:

			$associate = ORGAssociates::find($id);

			if( $associate->es_asociado == 1 ):

				$associate->es_asociado = 0;

			else:

				$associate->es_asociado = 1;

			endif;

			$associate->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.associates_delete', array( 'title' => $associate->title )));

		endif;
		
	}

	public function getStatus( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.associates_display_err'));

		else:

			$associate = ORGAssociates::find($id);

			if( $associate->status_asso == 1 ):

				$associate->status_asso = 0;

			else:

				$associate->status_asso = 1;

			endif;

			$associate->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.associates_delete', array( 'title' => $associate->title )));

		endif;

	}

	public function getPaid( $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 1;

			$payment->save();

			return Redirect::to($this->route)->with( 'msg_success', Lang::get('messages.payment_success'));

		else:

			return Redirect::to($this->route);

		endif;
	}

	public function getNotpaid( $id = '' ){

		if( $id != '' ):

			$payment = ORGAssociateAnnuities::find( $id );

			$payment->status = 0;

			$payment->save();

			return Redirect::to($this->route)->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to($this->route);

		endif;
	}

	public function postMunicipios(){

		$uf = ORGuf::find(Input::get('id'));
		$html = '';

		foreach ($uf->towns as $municipio):
			$html .= "<option value='".$municipio->id_municipio."'>". $municipio->name_municipio ."</option>";
		endforeach;

		return $html;

	}

	public function uploadImage($image){

		//dd(storage_path('uploads/'));

		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$newheight=array();
		$width=array("100",$info_image[0]);
		#$filename = "prueba.".$image->getClientOriginalExtension();
		$filename = Hashids::encode(idate('U')).".".$image->getClientOriginalExtension();
		$nombres=["thumb_".$filename,$filename];

		for ($i=0; $i <count($width) ; $i++):

			$path = public_path('uploads/classificados/'.$nombres[$i]);
			Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
		
		endfor;

		return $filename;
		
	}

}
