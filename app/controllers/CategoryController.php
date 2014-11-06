<?php

class CategoryController extends \BaseController {

	protected $route = '/dashboard/categories';

	public function getIndex(){

		$categories = Categories::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.categories.index', array(
			'categories' => $categories,
			'route' => $this->route,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.categories.create');

	}

	public function postCreate(){

		$category = new Categories();
		$category->title = Input::get('title');
		$category->content = Input::get('content');
		$category->type = 'category';
		$category->status = 'draft';
		
		if($category->save()):

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.categories_create', array( 'title' => $category->title )));

		else:

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_create_err', array( 'title' => $category->title )));

		endif;
	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$category = Categories::find($id);

			if(!$category):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_display_err'));

			else:

				return View::make('backend.categories.update', array('category' => $category));

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$category = Categories::find($id);

			if(!$category):

				return Redirect::to($this->route);

			else:

				$category->title = Input::get('title');
				$category->content = Input::get('content');

				if($category->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.categories_update', array( 'title' => $category->title )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_update_err', array( 'title' => $category->title )));

				endif;

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_display_err'));
		
		else:

			$category = Categories::find($id);

			$publish = Categories::publish($id);

			if(!$publish):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_publish_err', array( 'title' => $category->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.categories_publish', array( 'title' => $category->title )));

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_display_err'));
		
		else:

			$category = Categories::find($id);

			$draft = Categories::draft($id);

			if(!$draft):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_draft_err', array( 'title' => $category->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.categories_draft', array( 'title' => $category->title )));

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			$categories = Categories::getTrash();

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.categories.trash', array(
				'categories' => $categories,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));
		
		else:

			$category = Categories::find($id);

			$trash = Categories::trash($id);

			if(!$trash):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_trash_err', array( 'title' => $category->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.categories_trash', array( 'title' => $category->title )));

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_display_err'));
		
		else:

			$category = Categories::find($id);

			$draft = Categories::draft($id);

			if(!$draft):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.categories_untrash_err', array( 'title' => $category->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.categories_untrash', array( 'title' => $category->title )));

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.categories_display_err'));

		else:

			$category = Categories::find($id);

			$delete = Categories::destroy($id);

			if(!$delete):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.categories_delete_err', array( 'title' => $category->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.categories_delete', array( 'title' => $category->title )));

			endif;

		endif;

	}

}
