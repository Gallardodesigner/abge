<?php

class SFNews extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'sf_news';

	public $primaryKey  = 'id_news';

	public $timestamps = false;

	public function arquivos(){

		return $this->belongsToMany('SFArquivos', 'sf_news_archivos', 'id_news', 'id_archivo');

	}

	public function hasArquivo( $arquivo ){

		$bool = false;

		foreach( $this->arquivos as $my_arquivo ):
			if($my_arquivo->id_archivo_seccion == $arquivo->id_archivo_seccion ) $bool = true;
		endforeach;

		return $bool;
		
	}

	public function hasVideo( $video ){

		$bool = false;

		foreach( $this->videos as $my_video ):
			if($my_video->id_video == $video->id_video ) $bool = true;
		endforeach;

		return $bool;

	}

	public function videos(){

		return $this->belongsToMany('SFVideos', 'sf_news_video', 'id_news', 'id_video');

	}

}