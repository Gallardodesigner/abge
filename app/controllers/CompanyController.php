<?php

class CompanyController extends \BaseController {

	
	protected $route = '/dashboard/companies';

	public function getIndex(){

		$companies = Companies::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.companies.index', array(
			'companies' => $companies,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.companies.create');

	}

	public function postCreate(){

		$company = new Companies();
		$company->title = Input::get('title');
		$company->content = Input::get('content');
		$company->type = 'company';
		$company->status = 'draft';
		$company->save();

		return View::make('backend.companies.index', array('msg_success' => 'The company was successfully created!'));

	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$company = Companies::find($id);

			if(!$company):

				return Redirect::to($this->route);

			else:

				return View::make('backend.companies.update', array('company' = $company));

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$company = Companies::find($id);

			if(!$company):

				return Redirect::to($this->route);

			else:

				$company->title = Input::get('title');
				$company->content = Input::get('content');
				$company->type = 'company';
				$company->status = 'draft';
				$company->save();
				return Redirect::to($this->route);

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read publish without an identification key of companies');
		
		else:

			$company = Companies::publish($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error','Can\'t publish the company');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was published successfully');

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read draft without an identification key of companies');
		
		else:

			$company = Companies::draft($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error','Can\'t draft the company');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was drafted successfully');

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read trash without an identification key of companies');
		
		else:

			$company = Companies::trash($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error','Can\'t trash the company');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was trashed successfully');

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error','Can\'t read untrash without an identification key of companies');
		
		else:

			$company = Companies::draft($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error','Can\'t untrash the company');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was untrashed successfully');

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return View::make('backend.companies.trash');

		else:

			$company = Companies::destroy($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error','Can\'t delete the company');

			else:

				return Redirect::to($this->route)->with('msg_success', 'Category was deleted successfully');

			endif;


	}



}
