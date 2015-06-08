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


	//Route::controller('/dashboard/promotioners', 'PromotionerController');
	//Route::controller('/dashboard/supporters', 'SupporterController');
	//Route::controller('/dashboard/', 'DashboardController');
	//Route::controller('/', 'FrontendController');
	//Route::controller('/auth', 'AuthenticationController');
Route::get('phpinfo', function(){
	echo phpinfo();
});
Route::get('/cbge2015/', function(){
	return View::make('frontend.courses.cbge2015');
});
Route::get('/hashing/{pass}', function( $pass ){
	echo Hash::make($pass);
	echo "<br>";
	echo md5($pass);
});
Route::get('formacoes', function(){
	$formacoes = ORGTrainings::all();
	$json = array();
	foreach($formacoes as $formacao):
		$temp = array(
			'id' => $formacao->id,
			'nome' => $formacao->nome
			);
		$json[] = $temp;
	endforeach;
	return Response::json($json);
});
if(Auth::user()->check() && Auth::user()->user()->type=="superadmin"):
	Route::get("/gd-admin", function(){
		return Redirect::to('/dashboard');
	});
	Route::controller('/ajax', 'AjaxController');
	Route::controller('/dashboard/cartography/{idCartography}/authors', 'CartographyAuthorController');
	Route::controller('/dashboard/cartography/users', 'CartographyUserController');
	Route::controller('/dashboard/cartography', 'CartographyController');
	Route::controller('/dashboard/news', 'NewsController');
	Route::controller('/dashboard/newsletters', 'NewsletterController');
	Route::controller('/dashboard/arquivos', 'ArquivoController');
	Route::controller('/dashboard/pages', 'PageController');
	Route::controller('/dashboard/videos', 'VideoController');
	Route::controller('/dashboard/galleries/{idAlbum}/pictures', 'GalleryController');
	Route::controller('/dashboard/galleries', 'AlbumController');
	Route::controller('/dashboard/annuities/{idAnnuity}/categories/{idCategory}/dates', 'AnnuityDateController');
	Route::controller('/dashboard/annuities/{idAnnuity}/categories/{idCategory}/payments', 'AnnuityCategoryPaymentController');
	Route::controller('/dashboard/annuities/{idAnnuity}/categories', 'AnnuityCategoryController');
	Route::controller('/dashboard/annuities/{idAnnuity}/payments', 'AnnuityPaymentController');
	Route::controller('/dashboard/annuities', 'AnnuityController');
	Route::controller('/dashboard/instructions', 'TicketInstructionController');
	Route::controller('/dashboard/clients/participants', 'ORGParticipantController');
	Route::controller('/dashboard/clients/associates/{idAssociate}/payments', 'ORGAssociatePaymentController');
	Route::controller('/dashboard/clients/associates/{idAssociate}/ticket', 'TicketController');
	Route::controller('/dashboard/clients/associates', 'ORGAssociateController');
	Route::controller('/dashboard/teachers', 'TeacherController');
	Route::controller('/dashboard/sections', 'SectionController');
	Route::controller('/dashboard/companies', 'CompanyController');
	Route::controller('/dashboard/categories', 'CategoryController');
	Route::controller('/dashboard/events', 'EventController');
	Route::controller('/dashboard/banners', 'OpenxController');
	Route::controller('/dashboard/courses/{idCourse}/usertypes/{idUserType}/dates', 'DateController');
	Route::controller('/dashboard/courses/{idCourse}/usertypes', 'UserTypeController');
	Route::controller('/dashboard/courses/{idCourse}/inscriptions/{idInscription}/files', 'FileController');
	Route::controller('/dashboard/courses/{idCourse}/inscriptions', 'InscriptionController');
	Route::controller('/dashboard/courses/{idCourse}/content', 'ContentController');
	Route::controller('/dashboard/courses', 'CourseController');
elseif(Auth::user()->check() && Auth::user()->user()->type=="associate"):
	Route::controller('/ajax', 'FrontendAjaxController');
	Route::controller('/associados', 'FrontendAssociateController');
else:
	Route::controller("/gd-admin","AuthenticationController");
endif;
	Route::get('/logout', function(){
		Auth::user()->logout();
		return Redirect::to("/gd-admin");
	});
	
	Route::controller('/dashboard', 'DashboardController');
	
	Route::get('/associados/{one?}/{two?}/{three?}/{four?}/{five?}', function(){
	 	return Redirect::to('/entrar');
	});
	//Route::controller('/auth', 'AuthenticationController');
	Route::controller('/openx', 'OpenxController');
	Route::controller('/autenticacao', 'AuthenticationController');
	Route::controller('/entrar', 'FrontendAuthenticationController');
	Route::controller('/anuidades', 'FrontendAnnuityController');
	Route::controller('/cursos/{id?}/{content?}/{idContent?}', 'FrontendCourseController');
	Route::controller('/eventos', 'FrontendEventController');
	Route::controller('/page/{name?}', 'FrontendPageController');
	Route::controller('/cartografia', 'FrontendCartographyController');
	Route::controller('/consultores', 'FrontendConsultoresController');
	Route::controller('/galeria', 'FrontendGalleryController');
	Route::controller('/videos', 'FrontendVideoController');
	Route::controller('/noticias', 'FrontendNoticiasController');
	Route::get('/correomasivo','FrontendHomeController@getCorreomasivo');
	Route::controller('/{id}/{content?}/{idContent?}', 'FrontendCourseController');
	Route::controller('/', 'FrontendHomeController');

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

