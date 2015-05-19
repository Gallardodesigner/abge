<?php

class FrontendHomeController extends \BaseController {

	public static $route = '/';

	public function getIndex(){

		$courses = Courses::where('status','=','publish')->orderBy('start','DESC')->take(3)->get();
		$banner = SFNews::where('sticky','=','0')->where('category','=','0')->where('status','=','1')->where('home','=','1')->orderBy('date', 'DESC')->take(3)->get();
		$principal = SFNews::where('sticky','=','0')->where('category','=','1')->where('status','=','1')->where('home','=','1')->orderBy('date','DESC')->take(1)->get();
		$news = SFNews::where('status','=','1')->where('home','=','1')->orderBy('date','DESC')->take(3)->get();

		$args = array(
			'news' => $news,
			'courses' => $courses,
			'principal' => $principal,
			'banner' => $banner
			);

		return View::make('frontend.home.index')->with($args);
		
	}


	public function postCorreomasivo(){
		// $campos = Input::all();
		echo "Juan Lopez";
	}

}