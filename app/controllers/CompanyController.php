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

		$image = Input::file('url');

		$validator = Validator::make(
			array(
				'image' => $image
				), 
			array(
				'image' => 'required|mimes:png,jpeg,gif'
				),
			array(
				'mimes' => 'Tipo de imagen inválido, solo se admite los formatos PNG, JPEG, y GIF'
				)
			);

		if($validator->fails()):

			return Redirect::to($this->route.'/create')->with('msg_succes', Lang::get('messages.companies_create_img_err'));

		else:

			$filename = $this->uploadImage($image);

			$company = new Companies();
			$company->title = Input::get('title');
			$company->content = Input::get('content');
			$company->address = Input::get('address');
			$company->contact = Input::get('contact');
			$company->type = 'company';
			$company->status = 'draft';
			$company->url = $filename;

			if($company->save()):

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_create_err', array( 'title' => $company->title )));

			endif;

		endif;
	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$company = Companies::find($id);

			if(!$company):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_display_err'));

			else:

				return View::make('backend.companies.update', array('company' => $company));

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

				$filename = $this->uploadImage($image);

				$company = new Companies();
				$company->title = Input::get('title');
				$company->content = Input::get('content');
				$company->address = Input::get('address');
				$company->contact = Input::get('contact');
				$company->type = 'company';
				$company->status = 'draft';

				$image = Input::file('url');

				if($image != null):

					$validator = Validator::make(
						array(
							'image' => $image
							), 
						array(
							'image' => 'required|mimes:png,jpeg,gif'
							),
						array(
							'mimes' => 'Tipo de imagen inválido, solo se admite los formatos PNG, JPEG, y GIF'
							)
						);

					if($validator->fails()):

						return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.companies_update_err', array( 'title' => $company->title )));

					else:

						$company->url = $filename;
					
					endif;

				endif;

				if($company->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.companies_update', array( 'title' => $company->title )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_update_err', array( 'title' => $company->title )));

				endif;

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_display_err'));
		
		else:

			$company = Companies::find($id);

			$publish = Companies::publish($id);

			if(!$publish):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_publish_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_publish', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_display_err'));
		
		else:

			$company = Companies::find($id);

			$draft = Companies::draft($id);

			if(!$draft):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_draft_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_draft', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			$companies = Companies::getTrash();

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.companies.trash', array(
				'companies' => $companies,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));
		
		else:

			$company = Companies::find($id);

			$trash = Companies::trash($id);

			if(!$trash):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_trash_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_trash', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_display_err'));
		
		else:

			$company = Companies::find($id);

			$draft = Companies::draft($id);

			if(!$draft):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.companies_untrash_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.companies_untrash', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.companies_display_err'));

		else:

			$company = Companies::find($id);

			$delete = Companies::destroy($id);

			if(!$delete):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.companies_delete_err', array( 'title' => $company->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.companies_delete', array( 'title' => $company->title )));

			endif;

		endif;

	}

	public function uploadImage($image){

		//dd(storage_path('uploads/'));

		$info_image = getimagesize($image);
		$ratio = $info_image[0] / $info_image[1];
		$newheight=array();
		$width=array("100","200","400",$info_image[0]);
		$filename = "prueba.".$image->getClientOriginalExtension();
		#$filename = str_replace('/', '!', Hash::make($image->getClientOriginalName().date('Y-m-d H:i:s'))).".".$image->getClientOriginalExtension();
		$nombres=["thumb_".$filename,"small_".$filename,"medium_".$filename,$filename];

		for ($i=0; $i <count($width) ; $i++):

			$path = public_path('uploads/'.$nombres[$i]);
			Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
		
		endfor;

		return $filename;
		
	}

}
