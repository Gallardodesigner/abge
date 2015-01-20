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

		$course = Courses::find($idCourse);
			
		$args = array(
			'route' => self::parseRoute($idCourse),
			'course' => $course,
			'usertypes' => $course->usertypes,
			'participants' => ORGParticipants::all()
			);

		return View::make('backend.inscriptions.addparticipant')->with($args);

	}

	public function postAddparticipant($idCourse){

		$course = Courses::find($idCourse);

		$usertype = UserTypes::find(Input::get('usertype'));

		$participant = ORGParticipants::find(Input::get('participante'));

		if($participant->participant == null):

			$user = new User();
			$user->name = $participant->nome;
			$user->email = $participant->email;
			$user->type = 'participant';
			$user->save();

			$new_participant = new Participants();
			$new_participant->participant = $participant->id_participante;
			$new_participant->user = $user->id;
			$new_participant->name = $participant->nome;
			$new_participant->email = $participant->email;
			$new_participant->cpf = $participant->cpf;
			$new_participant->type = 'participant';
			$new_participant->status = 'publish';
			$new_participant->save();

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $user->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		else:

			$this_participant = $participant->participant;

			if($this_participant->user == null):

				$user = new User();
				$user->name = $participant->nome;
				$user->email = $participant->email;
				$user->type = 'participant';
				$user->save();

				$this_participant->user = $user->id;
				$this_participant->save();

			endif;

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $this_participant->user;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		endif;

		return Redirect::to(self::parseRoute($idCourse));

	}

	public function getAddassociate($idCourse){

		$course = Courses::find($idCourse);

		$args = array(
			'route' => self::parseRoute($idCourse),
			'course' => $course,
			'usertypes' => $course->usertypes,
			'associates' => ORGAssociates::all()
			);

		return View::make('backend.inscriptions.addassociate')->with($args);

	}

	public function postAddassociate($idCourse){

		// dd(Input::get('usertype'));

		$course = Courses::find($idCourse);

		$usertype = UserTypes::find(Input::get('usertype'));

		$associate = ORGAssociates::find(Input::get('associado'));

		// dd($usertype);

		if($associate->associate == null):

			$user = new User();
			$user->name = $associate->nombre_completo;
			$user->email = $associate->email;
			$user->type = 'associate';
			$user->save();

			$new_associate = new Associates();
			$new_associate->associate = $associate->id_asociado;
			$new_associate->user = $user->id;
			$new_associate->name = $associate->nombre_completo;
			$new_associate->email = $associate->email;
			$new_associate->password = $associate->senha;
			$new_associate->cpf = $associate->cpf;
			$new_associate->type = 'associate';
			$new_associate->save();

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $user->id;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		else:

			$this_associate = $associate->associate;

			if($this_associate->user == null):

				$user = new User();
				$user->name = $associate->nombre_completo;
				$user->email = $associate->email;
				$user->type = 'associate';
				$user->save();

				$this_associate->user = $user->id;
				$this_associate->save();

			endif;

			$inscription = new Inscriptions();
			$inscription->id_course = $course->id;
			$inscription->id_user = $this_associate->user;
			$inscription->id_usertype = $usertype->id;
			$inscription->save();

		endif;

		return Redirect::to(self::parseRoute($idCourse));

	}

	public static function parseRoute( $idCourse ){

		return str_replace('{idCourse}', $idCourse, self::$route );

	}

	public function getExportinscriptions($idCourse){
		$course = Courses::find($idCourse);

		$inscriptions = $course->inscriptions;

		    // foreach($inscriptions as $inscription):
		    // 	// $total["name"] = $inscription->user->name;
		    // 	// $total["email"] = $inscription->user->email;
		    // 	// $total["paid"] = $inscription->paid;
		    // 	// $total["date"] = date_format(date_create($inscription->created_at), 'd-m-Y');
		    // 	// $total["type"] = $inscription->usertype->title;
		    // 	$total= ["nome" => $inscription->user->name,
		    // 			 "email" => $inscription->user->email,
		    // 			 "paid" => $inscription->paid,
		    // 			 "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
		    // 			 "type" => $inscription->usertype->title
		    // 			 ];
		    // 	// break;
		    // 	// array_push($total,$inscription->user->name,$inscription->user->email);
		    // endforeach;
		        // dd($inscriptions);

		Excel::create('Export Inscriptions '. $course->title ."-". rand(2, 700*date("H"))."-".date("d-m-Y"), function($excel) use ($inscriptions){

		    $excel->sheet('Excel sheet', function($sheet) use ($inscriptions){
				
		        $sheet->setOrientation('portrait');
		    $n=2;
		    $sheet->appendRow(1,array("Nome","Email","Pagamento", "Fecha", "User Type" ));
			// $inscriptions = $inscriptions;
			foreach($inscriptions as $inscription):
		    	// $total["name"] = $inscription->user->name;
		    	// $total["email"] = $inscription->user->email;
		    	// $total["paid"] = $inscription->paid;
		    	// $total["date"] = date_format(date_create($inscription->created_at), 'd-m-Y');
		    	// $total["type"] = $inscription->usertype->title;
		    	if($inscription->paid == 0):
		    		$paid="Não";
		    	else:
		    		$paid="Sim";
		    	endif;
		    	$total= ["nome" => $inscription->user->name,
		    			 "email" => $inscription->user->email,
		    			 "paid" => $paid,
		    			 "date" => date_format(date_create($inscription->created_at), 'd-m-Y'),
		    			 "type" => $inscription->usertype->title
		    			 ];
		        	$sheet->appendRow($n,$total);

		    	// break;
		        	$n++;
		    	// array_push($total,$inscription->user->name,$inscription->user->email);
		    endforeach;

		    });

		})->export('xlsx');
		// Excel::create('Export Inscriptions '. $course->title ."-". rand(2, 700*date("H"))."-".date("d-m-Y"), function($excel) use ($total){

		//     $excel->sheet('Excel sheet', function($sheet) use ($total){
				
		//         $sheet->setOrientation('portrait');
		//         	// dd($total);
		//         	$sheet->fromArray($total, null, 'A1', true);

		//     });

		// })->export('xlsx');
	}

}