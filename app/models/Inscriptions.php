<?php

class Inscriptions extends Eloquent {

	public function course(){
		return $this->belongsTo('Courses', 'id_course');
	}

	public function usertype(){
		return $this->belongsTo('UserTypes', 'id_usertype');
	}

	public function user(){
		return $this->belongsTo('User', 'id_user');
	}

	public function files(){

		return $this->hasMany('Files', 'id_inscription', 'id')->orderBy('created_at','ASC');

	}

	public function listedFiles(){
		$files = Files::where( 'id_inscription', '=', $this->id )->orderBy('created_at', 'asc')->get();
		// dd($files);
		/*$files = $this->hasMany('Files', 'id_inscription', 'id')->orderBy('created_at','ASC');*/

		$archivitos=array();
		// dd(substr($files[0]->title, -1));
		// dd(count($files));
		for($i=0,$counter = 1;$i < count($files); ):
			
			$band = false;
			$position = null;

			for($j=0;$j < count($files); $j++):

				if(substr($files[$j]->title, -1) == $counter):

					// var_dump(substr($files[$j]->title, -1));
					$band=true;
					$position = $j;

				endif;

			endfor;

			if($band):
				$archivitos[] = $files[$position];
				$i++;
			else:
				// var_dump(null."Aqui");
				$archivitos[] = null;
			endif;

			/*if(substr($files[$i]->title, -1) == $counter+1):
				var_dump(substr($files[$i]->title, -1));
				$archivitos[] = $files[$i];
				$i++;
			else:
				var_dump('No');
				$archivitos[] = null;
			endif;*/

			$counter++;

		endfor;

		// dd(new Illuminate\Database\Eloquent\Collection($archivitos));

		return new Illuminate\Database\Eloquent\Collection($archivitos);
	}

	public static function hasInscription( $idUser, $idCourse ){

		$has = self::where( 'id_course', '=', $idCourse )->where('id_user', '=', $idUser )->orderBy('created_at', 'desc')->take(1)->get();

		if(count($has) > 0): 

			return $has[0];

		else:

			return false;

		endif;

	}

}