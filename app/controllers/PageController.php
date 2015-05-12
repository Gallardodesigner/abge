<?php

class PageController extends \BaseController {

	protected $position = 0;

	protected $json = array();

	protected $route = '/dashboard/pages';

	public function getIndex(){

		$pages = Pages::where('id_parent','!=',-1)->orderBy('title','ASC')->get();

		foreach ($pages as $item):
			# code...
			$item->label = $item->title;
		endforeach;

		$args = array(
			'route' => $this->route,
			'pages' => $pages,
			'json' => json_encode($pages),
			);

		return View::make('backend.pages.index')->with($args);

	}

	public function getOrder(){

		$pages = Pages::where('id_parent','=',0)->orderBy('order','ASC')->get();

		foreach ($pages as $item):
			# code...
			$item->label = $item->title;
		endforeach;

		$args = array(
			'route' => $this->route,
			'pages' => $pages,
			'json' => json_encode($pages),
			);

		return View::make('backend.pages.order')->with($args);

	}

	public function getCreate(){

		$args = array(
			'route' => $this->route,
			);

		return View::make('backend.pages.create')->with($args);

	}

	public function postCreate(){

		$page = new Pages();
		$page->name = Input::get('name');
		$page->title = Input::get('title');
		$page->content = Input::get('content');
		$page->status = Input::get('status');
		$page->url = Input::get('url');
		$page->id_parent = 0;
		$page->order = count(Pages::all());

		$page->save();

		return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $page->title )));

	}

	public function getUpdate($id){

		$page = Pages::find($id);

		$args = array(
			'page' => $page,
			'route' => $this->route
			);

		return View::make('backend.pages.edit')->with($args);

	}

	public function postUpdate($id){

		$page = Pages::find($id);
		$page->name = Input::get('name');
		$page->title = Input::get('title');
		$page->content = Input::get('content');
		$page->status = Input::get('status');
		$page->url = Input::get('url');
		$page->save();

		return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $page->title )));
	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.pages_display_err'));

		else:

			$page = Pages::find($id);

			$delete = Pages::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.pages_delete_err', array( 'title' => $page->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.pages_delete', array( 'title' => $page->title )));

			endif;

		endif;

	}

	public function postOrder(){

		$pages = Pages::all();

		foreach($pages as $page):
			$page->order = count($pages)-1;
			$page->save();
		endforeach;

		foreach(Input::get('data') as $item):
			$this->setOrderPosition($item);
		endforeach;

		return Response::json(Input::get('data'));

	}

	public function flushJSON($item){
		$this->json[]['label'] = $item->title;
		if($item->children){
			$this->json[]['children'] = array();
			foreach($item->children as $subitem):
				$this->flushJSON($subitem);
			endforeach;
		}
	}

	public function setOrderPosition($item, $parent = 0){
		$page = Pages::find($item['id']);
		$page->order = $this->position++;
		$page->id_parent = $parent;
		$page->save();
		if(isset($item['children'])):
			foreach ($item['children'] as $subitem):
				# code...
				$this->setOrderPosition($subitem, $item['id']);
			endforeach;
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

			$path = public_path('uploads/pages/images/'.$names[$i].$filename);
			// Image::make($image->getRealPath())->resize($width[$i],$height[$i],function ($constraint) {$constraint->aspectRatio();})->save($path);
			Image::make($image->getRealPath())->resize($width[$i],$height[$i])->save($path);
		
		endfor;

		return $filename;
		
	}

}