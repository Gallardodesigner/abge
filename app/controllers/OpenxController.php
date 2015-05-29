<?php

class OpenxController extends \BaseController {

	public static $images_folder = '/uploads/openx/images/';

	public static $unknown = array(
		'04f6eec5eef184a35daa95802b0bc441.jpg',
		'80b0d32fee8f4cbdd39652291369eab1.jpg',
		);

	public static $socios = array(
		'019fb00277497e8181343b528856649b.gif',
		'10d8b27e7f8522b6f89002868744c632.jpg',
		'2f4264f32a7ad32cfc82b4fc099fd516.jpg',
		'3499ab1990eaa4d96fd7b3ce5a1e17d4.jpg',
		'53ccfe3097efb1352d25d20d739d0040.jpg',
		'57e0fe9c155d2b956127d1a61792d4bd.jpg',
		'59f1908abc0bc25386f0725321c53a3a.jpg',
		'6fa05e54e4060ba6bd0cd868bd8529c0.jpg',
		'7064396e002cb8a317a0d15b17ea75b1.jpg',
		'717c09dfcb589ef18a3adb9600a5fa65.jpg',
		'7db6a6f0362e7036420db689a20ac450.jpg',
		'82cb2b507f09368f745410c36a01fd4f.jpg',
		'853af4ba6a8dae0f810280ee2641070b.jpg',
		'8963cf7fdbb83d93e8d21c420e21a107.jpg',
		'944d0d133146521f4e8dbf8c4d01749b.jpg',
		'94f60a0201d6feca44cf0e2dcd582b08.jpg',
		'977ffddc75ed7d40fcb9eaa117ffaf6c.jpg',
		'b445dba30e4ed9bbebd99d54db98483e.jpg',
		'bc92486778d31034fb8ee1dcd61bd130.jpg',
		'c443b5f398d6da3c9d6e5e78c7006ed9.jpg',
		'c4a3bbeffb326cf53fbca583014aa509.jpg',
		'c96e9f8928031d76ac23d959d5fa3d48.gif',
		'f33b17acf90f66781fc1f51548bfde35.png',
		'f74ad60f8431575a8e270a709dfcd0c3.jpg',
		'ff21b9fa5a2389627857a5d15f813383.jpg',
		'ff946cd18fa2fab6b2e758fd3af60092.jpg'
		);

	public static $eventos = array(
		'0a9387480bb01e4abb6432b3f9ebb24a.jpg',
		'32a57bd77918e7914a9ef5d566598e66.gif',
		);

	public static $parceiros = array(
		'3e54bee387b9abd3dcfee65637e71cba.jpg',
		'40b321a091c778d7363714f427f6da3a.jpg',
		'd65cf64e3512f17fd55e4ed724bf4042.jpg'
		);

	public function getNewsletter(){

		$all_newsletters = new ORGNewsletter();

		foreach($all_newsletters as $old_newsletter):
			$newsletter = new Newsleter();
			$newsletter->email = $old_newsletter->email;
			$newsletter->name = $old_newsletter->nombre;
		endforeach;

	}

	public static function getSocios(){

		$pos = rand(0, count(self::$socios)-1);
		return '<img src="'.self::$images_folder.self::$socios[$pos].'"/>';

	}

	public static function getParceiros(){

		$pos = rand(0, count(self::$parceiros)-1);
		return '<img src="'.self::$images_folder.self::$parceiros[$pos].'"/>';

	}

	public static function getEventos(){

		$pos = rand(0, count(self::$eventos)-1);
		return '<img src="'.self::$images_folder.self::$eventos[$pos].'"/>';

	}

}