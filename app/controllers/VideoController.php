<?php

class VideoController extends \BaseController {

	protected $route = '/dashboard/videos';

	public function getIndex(){

		$videos = SFVideos::all();
		// $videos = SFVideos::where('category','=','1')->get();

		$args = array(
			'route' => $this->route,
			'videos' => $videos
			);

		return View::make('backend.videos.index')->with($args);

	}

	public function getCreate(){

		$args = array(
			'route' => $this->route,
			);

		return View::make('backend.videos.create')->with($args);

	}

	public function postCreate(){

		$video = new SFVideos();
		$video->titulo_archivo = Input::get('titulo_archivo');
		$video->id_categoria = Input::get('id_categoria');
		$video->resumem = Input::get('resumem');
		$video->tipo_archivo = Input::get('tipo_archivo');
		$video->fecha = date('Y-m-d');

		$video->save();

		return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $video->title )));

	}

	public function getUpdate($id){

		$video = SFVideos::find($id);

		$args = array(
			'video' => $video,
			'route' => $this->route
			);

		return View::make('backend.videos.edit')->with($args);

	}

	public function postUpdate($id){

		$video = SFVideos::find($id);
		$video->titulo_archivo = Input::get('titulo_archivo');
		$video->id_categoria = Input::get('id_categoria');
		$video->resumem = Input::get('resumem');
		$video->tipo_archivo = Input::get('tipo_archivo');

		$video->save();

		return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $video->title )));
	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.videos_display_err'));

		else:

			$video = SFVideos::find($id);

			$delete = SFVideos::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.videos_delete_err', array( 'title' => $video->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.videos_delete', array( 'title' => $video->title )));

			endif;

		endif;

	}

	public function uploadHeader($image){

		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$height=array("300","300","195","72");
		$width=array("1000","1000","400","96");
		$names = array("banner_","big_","medium_", "small_");
		$name = strtolower(str_replace(".","_",str_replace($image->getClientOriginalExtension(), "", $image->getClientOriginalName())));
		$filename = $name.date('YmdHis').rand(1000,1000*1000).".".$image->getClientOriginalExtension();
		$nombres=[$filename];

		for ($i=0; $i <count($width) ; $i++):

			$path = public_path('uploads/videos/images/'.$names[$i].$filename);
			// Image::make($image->getRealPath())->resize($width[$i],$height[$i],function ($constraint) {$constraint->aspectRatio();})->save($path);
			Image::make($image->getRealPath())->resize($width[$i],$height[$i])->save($path);
		
		endfor;

		return $filename;
		
	}
}