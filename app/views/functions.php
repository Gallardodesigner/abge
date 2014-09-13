<?php 
public function postAdd(){
		$image = Input::file('url');
		#$idAlbum = 1;
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
			$data = array(
				'error' => true,
				'message' => json_decode($validator->errors())
				);
			return $data;
		else:
			$info_image = getimagesize($image);
			$ratio = $info_image[0] / $info_image[1];
			$newheight=array();
			$width=array("100","200","400",$info_image[0]);

			$ext=explode(".",$image->getClientOriginalName());
			$ext = strtolower($ext[count($ext) - 1]);
			$filename = str_replace('/', '!', Hash::make($image->getClientOriginalName().date('Y-m-d H:i:s'))).".".$ext;
			$nombres=["thumb_".$filename,"small_".$filename,"medium_".$filename,$filename];
			for ($i=0; $i <count($width) ; $i++) { 
				$path = public_path("uploads/".$nombres[$i]);
				Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
			}

			$company = new Companies();
			$company->title = Input::get('title');
			$company->content = Input::get('content');
			$company->address = Input::get('address');
			$company->contact = Input::get('contact');
			$company->url = $filename;
			$company->save();

			$data = array('error' => false,
				'message' => 'Subida Exitosa',
				'idAlbum' => $idAlbum,
				'url' => $company->description
				);
			return $data;
		endif;
		return var_dump($image->getClientOriginalName());
	}