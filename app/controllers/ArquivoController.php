<?php

class ArquivoController extends \BaseController {

	protected $route = '/dashboard/arquivos';

	public function getIndex(){

		$arquivos = SFArquivos::all();
		// $arquivos = SFArquivos::where('category','=','1')->get();

		$args = array(
			'route' => $this->route,
			'arquivos' => $arquivos
			);

		return View::make('backend.arquivos.index')->with($args);

	}

	public function getCreate(){

		$args = array(
			'route' => $this->route,
			);

		return View::make('backend.arquivos.create')->with($args);

	}

	public function postCreate(){

		$archivo = Input::file('archivo');
		$imagen = Input::file('imagen');

		$validator = Validator::make(
			array(
				'archivo' => $archivo,
				'imagen' => $imagen				
				), 
			array(
				'archivo' => 'mimes:png,jpeg,gif,txt,ppt,pdf,doc,xls',
				'imagen' => 'mimes:png,jpeg,gif'
				),
			array(
				'mimes' => 'Tipo de archivo inválido, solo se admite los formatos PNG, JPEG, y GIF'
				)
			);



		if($validator->fails()):

			return Redirect::to($this->route.'/create')->with('msg_err', Lang::get('messages.companies_create_img_err'));

		else:

			$arquivo = new SFArquivos();
			$arquivo->titulo_archivo = Input::get('titulo_archivo');
			$arquivo->id_categoria = Input::get('id_categoria');
			$arquivo->resumem = Input::get('resumem');
			$arquivo->tipo_archivo = Input::get('tipo_archivo');
			$arquivo->fecha = date('Y-m-d');

			if($archivo!=""):
				$url = $archivo->getRealPath();
				$extension = $archivo->getClientOriginalExtension();
				$name = str_replace(' ', '', strtolower(Input::get('titulo_archivo'))).date('YmdHis').rand(2,500*287).'.'.$extension;
				$size  = $archivo->getSize();
				$mime  = $archivo->getMimeType();
				$archivo->move(public_path('uploads/arquivos/'), $name);
				$arquivo->archivo = $name;
			else:
				$arquivo = "";
			endif;

			if($imagen!=""):
				$imagen = $this->uploadHeader($imagen);	
				$arquivo->imagen = $imagen;
			else:
				$imagen = "";	
			endif;

			$arquivo->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $arquivo->title )));

		endif;

	}

	public function getUpdate($id){

		$arquivo = SFArquivos::find($id);

		$args = array(
			'arquivo' => $arquivo,
			'route' => $this->route
			);

		return View::make('backend.arquivos.edit')->with($args);

	}

	public function postUpdate($id){

		$archivo = Input::file('archivo');
		$imagen = Input::file('imagen');

		$validator = Validator::make(
			array(
				'archivo' => $archivo,
				'imagen' => $imagen				
				), 
			array(
				'archivo' => 'mimes:png,jpeg,gif,txt,ppt,pdf,doc,xls',
				'imagen' => 'mimes:png,jpeg,gif'
				),
			array(
				'mimes' => 'Tipo de archivo inválido, solo se admite los formatos PNG, JPEG, y GIF'
				)
			);



		if($validator->fails()):

			return Redirect::to($this->route.'/create')->with('msg_err', Lang::get('messages.companies_create_img_err'));

		else:

			$arquivo = SFArquivos::find($id);
			$arquivo->titulo_archivo = Input::get('titulo_archivo');
			$arquivo->id_categoria = Input::get('id_categoria');
			$arquivo->resumem = Input::get('resumem');
			$arquivo->tipo_archivo = Input::get('tipo_archivo');

			if($archivo!=""):
				$url = $archivo->getRealPath();
				$extension = $archivo->getClientOriginalExtension();
				$name = str_replace(' ', '', strtolower(Input::get('titulo_archivo'))).date('YmdHis').rand(2,500*287).'.'.$extension;
				$size  = $archivo->getSize();
				$mime  = $archivo->getMimeType();
				$archivo->move(public_path('uploads/arquivos/'), $name);
				$arquivo->archivo = $name;
			endif;

			if($imagen!=""):
				$imagen = $this->uploadHeader($imagen);	
				$arquivo->imagen = $imagen;	
			endif;

			$arquivo->save();

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.companies_create', array( 'title' => $arquivo->title )));

		endif;
	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.arquivos_display_err'));

		else:

			$arquivo = SFArquivos::find($id);

			$delete = SFArquivos::destroy($id);

			if(!$delete):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.arquivos_delete_err', array( 'title' => $arquivo->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.arquivos_delete', array( 'title' => $arquivo->title )));

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

			$path = public_path('uploads/arquivos/images/'.$names[$i].$filename);
			// Image::make($image->getRealPath())->resize($width[$i],$height[$i],function ($constraint) {$constraint->aspectRatio();})->save($path);
			Image::make($image->getRealPath())->resize($width[$i],$height[$i])->save($path);
		
		endfor;

		return $filename;
		
	}

}