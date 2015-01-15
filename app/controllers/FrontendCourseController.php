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

			$course = Courses::findRoute($route);

			if($course):

				$course->start = date("d-m-Y", strtotime($course->start));
				$course->end = date("d-m-Y", strtotime($course->end));

				switch($content){

					case '':
						return self::getCourseContent( $route, $course, $idContent );
						break;
					case 'conteudo':
						return self::getCourseContent( $route, $course, $idContent );
						break;
						/*
					case 'inscricoes':
						return self::getCourseInscription( $route, $course, $idContent );
						break;
					case 'trabalhos':
						return self::getCourseWorks( $route, $course, $idContent );
						break;
						*/
					case 'acesso':
						return self::getCourseSignin( $route, $course, $idContent );
						break;
					case 'arquivos':
						return self::getCourseFiles( $route, $course, $idContent );
						break;
					case 'trabalhosactualizacao':
						return self::getCourseFilesUploaded( $route, $course, $idContent );
						break;
					case 'pagamento':
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

		$course = Courses::findRoute($route);
	
		$course->start = date("d-m-Y", strtotime($course->start));
		$course->end = date("d-m-Y", strtotime($course->end));

		if($course):

			switch($content){
				case 'arquivos':
					return self::postCourseFiles( $course->id, $course, $idContent );
					break;
			}

		else:

			return View::make('specialpages.404');

		endif;

	}

	public static function getCourseContent( $id, $course, $idContent ){

		$contents = self::getOrderedContent($course->coursesections);

		// dd($contents);

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
				case 'inscriptions':
					return View::make('frontend.courses.inscription')->with( $array );
					break;
				case 'works':
					return View::make('frontend.courses.works')->with( $array );
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

			$array['section'] = $contents[0];

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

			return Redirect::to($course->id.'/files')->with( $array );

		else:*/

			return Redirect::to($course->route.'/pagamento')->with( $array );
/*
		endif;
*/
	}

	public static function getCourseFiles( $id, $course, $idContent ){

		$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);

		$array = array( 
			'course' => $course, 
			'contents' => self::getOrderedContent($course->coursesections) ,
			'files' => $inscription->listedFiles(),
			);

		return View::make('frontend.courses.files')->with( $array );

	}

	public static function getCourseFilesUploaded( $id, $course, $idContent ){

		$array = array(
			'course' => $course, 
			'contents' => self::getOrderedContent($course->coursesections) 
			);

		return View::make('frontend.courses.filesupload')->with( $array );

	}

	public static function positionNulled( $list ){

		$postitions = array();

		for( $i = 0 ; $i < 100 ; $i++ ):
			if(!isset($list[$i]) or $list[$i] == null):
				$positions[] = $i;
			endif;
		endfor;

		return $positions;

	}

	public static function postCourseFiles( $id, $course, $idContent ){

		$titles = Input::get('titles');

		$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
		$filenumber = count($inscription->files);
		$listedFiles = $inscription->listedFiles();
		$positions = self::positionNulled($listedFiles);

		$count = 0;
		$listedCounter = 0;

		/*if($filenumber<=0):
			$filenumber = 0;
			$counttitle = -1;
		elseif($filenumber<=2):
			$counttitle = 0;
		elseif($filenumber <=4):
			$counttitle = 1;
		else:
			$counttitle = 2;
		endif;*/

		/*var_dump(Input::file('files'));
		var_dump($filenumber.' - '.$counttitle );*/
		
		if(Input::file('files')!= null):
			foreach(Input::file('files') as $file):
				
				// var_dump("File: ".$count);
				if ($file != null):

					// $counttitle = null;
					// $position = null;
					/*var_dump('count: '.$count);
					if(count($listedFiles) > $filenumber ):
						var_dump('listedFiles '.count($listedFiles).' > '.$filenumber.' filenumber');
						$temp = -1;
						for($i = 0 ; $i <= count($listedFiles) ; $i++):
							var_dump("FOR i: ".$i.' to '.(count($listedFiles)-1));
							if($listedFiles[$i] == null):
								$temp++;
								var_dump(" - IF1 temp: ".$temp.' and listedCounter: '.$listedCounter);
								if($listedCounter==$temp):
									var_dump(" - - IF2 :O listedCounter ".$listedCounter.' == '. $temp.' temp');
									$position = $i;
								endif;
							endif;
						endfor;
					else:
						$position = $filenumber;
					endif;*/



					// var_dump('position: '.$positions[$count]);

					/*for($i = 0 ; $i <= $count ; $i++):
						if($i==$count):
							if($listedFiles[$i] == null ):
								$filenumber = $count;
							endif;
							$filenumber = $count;
						endif;
					endfor;*/

					switch($positions[$count]){
						case 0:
						case 1:
							$counttitle = 0;
							break;
						case 2:
						case 3:
							$counttitle = 1;
							break;
						case 4:
						case 5:
							$counttitle = 2;
							break;
						default:
							$counttitle = 2;
							break;
						}

					// var_dump($file);
					//dd($filenumber.' - '.$counttitle);
					$url = $file->getRealPath();
					$extension = $file->getClientOriginalExtension();
					// str_replace(' ', '',str_replace('/', '-', strtolower($titles[$counttitle])))
					$name = str_replace(' ', '', strtolower(Auth::user()->id)).'-'.($positions[$count]+1).'-'.date('YmdHis').rand(2,1024*512).'.'.$extension;
					$size  = $file->getSize();
					$mime  = $file->getMimeType();
					$file->move(public_path('uploads/files/'), $name);
					$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
					$my_file = new Files();
					$my_file->title = $titles[$counttitle] . ' - ' . ($positions[$count]+1);
					$my_file->id_course = $course->id;
					$my_file->id_user = Auth::user()->id;
					$my_file->id_inscription = $inscription->id;
					$my_file->url = '/uploads/files/'.$name;
					$my_file->size = $size;
					$my_file->mime = $mime;
					$my_file->status = 'draft';
					$my_file->save();
					// var_dump($my_file);
				endif;
				
				$count++;
				$listedCounter++;

			endforeach;
		endif;
		// dd($listedFiles);
		$array = array( 'course' => $course, 'contents' => self::getOrderedContent($course->coursesections) );

		return Redirect::to($course->route.'/trabalhosactualizacao')->with( $array );

	}

	public static function getCoursePayment( $id, $course, $idContent ){

		if(count($course->inscriptions) > $course->min ):
			$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
			$button = '';
			$message = '';
			foreach($inscription->usertype->dates as $date):
				$datetime1 = date_create($date->start);
				$datetime2 = date_create(date('Y-m-d'));
				$datetime3 = date_create($date->end);
				$interval1 = date_diff($datetime1, $datetime2);
				$interval2 = date_diff($datetime3, $datetime2);
				if(($interval1->format('%R') == '+') AND ($interval2->format('%R') == '-')):
					$button = $date->button;
					$message = $date->message;
				endif;	
			endforeach;
		elseif(count($course->inscriptions) >= $course->max ):
			$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
			$button = '';
			$message = $course->max_message;
		else:
			$inscription = Inscriptions::hasInscription(Auth::user()->id, $course->id);
			$button = '';
			$message = $course->min_message;
		endif;

		$array = array( 'button' => $button, 'message' => $message,'course' => $course,'contents' => self::getOrderedContent($course->coursesections) );

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