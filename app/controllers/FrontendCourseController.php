<?php

class FrontendCourseController extends \BaseController {

	/* ----------------- Vistas ------------------ *

	Main Folder: frontend/courses

	Files: 

		- index.blade.php 			Muestra todos los cursos activos
		- content.blade.php 			Muestra la informacion principal del curso
		- data.blade.php 			Muestra la fecha y localidad del curso
		- program.blade.php 		Muestra el contenido programatico del curso
		- teachers.blade.php 		Muestra los profesores del curso
		- signin.blade.php 			Muestra la informacion de inscripcion al curso
		- company.blade.php 		Muestra la compañia del curso
		- promotioners.blade.php 	Muestra las promociones del curso
		- supporters.blade.php 		Muestra las empresas de Apoio del curso
		- information.blade.php 	Muestra las informaciones generales del curso
		- book.blade.php 			Muestra el formulario de registro del curso
		- notfound.blade.php 		Muestra un mensaje de curso no encontrado

	*/

	public function getIndex( $route = '', $content = '', $idContent = '' ){

		if( $route == '' ):

			$courses = Courses::getPublish();

			foreach ($courses as $course) {
				$course->start = date("d-m-Y", strtotime($course->start));
				$course->end = date("d-m-Y", strtotime($course->end));
			}

			return View::make('frontend.courses.index')->with( array( 'courses' => $courses ) );

		elseif( $route != '' ):

			$course = Courses::find($route);
		
			$course->start = date("d-m-Y", strtotime($course->start));
			$course->end = date("d-m-Y", strtotime($course->end));

			if($course):

				switch($content){

					case '':
						return self::getCourseContent( $route, $course, $idContent );
						break;
					case 'content':
						return self::getCourseContent( $route, $course, $idContent );
						break;
					case 'inscriptions':
						return self::getCourseInscription( $route, $course, $idContent );
						break;
					case 'works':
						return self::getCourseWorks( $route, $course, $idContent );
						break;
					case 'signin':
						return self::getCourseSignin( $route, $course, $idContent );
						break;
					case 'files':
						return self::getCourseFiles( $route, $course, $idContent );
						break;
					case 'filesuploaded':
						return self::getCourseFilesUploaded( $route, $course, $idContent );
						break;
					case 'payment':
						return self::getCoursePayment( $route, $course, $idContent );
						break;
					default:
						return self::getCourseContent( $route, $course, $idContent );
						break;

				}

			else:

				return View::make('specialpages.404');

			endif;

		endif;

	}

	public function postIndex( $route = '', $content = '', $idContent = '' ){

		$course = Courses::find($route);
	
		$course->start = date("d-m-Y", strtotime($course->start));
		$course->end = date("d-m-Y", strtotime($course->end));

		if($course):

			switch($content){
				case 'files':
					return self::postCourseFiles( $course->id, $course, $idContent );
					break;
			}

		else:

			return View::make('specialpages.404');

		endif;

	}

	public static function getCourseContent( $id, $course, $idContent ){

		$contents = self::getOrderedContent($course->coursesections);

		$array = array( 'course' => $course, 'contents' => $contents );

		if($idContent != ''):

			$array['section'] = CoursesSection::find($idContent);
			switch($array['section']->section->type){
				case 'section':
					return View::make('frontend.courses.content')->with( $array );
					break;
				case 'teachers':
					$array['teachers'] = $course->teachers;
					return View::make('frontend.courses.teachers')->with( $array );
					break;
				case 'promotioners':
					$array['promotioners'] = $course->promotioners;
					return View::make('frontend.courses.promotioners')->with( $array );
					break;
				case 'helpers':
					$array['helpers'] = $course->helpers;
					return View::make('frontend.courses.helpers')->with( $array );
					break;
				case 'supporters':
					$array['supporters'] = $course->supporters;
					return View::make('frontend.courses.supporters')->with( $array );
					break;
				default:
					
					return View::make('frontend.courses.content')->with( $array );
					break;
			}

		else:

			$section = Sections::findByPosition(1);

			$sections = $course->coursesections;

			foreach( $sections as $sec ):
				if($sec->section_id == $section->id):
					$array['section'] = $sec;
				endif;
			endforeach;

			return View::make('frontend.courses.content')->with( $array );

		endif;

	}
/*
	public static function getCourseData( $id, $course ){

		return View::make('frontend.courses.data')->with( array( 'course' => $course ) );

	}

	public static function getCourseProgram( $id, $course ){

		return View::make('frontend.courses.program')->with( array( 'course' => $course ) );

	}

	public static function getCourseTeachers( $id, $course ){

		$teachers = $course->teachers;

		return View::make('frontend.courses.teachers')->with( array( 'course' => $course, 'teachers' => $teachers ) );

	}
*/
	public static function getCourseInscription( $id, $course, $idContent ){

		$contents = $course->coursesections;

		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		return View::make('frontend.courses.inscription')->with( $array );

	}

	public static function getCourseWorks( $id, $course, $idContent ){

		$contents = $course->coursesections;

		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		return View::make('frontend.courses.works')->with( $array );

	}

	public static function getCourseSignin( $id, $course, $idContent ){

		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		/*if($course->event->upload):

			return Redirect::to('/courses/'.$course->id.'/files')->with( $array );

		else:*/

			return Redirect::to('/courses/'.$course->id.'/payment')->with( $array );
/*
		endif;
*/
	}

	public static function getCourseFiles( $id, $course, $idContent ){

		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		return View::make('frontend.courses.files')->with( $array );

	}

	public static function getCourseFilesUploaded( $id, $course, $idContent ){

		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		return View::make('frontend.courses.filesupload')->with( $array );

	}

	public static function postCourseFiles( $id, $course, $idContent ){
		foreach(Input::file('files') as $file):

			if ($file != null):
				$url = $file->getRealPath();
				$extension = $file->getClientOriginalExtension();
				$name = Auth::user()->name.$file->getClientOriginalName().date('Y-m-d H:i:s').'.'.$extension;
				$size  = $file->getSize();
				$mime  = $file->getMimeType();
				$file->move(public_path('uploads/files/'), $name);
				$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
				$my_file = new Files();
				$my_file->id_course = $course->id;
				$my_file->id_user = Auth::user()->id;
				$my_file->id_inscription = $inscription->id;
				$my_file->url = '/uploads/files/'.$name;
				$my_file->size = $size;
				$my_file->mime = $mime;
				$my_file->status = 'draft';
				$my_file->save();
			endif;
		endforeach;

		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		return Redirect::to('courses/'.$course->route.'/filesuploaded')->with( $array );

	}

	public static function getCoursePayment( $id, $course, $idContent ){

		if(count($course->inscriptions) > $course->min ):

		$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
		$button = '';
		foreach($inscription->usertype->dates as $date):
			$datetime1 = date_create($date->start);
			$datetime2 = date_create(date('Y-m-d'));
			$datetime3 = date_create($date->start);
			$interval1 = date_diff($datetime1, $datetime2);
			$interval2 = date_diff($datetime2, $datetime3);
			if(($interval1->format('%R') == '+') AND ($interval2->format('%R') == '-')):
				$button = $date->button;
			endif;	
		endforeach;
		
		else:
			$button = $course->min_message;
		endif;

		$array = array( 'button' => $button,'course' => $course,'contents' => self::getOrderedContent($course->coursesections) );

		return View::make('frontend.courses.payment')->with( $array );

	}

	public static function getOrderedContent( $contents ){

		$sections = Sections::getPublish();

		$array = array();
		$position = 0;

		foreach( $sections as $section ):
			foreach( $contents as $content ):
				if( $content->section->id == $section->id ):
					$array[$position] = $content;
					$position++;
				endif;
			endforeach;
		endforeach;

		return $array;

	}

/*
	public static function getCourseCompany( $id, $course ){

		return View::make('frontend.courses.company')->with( array( 'course' => $course ) );

	}

	public static function getCoursePromotioners( $id, $course ){

		$promotioners = $course->promotioners;

		return View::make('frontend.courses.promotioners')->with( array( 'course' => $course, 'promotioners' => $promotioners ) );

	}

	public static function getCourseSupporters( $id, $course ){

		$supporters = $course->supporters;

		return View::make('frontend.courses.supporters')->with( array( 'course' => $course, 'supporters' => $supporters ) );

	}

	public static function getCourseInformation( $id, $course ){

		return View::make('frontend.courses.information')->with( array( 'course' => $course ) );

	}

	public static function getCourseBook( $id, $course ){

		return View::make('frontend.courses.book')->with( array( 'course' => $course ) );

	}
*/
}