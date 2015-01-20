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
