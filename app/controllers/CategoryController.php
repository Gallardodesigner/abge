<?php

class CategoryController extends \BaseController {

	protected $route = '/dashboard/categories';

	public function getIndex(){

		$categories = Categories::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.categories.index', array(
			'categories' => $categories,
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
		$category->save();

		return View::make('backend.categories.index', array('msg_success' => 'The category was successfully created!'));

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$category = Categories::find($id);

			if(!$category):

				return Redirect::to($this->route);

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
				$category->type = 'category';
				$category->status = 'draft';
				$category->save();
				return Redirect::to($this->route);

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read publish without an identification key of categories');
		
		else:

			$category = Categories::publish($id);

			if(!$category):

				return Redirect::to($this->route)->with('msg_error','Can\'t publish the category');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was published successfully');

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read draft without an identification key of categories');
		
		else:

			$category = Categories::draft($id);

			if(!$category):

				return Redirect::to($this->route)->with('msg_error','Can\'t draft the category');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was drafted successfully');

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read trash without an identification key of categories');
		
		else:

			$category = Categories::trash($id);

			if(!$category):

				return Redirect::to($this->route)->with('msg_error','Can\'t trash the category');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was trashed successfully');

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read untrash without an identification key of categories');
		
		else:

			$category = Categories::draft($id);

			if(!$category):

				return Redirect::to($this->route)->with('msg_error','Can\'t untrash the category');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was untrashed successfully');

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return View::make('backend.categories.trash');

		else:

			$category = Categories::destroy($id);

			if(!$category):

				return Redirect::to($this->route)->with('msg_error','Can\'t delete the category');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was deleted successfully');

			endif;

		endif;

	}

}
