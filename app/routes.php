<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


if(Auth::check()):
	Route::controller('/dashboard/courses', 'CourseController');
	Route::controller('/dashboard/categories', 'CategoryController');
	Route::controller('/dashboard/companies', 'CompanyController');
	Route::controller('/dashboard/promotioners', 'PromotionerController');
	Route::controller('/dashboard/supporters', 'SupporterController');
	Route::controller('/dashboard/teachers', 'TeacherController');
	Route::controller('/dashboard/', 'DashboardController');
	Route::controller('/', 'FrontendController');
// else:
endif;
	Route::controller('/dashboard', 'DashboardController');

	// Route::get('/dashboard/', function(){
	// 	return Redirect::to('/');
	// });
	Route::controller('/', 'FrontendController');



// Route::get('/', function(){
// 	$course = Courses::find(1);

// 	$teachers = $course->teachers;
// 	$promotioners = $course->promotioners;
// 	$supporters = $course->supporters;
// 	//var_dump($promotioners);
// 	foreach($teachers as $teacher):
// 		var_dump($teacher->firstName);
// 	endforeach;
	
// 	foreach($supporters as $supporter):
// 		var_dump($supporter->title);
// 	endforeach;

// 	foreach($promotioners as $promotioner):
// 		var_dump($promotioner->title);
// 	endforeach;

// 	var_dump($course->company->title);
// 	var_dump($course->category->title);

// 	//var_dump($course->category->title);
// 	//var_dump($course->category->title);
// 	//var_dump($course->category->title);
// 	//
// //	dd($course->teachers);
// });