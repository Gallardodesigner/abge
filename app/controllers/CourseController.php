<?php

class CourseController extends \BaseController {

	protected $route = '/dashboard/courses';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
		$courses = Courses::getUntrash();
		return View::make("backend.courses.index", array( 'courses' => $courses ) );
		
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getUpdate( $id = '' )
	{
		//
		if( $id == ''):
			return Redirect::to($this->route);
		else:

			$course = Courses::find($id);
		
			if(!$course):
	
				return Redirect::to($this->route);
	
			else:

				return View::make("backend.courses.index", array( 'courses' => $courses ) );
		
			endif;

		endif;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
