<?php

class ORGParticipantController extends \BaseController {
	
	protected $route = '/dashboard/participants';

	public function getIndex(){

		$participants = ORGParticipants::all();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.clients.participants.index', array(
			'participants' => $participants,
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.participants.create');

	}

	public function postCreate(){

		$image = Input::file('url');

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

		if($validator->fails()):

			return Redirect::to($this->route.'/create')->with('msg_succes', Lang::get('messages.participants_create_img_err'));

		else:

			$filename = $this->uploadImage($image);

			$company = new ORGParticipants();
			$company->title = Input::get('title');
			$company->content = Input::get('content');
			$company->address = Input::get('address');
			$company->contact = Input::get('contact');
			$company->type = 'company';
			$company->status = 'draft';
			$company->url = $filename;

			if($company->save()):

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.participants_create', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_create_err', array( 'title' => $company->title )));

			endif;

		endif;
	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$company = ORGParticipants::find($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));

			else:

				return View::make('backend.participants.update', array('company' => $company));

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$company = ORGParticipants::find($id);

			if(!$company):

				return Redirect::to($this->route);

			else:

				$company->title = Input::get('title');
				$company->content = Input::get('content');
				$company->address = Input::get('address');
				$company->contact = Input::get('contact');

				$image = Input::file('url');

				if($image != null):

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

					if($validator->fails()):

						return Redirect::to($this->route.'/update/'.$id)->with('msg_succes', Lang::get('messages.participants_update_err', array( 'title' => $company->title )));

					else:

						$filename = $this->uploadImage($image);

						$company->url = $filename;
					
					endif;

				endif;

				if($company->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.participants_update', array( 'title' => $company->title )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_update_err', array( 'title' => $company->title )));

				endif;

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));
		
		else:

			$company = ORGParticipants::find($id);

			$publish = ORGParticipants::publish($id);

			if(!$publish):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_publish_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.participants_publish', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));
		
		else:

			$company = ORGParticipants::find($id);

			$draft = ORGParticipants::draft($id);

			if(!$draft):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_draft_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.participants_draft', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			$participants = ORGParticipants::getTrash();

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.participants.trash', array(
				'participants' => $participants,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));
		
		else:

			$company = ORGParticipants::find($id);

			$trash = ORGParticipants::trash($id);

			if(!$trash):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_trash_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.participants_trash', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));
		
		else:

			$company = ORGParticipants::find($id);

			$draft = ORGParticipants::draft($id);

			if(!$draft):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.participants_untrash_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.participants_untrash', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.participants_display_err'));

		else:

			$company = ORGParticipants::find($id);

			$delete = ORGParticipants::destroy($id);

			if(!$delete):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.participants_delete_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.participants_delete', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function uploadImage($image){

		//dd(storage_path('uploads/'));

		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$newheight=array();
		$width=array("100","200","400",$info_image[0]);
		#$filename = "prueba.".$image->getClientOriginalExtension();
		$filename = str_replace('/', '!', Hash::make($image->getClientOriginalName().date('Y-m-d H:i:s'))).".".$image->getClientOriginalExtension();
		$nombres=["thumb_".$filename,"small_".$filename,"medium_".$filename,$filename];

		for ($i=0; $i <count($width) ; $i++):

			$path = public_path('uploads/'.$nombres[$i]);
			Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
		
		endfor;

		return $filename;
		
	}

}
