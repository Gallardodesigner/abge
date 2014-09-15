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
/*
		Validator::make(
			array(
				'title' => Input::get('title'),
				'description' => Input::get('description'),
				'content' => Input::get('content'),
				'program' => Input::get('program'),
				'address' => Input::get('address'),
				'company_id' => Input::get('company_id'),
				'event_id' => Input::get('event_id'),
				'category_id' => Input::get('category_id'),
				'start' => date("Y-m-d", Input::get('start')),
				'end' => date("Y-m-d", Input::get('end'))
				),
			array(
				'title' => 'required',
				'description' => 'required',
				'content' => 'required',
				'program' => 'required',
				'address' => 'required',
				'company_id' => 'required|integer',
				'event_id' => 'required|integer',
				'category_id' => 'required|integer',
				'start' => 'required|date',
				'end' => 'required|date',
				)
			);
			*/
		$course = new Courses();
		$course->title = Input::get('title');
		$course->content = Input::get('content');
		$course->description = Input::get('description');
		$course->program = Input::get('program');
		$course->address = Input::get('address');
		$course->company_id = Input::get('company_id');
		$course->event_id = Input::get('event_id');
		$course->category_id = Input::get('category_id');
		$course->start = Input::get('start');
		$course->end = Input::get('end');
		$course->save();

		Redirect::to($this->route);
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
