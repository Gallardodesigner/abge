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

/*
if(Auth::check()):
	Route::controller('/dashboard/courses', 'CourseController');
	Route::controller('/dashboard/categories', 'CategoryController');
	Route::controller('/dashboard/companies', 'CompanyController');
	Route::controller('/dashboard/promotioners', 'PromotionerController');
	Route::controller('/dashboard/supporters', 'SupporterController');
	Route::controller('/dashboard/teachers', 'TeacherController');
	Route::controller('/dashboard/', 'DashboardController');
	Route::controller('/', 'FrontendController');
else:
	Route::get('/dashboard/', function(){
		return Redirect::to('/');
	});
	Route::controller('/', 'FrontendController');
endif;

*/

Route::get('/', function(){
	$course = Courses::find(1);

	$teachers = $course->teachers;
	//echo $teachers[0]->firstName;
	//echo $teachers[1]->firstName;
	//echo $teachers[2]->firstName;
	foreach($teachers as $teacher):
		var_dump($teacher->firstName);
	endforeach;
	
//	dd($course->teachers);
});