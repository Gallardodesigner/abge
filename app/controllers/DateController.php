<?php

class DateController extends \BaseController {

	protected $ancestor = '/dashboard/courses/';

	protected $parent = '/dashboard/courses/{idCourse}/usertypes/';

	protected $route = '/dashboard/courses/{idCourse}/usertypes/{idUserType}/dates';

	public function getIndex( $idCourse, $idUserType, $idDate = '' ){

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		$course = Courses::find($idCourse);

		$usertype = UserTypes::find($idUserType);

		if($course):

			return View::make('backend.dates.index', array(
			'course' => $course,
			'usertypes' => $usertype,
			'dates' => $usertype->dates,
			'parent' => self::parseParent($idCourse),
			'route' => self::parseRoute($idCourse, $idUserType),
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

		else:

			return Redirect::to(self::parseRoute($idCourse, $idUserType))->with(array('msg_error' => Lang::get('messages.course_not_found')));

		endif;

	}

	public function getCreate( $idCourse, $idUserType, $idDate = '' ){

		$course = Courses::find($idCourse);

		if($course):

		$usertype = UserTypes::find($idUserType);

			if($usertype):

			return View::make('backend.dates.create', array(
				'course' => $course,
				'usertype' => $usertype,
				'route' => self::parseRoute($idCourse, $idUserType),
				));

			else:

				return Redirect::to(self::parseRoute($idCourse, $idUserType))->with(array('msg_error' => Lang::get('messages.usertype_not_found')));

			endif;

		else:

			return Redirect::to($this->ancestor)->with(array('msg_error' => Lang::get('messages.course_not_found')));

		endif;

	}

	public function postCreate( $idCourse, $idUserType, $idDate = '' ){

		$date = new Dates();
		$date->usertype_id = $idUserType;
		$date->start = date("Y-m-d", strtotime(Input::get('start')));
		$date->end = date("Y-m-d", strtotime(Input::get('end')));
		$date->price = Input::get('price');
		$date->message = Input::get('message');
		$date->button = Input::get('button');

		if($date->save()):

			return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_success', Lang::get('messages.dates_create'));

		else:

			return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_error', Lang::get('messages.dates_create_err'));

		endif;
	}

	public function getUpdate( $idCourse, $idUserType, $idDate = '' ){

		if( $idDate == '' ):

			return Redirect::to(self::parseRoute($idCourse, $idUserType));
		
		else:

			$date = Dates::find($idDate);
			$date->start = date("d-m-Y", strtotime($date->start));
			$date->end = date("d-m-Y", strtotime($date->end));

			if(!$date):

				return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_error', Lang::get('messages.dates_display_err'));

			else:

				return View::make('backend.dates.update', array('date' => $date,'route' => self::parseRoute($idCourse, $idUserType)));

			endif;

		endif;

	}

	public function postUpdate( $idCourse, $idUserType, $idDate = '' ){

		if( $idDate == '' ):

			return Redirect::to(self::parseRoute($idCourse, $idUserType));
		
		else:

			$date = Dates::find($idDate);

			if(!$date):

				return Redirect::to(self::parseRoute($idCourse, $idUserType));

			else:

				$date->start = date("Y-m-d", strtotime(Input::get('start')));
				$date->end = date("Y-m-d", strtotime(Input::get('end')));
				$date->price = Input::get('price');
				$date->message = Input::get('message');
				$date->button = Input::get('button');

				if($date->save()):

					return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_succes', Lang::get('messages.dates_update'));

				else:

					return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_error', Lang::get('messages.dates_update_err'));

				endif;

			endif;

		endif;

	}

	public function getDelete( $idCourse, $idUserType, $idDate = '' ){

		if( $idDate == '' ):

			return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_error', Lang::get('messages.teachers_display_err'));

		else:

			$date = Dates::find($idDate);

			$delete = Dates::destroy($idDate);

			if(!$delete):

				return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_error', Lang::get('messages.dates_delete_err'));

			else:

				return Redirect::to(self::parseRoute($idCourse, $idUserType))->with('msg_success', Lang::get('messages.dates_delete'));

			endif;

		endif;

	}

	public function parseRoute( $idCourse, $idUserType ){

		$route = str_replace('{idCourse}', $idCourse, $this->route );

		return str_replace('{idUserType}', $idUserType, $route );

	}

	public function parseParent( $idCourse ){

		return str_replace('{idCourse}', $idCourse, $this->parent ); 

	}

}