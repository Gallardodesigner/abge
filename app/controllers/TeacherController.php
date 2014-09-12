<?php

class TeacherController extends \BaseController {

	
	protected $route = '/dashboard/teachers';

	public function getIndex(){

		$teachers = Teachers::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.teachers.index', array(
			'teachers' => $teachers,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.teachers.create');

	}

	public function postCreate(){

		$teacher = new Teachers();
		$teacher->title = Input::get('title');
		$teacher->content = Input::get('content');
		$teacher->type = 'teacher';
		$teacher->status = 'draft';
		$teacher->save();

		return View::make('backend.teachers.index', array('msg_success' => 'The teacher was successfully created!'));

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$teacher = Teachers::find($id);

			if(!$teacher):

				return Redirect::to($this->route);

			else:

				return View::make('backend.teachers.update', array('teacher' = $teacher));

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

				$teacher->title = Input::get('title');
				$teacher->content = Input::get('content');
				$teacher->type = 'teacher';
				$teacher->status = 'draft';
				$teacher->save();
				return Redirect::to($this->route);

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read publish without an identification key of teachers');
		
		else:

			$teacher = Teachers::publish($id);

			if(!$teacher):

				return Redirect::to($this->route)->with('msg_error','Can\'t publish the teacher');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was published successfully');

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read draft without an identification key of teachers');
		
		else:

			$teacher = Teachers::draft($id);

			if(!$teacher):

				return Redirect::to($this->route)->with('msg_error','Can\'t draft the teacher');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was drafted successfully');

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read trash without an identification key of teachers');
		
		else:

			$teacher = Teachers::trash($id);

			if(!$teacher):

				return Redirect::to($this->route)->with('msg_error','Can\'t trash the teacher');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was trashed successfully');

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read untrash without an identification key of teachers');
		
		else:

			$teacher = Teachers::draft($id);

			if(!$teacher):

				return Redirect::to($this->route)->with('msg_error','Can\'t untrash the teacher');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was untrashed successfully');

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return View::make('backend.teachers.trash');

		else:

			$teacher = Teachers::destroy($id);

			if(!$teacher):

				return Redirect::to($this->route)->with('msg_error','Can\'t delete the teacher');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was deleted successfully');

			endif;


	}



}
