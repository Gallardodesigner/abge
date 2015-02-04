<?php

class ORGAssociateController extends \BaseController {
	
	protected $route = '/dashboard/clients/associates';

	public function getIndex(){

		$associates = ORGAssociates::all();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.clients.associates.index', array(
			'associates' => $associates,
			'categories' => ORGAssociateCategories::all(),
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function postIndex(){

		$associates = ORGAssociates::where('nombre_completo','LIKE', '%'.Input::get('nombre_completo').'%');

		$categoria = Input::get('categoria');

		if(Input::get('categoria') != null):
			$associates = $associates->where('categoria', '=',Input::get('categoria'));
		endif;

		if(Input::get('tipo_usuario') != null):
			$categories = ORGAssociateCategories::where('tipo_usuario','=',Input::get('tipo_usuario'))->get();
			foreach($categories as $category):
				$associates = $associates->orWhere('categoria','=',$category->id_categoria_asociado);
			endforeach;
		endif;

		$associates = $associates->get();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.clients.associates.index', array(
			'associates' => $associates,
			'categories' => ORGAssociateCategories::all(),
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));
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
				
				$associate->status_asso = Input::get('status_asso') != null ? Input::get('status_asso') : $associate->status_asso;
				// $associate->es_associado = 1 != null ? Input::get('es_associado') : $associate->es_associado;
				$associate->estado_matricula = Input::get('estado_matricula') != null ? Input::get('estado_matricula') : $associate->estado_matricula;
				$associate->codigo_matricula = Input::get('codigo_matricula') != null ? Input::get('codigo_matricula') : $associate->codigo_matricula;
				$associate->nombre_completo = Input::get('nombre_completo') != null ? Input::get('nombre_completo') : $associate->nombre_completo;
				$associate->tipo_pessoa = Input::get('tipo_pessoa') != null ? Input::get('tipo_pessoa') : $associate->tipo_pessoa;
				$associate->formacao = Input::get('formacao') != null ? Input::get('formacao') : $associate->formacao;
				$associate->cpf = Input::get('cpf') != null ? Input::get('cpf') : $associate->cpf;
				$associate->data_cadastro = Input::get('data_cadastro') != null ? Input::get('data_cadastro') : $associate->data_cadastro;
				$associate->edo_civil = Input::get('edo_civil') != null ? Input::get('edo_civil') : $associate->edo_civil;
				$associate->senha = md5(Input::get('senha')) != null ? Input::get('senha') : $associate->senha;
				$associate->web_site = Input::get('web_site') != null ? Input::get('web_site') : $associate->web_site;
				$associate->rg = Input::get('rg') != null ? Input::get('rg') : $associate->rg;
				$associate->razon_social = Input::get('razon_social') != null ? Input::get('razon_social') : $associate->razon_social;
				$associate->sexo = Input::get('sexo') != null ? Input::get('sexo') : $associate->sexo;
				$associate->cpf = Input::get('cpf') != null ? Input::get('cpf') : $associate->cpf;
				$associate->cnpj = Input::get('cnpj') != null ? Input::get('cnpj') : $associate->cnpj;
				$associate->passaporte = Input::get('passaporte') != null ? Input::get('passaporte') : $associate->passaporte;
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

				if($associate->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.associates_update', array( 'title' => $associate->title )));

				else:

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

}
