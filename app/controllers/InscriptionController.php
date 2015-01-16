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
			'trainings' => ORGTrainings::all(),
			'estados' => ORGStates::all(),
			'backyards' => ORGBackyards::all(),
			'towns' => ORGTowns::all(),
			'categories' => ORGAssociateCategories::all(),
			);

		if( $user->type == 'associate' ){
			return View::make('backend.inscriptions.associate')->with($args);
			}
		else{
			return View::make('backend.inscriptions.participant')->with($args);
		}

	}

	public function getDelete( $idCourse, $id ){

		$inscription = Inscriptions::find( $id );

		if( $inscription ):

			foreach( $inscription->files as $file ):

				if( file_exists(str_replace( '//', '/', public_path($file->url) ) ) ):

					unlink(public_path($file->url));

					Files::destroy($file->id);
					
				else:

					Files::destroy($file->id);

				endif;

			endforeach;

			Inscriptions::destroy( $inscription->id );

		endif;

		return Redirect::to(self::parseRoute($idCourse));

	}

	public function getAddparticipant($idCourse){

		$args = array(
			'route' => self::parseRoute($idCourse),
			'course' => Courses::find($idCourse),
			'participants' => ORGParticipants::all()
			);

		return View::make('backend.inscriptions.addparticipant')->with($args);

	}

	public function postAddparticipant($idCourse){

		

	}

	public function getAddassociate($idCourse){

		$args = array(
			'route' => self::parseRoute($idCourse),
			'course' => Courses::find($idCourse),
			'associates' => ORGAssociates::all()
			);

		return View::make('backend.inscriptions.addassociate')->with($args);

	}

	public function postAddAssociate($idCourse){

		
		
	}

	public static function parseRoute( $idCourse ){

		return str_replace('{idCourse}', $idCourse, self::$route );

	}

}