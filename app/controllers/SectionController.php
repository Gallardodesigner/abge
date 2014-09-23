<?php

class SectionController extends \BaseController {

	
	protected $route = '/dashboard/sections';

		public function getIndex(){

		$sections = Sections::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.sections.index', array(
			'sections' => $sections,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.sections.create');

	}

	public function postCreate(){
			$section = new Sections();
			$section->title = Input::get('title');
			$section->description = Input::get('description');
			$section->file = Input::get('file') == 'true' ? true : false ;
			if($section->save()):

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.sections_create', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			else:

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_create_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file)));

			endif;

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$section = Sections::find($id);

			if(!$section):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_display_err'));

			else:

				return View::make('backend.sections.update', array('section' => $section));

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$section = Sections::find($id);

			if(!$section):

				return Redirect::to($this->route);

			else:

				$section->title = Input::get('title');
				$section->description = Input::get('description');
				$section->file = Input::get('file');
				$section->type = 'section';
				$section->status = 'draft';

				if($section->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.sections_update', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_update_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

				endif;

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_display_err'));
		
		else:

			$section = Sections::find($id);

			$publish = Sections::publish($id);

			if(!$publish):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_publish_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.sections_publish', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_display_err'));
		
		else:

			$section = Sections::find($id);

			$draft = Sections::draft($id);

			if(!$draft):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_draft_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.sections_draft', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			$sections = Sections::getTrash();

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.sections.trash', array(
				'sections' => $sections,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));
		
		else:

			$section = Sections::find($id);

			$trash = Sections::trash($id);

			if(!$trash):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_trash_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.sections_trash', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_display_err'));
		
		else:

			$section = Sections::find($id);

			$draft = Sections::draft($id);

			if(!$draft):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.sections_untrash_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.sections_untrash', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.sections_display_err'));

		else:

			$section = Sections::find($id);

			$delete = Sections::destroy($id);

			if(!$delete):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.sections_delete_err', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.sections_delete', array( 'title' => $section->title , 'description' => $section->description, 'file'=>$section->file )));

			endif;

		endif;

	}



}
