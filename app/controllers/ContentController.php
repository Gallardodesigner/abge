<?php

class ContentController extends \BaseController {

	protected $parent = '/dashboard/courses/';

	protected $route = '/dashboard/courses/{idCourse}/content/';

	public function getIndex( $idCourse ){

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		$course = Courses::find($idCourse);

		if($course):

			return View::make('backend.content.index', array(
				'course' => $course,
				'sections' => $course->sections,
				'contents' => $course->coursesections,
				'parent' => $this->parent,
				'route' => self::parseRoute($idCourse),
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));

		else:

			return Redirect::to(self::parseRoute($idCourse))->with(array('msg_error' => Lang::get('messages.course_not_found')));

		endif;

	}
/*
	public function getCreate( $idCourse ){

		$course = Courses::find($idCourse);

		if($course):

			return View::make('backend.content.create', array(
				'course' => $course,
				'route' => self::parseRoute($idCourse),
				));

		else:

			return Redirect::to(self::parseRoute($idCourse))->with(array('msg_error' => Lang::get('messages.course_not_found')));

		endif;

	}

	public function postCreate( $idCourse ){

		$content = new CoursesSection();
		$content->course_id = $idCourse;
		$content->title = Input::get('title');
		$content->content = Input::get('content');
		$content->associate = Input::get('associate') == 'true' ? true : false;

		if($content->save()):

			return Redirect::to(self::parseRoute($idCourse))->with('msg_success', Lang::get('messages.contents_create', array( 'title' => $content->title )));

		else:

			return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.contents_create_err', array( 'title' => $content->title )));

		endif;

	}

*/	public function getUpdate( $idCourse, $idContent = '' ){

		if( $idContent == '' ):

			return Redirect::to(self::parseRoute($idCourse));
		
		else:

			$content = CoursesSection::find($idContent);

			if(!$content):

				return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.contents_display_err'));

			else:

				$course = Courses::find($idCourse);

				$array =  array(
					'course' => $course,
					'content' => $content, 
					'route' => self::parseRoute($idCourse) 
					);

				$view = null;

				switch($content->section->type){
					case 'text':
						$view = 'backend.content.section';
						break;
					case 'teachers':
						$array['teachers'] = Teachers::getPublish();
						$view = 'backend.content.teachers';
						break;
					case 'helpers':
						$array['helpers'] = Companies::getPublish();
						$view = 'backend.content.helpers';
						break;
					case 'promotioners':
						$array['promotioners'] = Companies::getPublish();
						$view = 'backend.content.promotioners';
						break;
					case 'supporters':
						$array['supporters'] = Companies::getPublish();
						$view = 'backend.content.supporters';
						break;
					default:
						$view = 'backend.content.section';
						break;
				}

				return View::make($view, $array );

			endif;

		endif;

	}

	public function postUpdate( $idCourse, $idContent = '' ){

		if( $idContent == '' ):

			return Redirect::to(self::parseRoute($idCourse));
		
		else:

			$content = CoursesSection::find($idContent);

			if(!$content):

				return Redirect::to(self::parseRoute($idCourse));

			else:

				$course = Courses::find($idCourse);

				if(Input::get('teachers') != null ):
					$teachers = Input::get('teachers');
					$course->teachers()->sync($teachers);
				elseif(Input::get('promotioners') != null ):
					$promotioners = Input::get('promotioners');
					$course->promotioners()->sync($promotioners);
				elseif(Input::get('helpers') != null ):
					$helpers = Input::get('helpers');
					$course->helpers()->sync($helpers);
				elseif(Input::get('supporters') != null ):
					$supporters = Input::get('supporters');
					$course->supporters()->sync($supporters);
				endif;

				$content->content = Input::get('content');

				if($content->save()):

					return Redirect::to(self::parseRoute($idCourse))->with('msg_success', Lang::get('messages.contents_update', array( 'title' => $content->title )));

				else:

					return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.contents_update_err', array( 'title' => $content->title )));

				endif;

			endif;

		endif;

	}

	public function getDelete( $idCourse, $idContent = '' ){

		if( $idContent == '' ):

			return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.contents_display_err'));

		else:

			$content = CoursesSection::find($idContent);

			$delete = CoursesSection::destroy($idContent);

			if(!$delete):

				return Redirect::to(self::parseRoute($idCourse))->with('msg_error', Lang::get('messages.contents_delete_err', array( 'title' => $content->title )));

			else:

				return Redirect::to(self::parseRoute($idCourse))->with('msg_success', Lang::get('messages.contents_delete', array( 'title' => $content->title )));

			endif;

		endif;

	}

	public function parseRoute( $idCourse ){

		return str_replace('{idCourse}', $idCourse, $this->route );

	}

}