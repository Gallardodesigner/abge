<?php 
public function postAdd(){
		$image = Input::file('file');
		#$idAlbum = 1;
		$idAlbum = Input::get('idAlbum');
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
			$width=array("200","410",$info_image[0]);
			// $height=array("140","280",$info_image[1]);
			foreach ($width as $ancho) {
				$newheight = round($ancho / $ratio);
			}
			$ext=explode(".",$image->getClientOriginalName());
			$ext = strtolower($ext[count($ext) - 1]);
			$filename = str_replace('/', '!', Hash::make($image->getClientOriginalName().date('Y-m-d H:i:s'))).".".$ext;
			$nombres=["small_".$filename,"medium_".$filename,$filename];
			for ($i=0; $i <count($width) ; $i++) { 
				$path = public_path("uploads/".$nombres[$i]);
				Image::make($image->getRealPath())->resize($width[$i],null,function ($constraint) {$constraint->aspectRatio();})->save($path);
			}
			// Image::make($image->getRealPath())->resize($width[1],$height[1])->save($path);
			// Image::make($image->getRealPath())->resize($width[2],$height[2])->save($path);
			// $image->move("uploads",$filename);

			$gallery = new Gallery();
			$gallery->description = "/uploads/".$filename;
			$gallery->idAlbum = $idAlbum;
			$gallery->save();

			$data = array('error' => false,
				'message' => 'Subida Exitosa',
				'idAlbum' => $idAlbum,
				'url' => $gallery->description
				);
			return $data;
		endif;
		return var_dump($image->getClientOriginalName());
	}