<?php

class FrontendController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex( $route= '', $content = '', $idContent = '')
	{
		//
		if($route == ''):
			return Redirect::to('http://abge.org.br');
		elseif( $route != '' ):
			$course = Courses::findRoute($route);

			$course->start = date("d-m-Y", strtotime($course->start));
			$course->end = date("d-m-Y", strtotime($course->end));

			if($course):

				switch($content){

					case '':
						return FrontendCourseController::getCourseContent( $route, $course, $idContent );
						break;
					case 'content':
						return FrontendCourseController::getCourseContent( $route, $course, $idContent );
						break;
					case 'inscriptions':
						return FrontendCourseController::getCourseInscription( $route, $course, $idContent );
						break;
					case 'works':
						return FrontendCourseController::getCourseWorks( $route, $course, $idContent );
						break;
					case 'signin':
						return FrontendCourseController::getCourseSignin( $route, $course, $idContent );
						break;
					case 'files':
						return FrontendCourseController::getCourseFiles( $route, $course, $idContent );
						break;
					case 'filesuploaded':
						return FrontendCourseController::getCourseFilesUploaded( $route, $course, $idContent );
						break;
					case 'payment':
						return FrontendCourseController::getCoursePayment( $route, $course, $idContent );
						break;
					default:
						return FrontendCourseController::getCourseContent( $route, $course, $idContent );
						break;

				}

			else:

				return View::make('specialpages.404');

			endif;

		endif;
	}


}
