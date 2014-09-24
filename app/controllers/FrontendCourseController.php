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

	public function getIndex( $id = '', $content = '', $idContent = ''  ){

		if( $id == '' ):

			$courses = Courses::getPublish();

			return View::make('frontend.courses.index')->with( array( 'courses' => $courses ) );

		elseif( $id != '' ):

			$course = Courses::find($id);
		
			$course->start = date("d-m-Y", strtotime($course->start));
			$course->end = date("d-m-Y", strtotime($course->end));

			if($course):

				switch($content){

					case '':
						return self::getCourseContent( $id, $course, $idContent );
						break;
					case 'content':
						return self::getCourseContent( $id, $course, $idContent );
						break;
					case 'inscriptions':
						return self::getCourseInscription( $id, $course, $idContent );
						break;
					default:
						return self::getCourseContent( $id, $course, $idContent );
						break;

				}

			else:

				return View::make('frontend.courses.notfound');

			endif;

		endif;

	}

	public static function getCourseContent( $id, $course, $idContent ){

		$contents = $course->coursesections;

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
				case 'supporters':
					$array['supporters'] = $course->supporters;
					return View::make('frontend.courses.supporters')->with( $array );
					break;
				default:
					return View::make('frontend.courses.content')->with( $array );
					break;
			}

		else:

		return View::make('frontend.courses.stand')->with( $array );

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

		$array = array( 'course' => $course, 'contents' => $contents );

		return View::make('frontend.courses.inscription')->with( $array );

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