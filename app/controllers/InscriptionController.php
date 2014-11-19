<?php

class InscriptionController extends \BaseController {

	public static $parent = '/dashboard/courses/';

	public static $route = '/dashboard/courses/{idCourse}/inscriptions';

	public function getIndex( $idCourse ){

		$course = Courses::find($idCourse);

		$inscriptions = $course->inscriptions;


		$array = array(
			'course' => $course,
			'inscriptions' => $inscriptions,
			'route' => self::parseRoute($course->id),
			'parent' => self::$parent,
			'msg_success' => Session::get('msg_success'),
			'msg_error' => Session::get('msg_error')
			);

		return View::make('backend.inscriptions.index')->with( $array );

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

	public function getExcelcourse( $idCourse, $id = '' ){

		if( $id != '' ):

			$inscription = Inscriptions::find( $id );

			Excel::create('Inscriptions_'.$inscription->course->title, function($excel) use ($inscription) {

			    $excel->sheet('Participants', function($sheet) {

			        $sheet->fromArray(array(
			            array('data1', 'data2'),
			            array('data3', 'data4')
			        ));

			    });

			})->export('xls');

			return Redirect::to(self::parseRoute($idCourse))->with( 'msg_success', Lang::get('messages.notpayment_success'));

		else:

			return Redirect::to( self::parseRoute($idCourse) );

		endif;
	}

	public function getDescription( $idCourse, $idUser){

		$user = User::find($idUser);

		$args = array(
			'route' => self::parseRoute($idCourse),
			'user' => $user,
			'estados' => ORGStates::all()
			);

		if( $user->type == 'associate' ){
			return View::make('backend.inscriptions.associate')->with($args);
			}
		else{
			return View::make('backend.inscriptions.participant')->with($args);
		}

	}

	public static function parseRoute( $idCourse ){

		return str_replace('{idCourse}', $idCourse, self::$route );

	}

}