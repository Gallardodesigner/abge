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
	public function getCreate()
	{

		$teachers = Teachers::getPublish();
		$categories = Categories::getPublish();
		$events = Events::getPublish();
		$companies = Companies::getPublish();

		$array = array(
			'teachers' => $teachers,
			'categories' => $categories,
			'events' => $events,
			'companies' => $companies,
			'promotioners' => $companies,
			'supporters' => $companies
			);
		//
		$courses = Courses::getUntrash();
		return View::make("backend.courses.create")->with($array);
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		//
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postUpdate( $id = '' )
	{
		//

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getCreatesupporters()
	{
		//
		$courses = Courses::getUntrash();
		return View::make("backend.courses.createsupporters");
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postCreatesupporters()
	{
		//
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getCreatepromotioners()
	{
		//
		$courses = Courses::getUntrash();
		return View::make("backend.courses.createpromotioners");
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postCreatepromotioners()
	{
		//
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getCreateteachers()
	{
		//
		$courses = Courses::getUntrash();
		return View::make("backend.courses.createteachers");
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postCreateteachers()
	{
		//
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getTrash()
	{
		//
		$courses = Courses::getUntrash();
		return View::make("backend.courses.trash");
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postTrash()
	{
		//
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function postDelete()
	{
		//
		
	}


}
