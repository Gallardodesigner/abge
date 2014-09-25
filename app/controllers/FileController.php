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
			'route' => self::parseRoute($course->id, $idInscription ),
			'parent' => self::parseParent($course->id),
			'ancestor' => self::$ancestor,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			);

		return View::make('backend.inscriptions.files')->with( $array );

	}

	public function getPublish($idCourse, $idInscription, $id = '' ){

		if( $id != '' ):

			$file = Files::find( $id );

			$file->status = 'publish';

			$file->save();

			return Redirect::to(self::parseRoute($idCourse, $idInscription))->with( 'msg_success', Lang::get('messages.file_publish_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse, $idInscription) );

		endif;
	}

	public function getTrash($idCourse, $idInscription, $id = '' ){

		if( $id != '' ):

			$file = Files::find( $id );

			$file->status = 'trash';

			$file->save();

			return Redirect::to(self::parseRoute($idCourse, $idInscription))->with( 'msg_success', Lang::get('messages.file_trash_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse, $idInscription) );

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