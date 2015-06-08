<?php

class NewsController extends \BaseController {

	protected $route = '/dashboard/news';

	public function getIndex(){

		$news = SFNews::orderBy('date','DESC')->get();
		// $news = SFNews::where('category','=','1')->get();

		$args = array(
			'route' => $this->route,
			'news' => $news
			);

		return View::make('backend.news.index')->with($args);

	}

	public function getCreate(){

		$args = array(
			'route' => $this->route,
			);

		return View::make('backend.news.create')->with($args);

	}

	public function postCreate(){

		$image = Input::file('image');
		$image_principal = Input::file('image_principal');

		$validator = Validator::make(
			array(
				'image' => $image,
				'image_principal' => $image_principal				
				), 
			array(
				'image' => 'mimes:png,jpeg,gif',
				'image_principal' => 'mimes:png,jpeg,gif'
				),
			array(
				'mimes' => 'Tipo de imagen inválido, solo se admite los formatos PNG, JPEG, y GIF'
				)
			);

		if($validator->fails()):

			return Redirect::to($this->route.'/create')->with('msg_err', Lang::get('messages.companies_create_img_err'));

		else:

			if($image!=""):
				$image = $this->uploadHeader($image);
			else:
				$image = $news->image;
			endif;

			if($image_principal!=""):
				$image_principal = $this->uploadHeader($image_principal);
			else:
				$image_principal = $news->image_principal;
			endif;

			$news = new SFNews();
			$news->id_profile = 1;
			$news->status = 1;
			$news->home = 1;
			$news->author = 'ABGE';
			$news->sticky = 0;
			$news->category = Input::get('category');
			$news->title = Input::get('title');
			$news->sub_title = Input::get('sub_title');
			$news->home_title = Input::get('home_title');
			$news->summary = Input::get('summary');
			$news->body = Input::get('body');
			$news->date = date("Y-m-d", strtotime(Input::get('date')));
			$news->permalink = "";
			//$news->permalink = str_replace(" ", "-", strtolower(Input::get('title')));
			$news->author = Input::get('author');
			$news->image = $image;
			$news->image_principal = $image_principal;
			$news->save();

			$news->permalink = $news->id_news.'-'.substr(BaseController::guide_spaces( strtolower(BaseController::remove_accents( $this->title ) ) ), 0, 50 );
			$news->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $news->title )));

		endif;

	}

	public function getUpdate($id){

		$news = SFNews::find($id);

		$args = array(
			'new' => $news,
			'route' => $this->route
			);

		return View::make('backend.news.edit')->with($args);

	}

	public function postUpdate($id){

		$news = SFNews::find($id);

		$image = Input::file('image');
		$image_principal = Input::file('image_principal');

		$validator = Validator::make(
			array(
				'image' => $image,
				'image_principal' => $image_principal				
				), 
			array(
				'image' => 'mimes:png,jpeg,gif',
				'image_principal' => 'mimes:png,jpeg,gif'
				),
			array(
				'mimes' => 'Tipo de imagen inválido, solo se admite los formatos PNG, JPEG, y GIF'
				)
			);

		if($validator->fails()):

			return Redirect::to($this->route.'/create')->with('msg_err', Lang::get('messages.companies_create_img_err'));

		else:

			if($image!=""):
				$image = $this->uploadHeader($image);
			else:
				$image = $news->image;
			endif;

			if($image_principal!=""):
				$image_principal = $this->uploadHeader($image_principal);
			else:
				$image_principal = $news->image_principal;
			endif;

			$news->id_profile = 1;
			$news->status = 1;
			$news->home = 1;
			$news->author = 'ABGE';
			$news->sticky = 0;
			$news->category = Input::get('category');
			$news->title = Input::get('title');
			$news->sub_title = Input::get('sub_title');
			$news->home_title = Input::get('home_title');
			$news->summary = Input::get('summary');
			$news->body = Input::get('body');
			$news->date = date("Y-m-d", strtotime(Input::get('date')));
			$news->author = Input::get('author');
			$news->image = $image;
			$news->image_principal = $image_principal;
			$news->save();

			$news->permalink = $news->id_news.'-'.substr(BaseController::guide_spaces( strtolower(BaseController::remove_accents( $this->title ) ) ), 0, 50 );
			$news->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_edit', array( 'title' => $news->title )));

		endif;
	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.news_display_err'));

		else:

			$new = SFNews::find($id);

			$delete = SFNews::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.news_delete_err', array( 'title' => $new->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.news_delete', array( 'title' => $new->title )));

			endif;

		endif;

	}

	public function getArquivos( $id ){

		$args = array(
			'news' => SFNews::find($id),
			'arquivos' => SFArquivos::all(),
			'route' => $this->route
			);

		return View::make('backend.news.arquivos')->with($args);

	}

	public function postArquivos( $id ){

		$news = SFNews::find($id);

		$news->arquivos()->sync(Input::get('arquivos'));

		return Redirect::to($this->route);
	}

	public function getVideos( $id ){

		$args = array(
			'news' => SFNews::find($id),
			'videos' => SFVideos::all(),
			'route' => $this->route
			);

		return View::make('backend.news.videos')->with($args);

	}

	public function postVideos( $id ){

		$news = SFNews::find($id);

		$news->videos()->sync(Input::get('videos'));

		return Redirect::to($this->route);
		
	}

	public function uploadHeader($image){
		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$height=array("300","300","195","72");
		$width=array("1000","1000","400","96");
		$names = array("banner_","big_","medium_", "small_");
		$name = strtolower(str_replace(".","_",str_replace($image->getClientOriginalExtension(), "", $image->getClientOriginalName())));
		$filename = $name.date('YmdHis').rand(1000,1000*1000);
		if(strlen($filename) > 45 ):
			$filename = substr($filename, 0, 45).".".$image->getClientOriginalExtension();
		else:
			$filename .= ".".$image->getClientOriginalExtension();
		endif;
		for ($i=0; $i <count($width) ; $i++):

			$path = public_path('uploads/news/'.$names[$i].$filename);
			// Image::make($image->getRealPath())->resize($width[$i],$height[$i],function ($constraint) {$constraint->aspectRatio();})->save($path);
			// dd($path);
			Image::make($image->getRealPath())->resize($width[$i],$height[$i])->save($path);
		
		endfor;

		return $filename;
		
	}

}
