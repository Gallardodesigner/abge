<?php

class FileController extends \BaseController {

	public static $ancestor = '/dashboard/courses/';

	public static $parent = '/dashboard/courses/{idCourse}/inscriptions';

	public static $route = '/dashboard/courses/{idCourse}/inscriptions/{idInscription}/files';

	public function getIndex( $idCourse, $idInscription ){

		$course = Courses::find($idCourse);

		$inscription = Inscriptions::find($idInscription);

		$files = $inscription->files;


		$array = array(
			'course' => $course,
			'inscription' => $inscription,
			'files' => $files,
			'route' => self::parseRoute($course->id, ),
			'parent' => self::parseParent($course->id),
			'parent' => self::$parent,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			);

		return View::make('backend.inscriptions.files')->with( $array );

	}

	public function getPaid( $idCourse, $id = '' ){

		if( $id != '' ):

			$inscription = Inscriptions::find( $id );

			$inscription->paid = true;

			$inscription->save();

			return Redirect::to(self::parseRoute($idCourse))->with( 'msg_success', Lang::get('messages.payment_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse) );

		endif;
	}

	public function getNotpaid( $idCourse, $id = '' ){

		if( $id != '' ):

			$inscription = Inscriptions::find( $id );

			$inscription->paid = false;

			$inscription->save();

			return Redirect::to(self::parseRoute($idCourse))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse) );

		endif;
	}

	public static function parseRoute( $idCourse, $idInscription ){

		$route = str_replace('{idInscription}', $idInscription, self::$route );

		return str_replace('{idCourse}', $idCourse, $route );

	}

	public static function parseParent( $idCourse ){

		return str_replace('{idCourse}', $idCourse, self::$parent );

	}

}