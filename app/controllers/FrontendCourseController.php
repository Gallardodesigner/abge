<?php

class FrontendCourseController extends \BaseController {

	public function getIndex( $id = '', $stand = '' ){

		if( $id == '' ):

			$courses = Courses::getPublish();

			return View::make('frontend.courses.index')->with( array( 'courses' => $courses ) );

		elseif( $id != '' ):

			$course = Courses::find($id);

			if($course):

				switch($stand){

					case '':
						return self::getCourseStand( $id, $course );
						break;
					case 'stand':
						return self::getCourseStand( $id, $course );
						break;
					case 'data':
						return self::getCourseData( $id, $course );
						break;
					case 'program':
						return self::getCourseProgram( $id, $course );
						break;
					case 'teachers':
						return self::getCourseTeachers( $id, $course );
						break;
					case 'signin':
						return self::getCourseSignin( $id, $course );
						break;
					case 'company':
						return self::getCourseCompany( $id, $course );
						break;
					case 'promotioners':
						return self::getCoursePromotioners( $id, $course);
						break;
					case 'supporters':
						return self::getCourseSupporters( $id, $course );
						break;
					case 'information':
						return self::getCourseInformation( $id, $course);
						break;
					default:
						return self::getCourseStand( $id, $course );
						break;

				}

			else:

				return 'Curso no encontrado';

			endif;

		endif;

	}

	public static function getCourseStand( $id, $course ){

		return View::make('frontend.courses.stand')->with( array( 'course' => $course ) );

	}

	public static function getCourseData( $id, $course ){

		return View::make('frontend.courses.data')->with( array( 'course' => $course ) );

	}

	public static function getCourseProgram( $id, $course ){

		return View::make('frontend.courses.program')->with( array( 'course' => $course ) );

	}

	public static function getCourseTeachers( $id, $course ){
		$teachers = $course->teachers;

		return View::make('frontend.courses.teacheres')->with( array( 'course' => $course, 'teachers' => $teachers ) );

	}

	public static function getCourseSignin( $id, $course ){

		return View::make('frontend.courses.signin')->with( array( 'course' => $course ) );

	}

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

}