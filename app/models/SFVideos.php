<?php

class SFVideos extends \Eloquent {

	protected $connection = 'mysql_2';

	protected $table = 'videos';

	public $primaryKey  = 'id_video';

	public $timestamps = false;

	public function getYoutubeImage(){

		$url = $this->url_video;

		$neddle = 'watch?v=';

		$youtube_image_url = 'http://img.youtube.com/vi/';

		$image_name = '/0.jpg';

		$id_youtube = str_replace($neddle, "", strstr($url, $neddle));

		return $youtube_image_url.$id_youtube.$image_name;

	}

	public function getYoutubeEmbbed(){

		$url = $this->url_video;

		$neddle = 'watch?v=';

		$youtube_embbed_url = 'http://www.youtube.com/v/';

		$id_youtube = str_replace($neddle, "", strstr($url, $neddle));

		return $youtube_embbed_url.$id_youtube;

	}

	public function getBitURI(){

		return $this->id_video.'-'.substr(BaseController::remove_spaces( ucwords(BaseController::remove_accents( $this->titulo_video ) ) ), 0, 7 );

	}
}