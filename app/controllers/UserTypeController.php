<?php

class UserTypeController extends \BaseController {

	protected $parent = '/dashboard/courses/';

	protected $route = '/dashboard/courses/{idCourse}/usertypes/';

	public function getIndex( $idCourse ){

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		$course = Courses::find($idCourse);

		if($course):

			return View::make('backend.usertypes.index', array(
			'course' => $course,
			'usertypes' => $course->usertypes,
			'parent' => $this->parent,
			'route' => self::parseRoute($idCourse),
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

		else:

			return Redirect::to($this->parent)->with(array('msg_error' => Lang::get('messages.course_not_found')));

		endif;

	}

	public function getCreate( $idCourse ){

		$course = Courses::find($idCourse);

		if($course):

			return View::make('backend.usertypes.create', array(
				'course' => $course,
				'route' => self::parseRoute($idCourse),
				));

		else:

			return Redirect::to($this->parent)->with(array('msg_error' => Lang::get('messages.course_not_found')));

		endif;

	}

	public function postCreate( $idCourse ){

		$usertype = new UserTypes();
		$usertype->course_id = $idCourse;
		$usertype->title = Input::get('title');
		$usertype->content = Input::get('content');
		$usertype->associate = Input::get('associate') == 'true' ? true : false;

		if($usertype->save()):

			return Redirect::to(self::parseRoute($idCourse))->with('msg_success', Lang::get('messages.usertypes_create', array( 'title' => $usertype->title )));

		else:

			return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.usertypes_create_err', array( 'title' => $usertype->title )));

		endif;

	}

	public function getUpdate( $idCourse, $idUserType = '' ){

		if( $idUserType == '' ):

			return Redirect::to(self::parseRoute($idCourse));
		
		else:

			$usertype = UserTypes::find($idUserType);

			if(!$usertype):

				return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.usertypes_display_err'));

			else:

				return View::make('backend.usertypes.update', array('usertype' => $usertype, 'route' => $this->route ));

			endif;

		endif;

	}

	public function postUpdate( $idCourse, $idUserType = '' ){

		if( $idUserType == '' ):

			return Redirect::to(self::parseRoute($idCourse));
		
		else:

			$usertype = UserTypes::find($idUserType);

			if(!$usertype):

				return Redirect::to(self::parseRoute($idCourse));

			else:

				$usertype->course_id = $idCourse;
				$usertype->title = Input::get('title');
				$usertype->content = Input::get('content');
				$usertype->associate = Input::get('associate') == 'true' ? true : false;

				if($usertype->save()):

					return Redirect::to(self::parseRoute($idCourse))->with('msg_success', Lang::get('messages.usertypes_update', array( 'title' => $usertype->title )));

				else:

					return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.usertypes_update_err', array( 'title' => $usertype->title )));

				endif;

			endif;

		endif;

	}

	public function getDelete( $idCourse, $idUserType = '' ){

		if( $idUserType == '' ):

			return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.usertypes_display_err'));

		else:

			$usertype = UserTypes::find($idUserType);

			$delete = UserTypes::destroy($idUserType);

			if(!$delete):

				return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.usertypes_delete_err', array( 'title' => $usertype->title )));

			else:

				return Redirect::to(self::parseRoute($idCourse))->with('msg_success', Lang::get('messages.usertypes_delete', array( 'title' => $usertype->title )));

			endif;

		endif;

	}

	public function parseRoute( $idCourse ){

		return str_replace('{idCourse}', $idCourse, $this->route );

	}

}