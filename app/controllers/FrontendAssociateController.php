<?php

class FrontendAssociateController extends \BaseController {

	protected static $route = '/associados';

	protected static $module = 'frontend_associate';

	public function getIndex(){

		$associate = Auth::user()->user()->associate->asociado;

		$args = array(
			'associate' => $associate,
			'route' => self::$route,
			'module' => 'associados_index',
			);

		return View::make('frontend.associates.index')->with($args);

	}

	public function getAnuidades(){

		$associate = Auth::user()->user()->associate->asociado;

		$annuities = ORGAnnuities::all();

		$args = array(
			'associate' => $associate,
			'payments' => $associate->payments,
			'annuities' => $annuities,
			'route' => self::$route,
			'module' => self::$module,
			);

		return View::make('frontend.associates.annuities')->with($args);

	}

	public function getAjuda(){

		$associate = Auth::user()->user()->associate->asociado;
		$annuities = $associate->payments;

		$args = array(
			'associate' => $associate,
			'annuities' => $annuities,
			'route' => self::$route,
			'module' => self::$module,
			);

		return View::make('frontend.associates.ajuda')->with($args);

	}

	public function getCadastro(){

		$associate = Auth::user()->user()->associate->asociado;
		$categories = ORGAssociateCategories::all();
		$logradouros = ORGBackyards::all();
		$ufs = ORGuf::all();

		$args = array(
			'associate' => $associate,
			'categories' => $categories,
			'logradouros' => $logradouros,
			'ufs' => $ufs,
			'route' => self::$route,
			'module' => 'associados_cadastro',
			);

		return View::make('frontend.associates.cadastro')->with($args);

	}

	public function postCadastro(){

		$associate = Auth::user()->user()->associate->asociado;

		$associate->nombre_completo = Input::get('nombre_completo');
		$associate->data_nascimento = date('Y-m-d', strtotime(Input::get('data_nascimento')));
		$associate->email = Input::get('email');
		$associate->sexo = Input::get('sexo');
		$associate->edo_civil = Input::get('edo_civil');
		$associate->senha = Input::get('senha') != '' ? md5(Input::get('senha')) : $associate->senha;
		$associate->passaporte = Input::get('passaporte');
		$associate->web_site = Input::get('web_site');
		$associate->institucion = Input::get('institucion');
		$associate->categoria = Input::get('categoria');
		$associate->empresa = Input::get('empresa');
		$associate->cargo = Input::get('cargo');
		$associate->rg = Input::get('rg');
		$associate->cpf = Input::get('cpf');
		$associate->tipo_correspondencia = Input::get('tipo_correspondencia');
		$associate->cep_res = Input::get('cep_res');
		$associate->logradouro_res = Input::get('logradouro_res');
		$associate->numero_res = Input::get('numero_res');
		$associate->dir_res = Input::get('dir_res');
		$associate->complemento_res = Input::get('complemento_res');
		$associate->bairro_res = Input::get('bairro_res');
		$associate->pais_res = Input::get('pais_res');
		$associate->uf_res = Input::get('uf_res');
		$associate->municipio_res = Input::get('municipio_res');
		$associate->cep_com = Input::get('cep_com');
		$associate->logradouro_com = Input::get('logradouro_com');
		$associate->numero_com = Input::get('numero_com');
		$associate->dir_com = Input::get('dir_com');
		$associate->complemento_com = Input::get('complemento_com');
		$associate->bairro_com = Input::get('bairro_com');
		$associate->pais_com = Input::get('pais_com');
		$associate->uf_com = Input::get('uf_com');
		$associate->municipio_com = Input::get('municipio_com');
		$associate->area_de_especializacion = Input::get('area_de_especializacion');
		$associate->classificados_conteudo = Input::get('classificados_conteudo');

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

		$associate->save();

		return Redirect::to(self::$route.'/cadastro');

	}

	public function postMunicipios(){

		$uf = ORGuf::find(Input::get('id'));
		$html = '';

		foreach ($uf->towns as $municipio):
			$html .= "<option value='".$municipio->id_municipio."'>". $municipio->name_municipio ."</option>";
		endforeach;

		return $html;

	}

	public function getAnnuities(){

		$anuidades = ORGAssociatesAnuidade::where('valor_pago','!=',0)->paginate(50);

		$counter = 0;

		foreach($anuidades as $anuidade):

			$counter++;

			$id_anuidade = null;

			switch($anuidade->ano){
				case '2013': $id_anuidade = 1; break;
				case '2014': $id_anuidade = 2; break;
				case '2015': $id_anuidade = 3; break;
				default: $id_anuidade = null; break;
			}

			$annuity_category = ORGAnnuityCategories::where('id_anuidade', '=', $id_anuidade)->where('id_categoria_asociado','=',$anuidade->id_categoria_asociado)->take(1)->get();

			if(isset($annuity_category[0])):

				$annuity_category = $annuity_category[0];

			else:

				$annuity_category = new ORGAnnuityCategories();
				$annuity_category->id_anuidade = $id_anuidade;
				$annuity_category->id_categoria_asociado = $anuidade->id_categoria_asociado;
				$annuity_category->save();

			endif;

			$annuity_date = null;

			$annuity_dates = $annuity_category->dates()->get();

			if(count($annuity_dates) > 0):

				$bool = false;

				# Busqueda de Datas Mediante Intervalos
				foreach($annuity_dates as $date):
					$datetime1 = date_create($date->data_inicio);
					$datetime3 = date_create($date->data_final);
					$interval1 = date_diff($datetime1, date_create(date('Y-m-d',strtotime($anuidade->data))));
					$interval2 = date_diff($datetime3, date_create(date('Y-m-d',strtotime($anuidade->data))));
					if(($interval1->format('%R') == '+') AND ($interval2->format('%R') == '-')):
						$bool = true;
							$counter > 50 ? dd('bwiubxiquw'): true;
						$annuity_date = $date;
					endif;	
				endforeach;

				if(!$bool):
					$counter > 50 ? dd('lsoaxksoam'): true;
					$annuity_date = new ORGAnnuityDates();
					$annuity_date->id_anuidade_categoria = $annuity_category->id;
					$annuity_date->nome = $anuidade->nome;
					$annuity_date->data_inicio = date($anuidade->ano.'-01-01');
					$annuity_date->data_final = date($anuidade->ano.'-12-31');
					$annuity_date->preco = $anuidade->valor;
					$annuity_date->save();

				endif;

			else:
				$counter > 50 ? dd('qweqwrefrqw'): true;
				$annuity_date = new ORGAnnuityDates();
				$annuity_date->id_anuidade_categoria = $annuity_category->id;
				$annuity_date->nome = $anuidade->nome;
				$annuity_date->data_inicio = date($anuidade->ano.'-01-01');
				$annuity_date->data_final = date($anuidade->ano.'-12-31');
				$annuity_date->preco = $anuidade->valor;
				$annuity_date->save();

			endif;

			$anuidade_asociado = new ORGAssociateAnnuities();
			$anuidade_asociado->id_asociado = $anuidade->id_asociado;
			$anuidade_asociado->id_anuidade_categoria = $annuity_date->id_anuidade_categoria;
			$anuidade_asociado->pagamento = $anuidade->valor_pago;
			$anuidade_asociado->data_pagamento = $anuidade->data;
			$anuidade_asociado->status = $anuidade->status;
			$anuidade_asociado->save();

		endforeach;

		return $anuidades->links();

	}

	public function getBoleto( $idAssociate ){
      
      $boleto = new Ticket();
      $boleto->buildHtml();
      $boleto->setAsociado(Crypt::decrypt($idAssociate));
      $boleto->inicialize();
      $boleto->printTcPdf();
      $corpo = $boleto->buildHtmlBoleto();
      $boleto->buildHtml($corpo);
      $boleto->addPagePdf();
      $boleto->creaPaginaBoleto();
      $boleto->endPagePdf();
      $boleto->inicializaHtml();
      $boleto->downloadPdf('associados');

	}

	public function getSalir(){

		Auth::user()->logout();

		return Redirect::to( self::$route );
		
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