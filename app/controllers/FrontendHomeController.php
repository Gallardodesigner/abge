<?php

class FrontendHomeController extends \BaseController {

	public static $route = '/';

	public function getIndex(){

		$courses = Courses::where('status','=','publish')->orderBy('start','DESC')->take(3)->get();
		$banner = SFNews::where('sticky','=','0')->where('category','=','0')->where('status','=','1')->where('home','=','1')->orderBy('date', 'DESC')->take(3)->get();
		$principal = SFNews::where('sticky','=','0')->where('category','=','1')->where('status','=','1')->where('home','=','1')->orderBy('date','DESC')->take(1)->get();
		$news = SFNews::where('status','=','1')->where('home','=','1')->orderBy('date','DESC')->take(3)->get();
		$video = SFVideos::where('position','=','1')->take(1)->get();
		$video = isset($video[0]) ? $video[0] : null;

		$args = array(
			'news' => $news,
			'courses' => $courses,
			'principal' => $principal,
			'banner' => $banner,
			'video' => $video
			);

		return View::make('frontend.home.index')->with($args);
		
	}


	public function getCorreomasivo(){
		 $campos = Input::get('newsletter');
		// dd( "Juan Lopez");

		$correo = new Newsletters();
		$correo->name = $campos["nombre"];
		$correo->email = $campos["email"];
		$correo->save();
		return "Datos guardados con Exito";
		// return $campos;
	}

}