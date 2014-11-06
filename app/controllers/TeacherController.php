<?php

class TeacherController extends \BaseController {

	
	protected $route = '/dashboard/teachers';

		public function getIndex(){

		$teachers = Teachers::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.teachers.index', array(
			'teachers' => $teachers,
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.teachers.create');

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

			return Redirect::to($this->route.'/create')->with('msg_succes', Lang::get('messages.teachers_create_img_err'));

		else:

			$filename = $this->uploadImage($image);

			$teacher = new Teachers();
			$teacher->content = Input::get('content');
			$teacher->firstName = Input::get('firstName');
			$teacher->lastName = Input::get('lastName');
			$teacher->contact = Input::get('contact');
			$teacher->status = 'draft';
			$teacher->url = $filename;

			if($teacher->save()):

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.teachers_create', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			else:

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_create_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			endif;

		endif;
	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$teacher = Teachers::find($id);

			if(!$teacher):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_display_err'));

			else:

				return View::make('backend.teachers.update', array('teacher' => $teacher));

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$teacher = Teachers::find($id);

			if(!$teacher):

				return Redirect::to($this->route);

			else:

				$teacher->content = Input::get('content');
				$teacher->firstName = Input::get('firstName');
				$teacher->lastName = Input::get('lastName');
				$teacher->contact = Input::get('contact');
				$teacher->type = 'teacher';
				$teacher->status = 'draft';

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

						return Redirect::to($this->route.'/update/'.$id)->with('msg_succes', Lang::get('messages.teachers_update_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

					else:

						$filename = $this->uploadImage($image);

						$teacher->url = $filename;
					
					endif;

				endif;

				if($teacher->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.teachers_update', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_update_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

				endif;

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_display_err'));
		
		else:

			$teacher = Teachers::find($id);

			$publish = Teachers::publish($id);

			if(!$publish):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_publish_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.teachers_publish', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_display_err'));
		
		else:

			$teacher = Teachers::find($id);

			$draft = Teachers::draft($id);

			if(!$draft):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_draft_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.teachers_draft', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			$teachers = Teachers::getTrash();

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.teachers.trash', array(
				'teachers' => $teachers,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));
		
		else:

			$teacher = Teachers::find($id);

			$trash = Teachers::trash($id);

			if(!$trash):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_trash_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.teachers_trash', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_display_err'));
		
		else:

			$teacher = Teachers::find($id);

			$draft = Teachers::draft($id);

			if(!$draft):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.teachers_untrash_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.teachers_untrash', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.teachers_display_err'));

		else:

			$teacher = Teachers::find($id);

			$delete = Teachers::destroy($id);

			if(!$delete):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.teachers_delete_err', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.teachers_delete', array( 'firstName' => $teacher->firstName , 'lastName' => $teacher->lastName )));

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
