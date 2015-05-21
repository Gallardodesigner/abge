<?php

class FrontendEventController extends \BaseController {

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

	public function getIndex(){

			$event = Events::where('title','=','EVENTOS')->take(1)->get();

			$courses = isset($event[0]) ? $event[0]->getPublishCourses() : null;

			foreach ($courses as $course):
				$course->start = date("d-m-Y", strtotime($course->start));
				$course->end = date("d-m-Y", strtotime($course->end));
			endforeach;

			return View::make('frontend.events.index')->with( array( 'courses' => $courses ) );

	}

}