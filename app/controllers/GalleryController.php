<?php

class GalleryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /gallery
	 *
	 * @return Response
	 */

	protected $route = '/dashboard/album';

	public function getIndex(){

		$arquivos = SFAlbum::all();
		// $arquivos = SFArquivos::where('category','=','1')->get();

		$args = array(
			'route' => $this->route,
			'arquivos' => $arquivos
			);

		return View::make('backend.gallery.index')->with($args);

	}
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /gallery/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /gallery
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /gallery/{id}
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
	 * GET /gallery/{id}/edit
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
	 * PUT /gallery/{id}
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
	 * DELETE /gallery/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}