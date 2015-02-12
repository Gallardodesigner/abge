<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/
	'fetch' => PDO::FETCH_CLASS,


	'default' => 'mysql',

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'abge',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
		
		'mysql_2' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'abge13',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
		
		// 'mysql' => array(
		// 	'driver'    => 'mysql',
		// 	'host'      => 'localhost',
		// 	'database'  => 'abge',
		// 	'username'  => 'root',
		// 	'password'  => '',
		// 	'charset'   => 'utf8',
		// 	'collation' => 'utf8_unicode_ci',
		// 	'prefix'    => '',
		// ),
		
		// 'mysql_2' => array(
		// 	'driver'    => 'mysql',
		// 	'host'      => 'localhost',
		// 	'database'  => 'abge13',
		// 	'username'  => 'root',
		// 	'password'  => '',
		// 	'charset'   => 'utf8',
		// 	'collation' => 'utf8_unicode_ci',
		// 	'prefix'    => '',
		// ),



		/*'mysql' => array(
			'driver'    => 'mysql',
			'host'      => '186.202.152.19',
			'database'  => 'abge',
			'username'  => 'abge',
			'password'  => 'egba4102',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
		

		'mysql_2' => array(
			'driver'    => 'mysql',
			'host'      => '186.202.152.54',
			'database'  => 'abge13',
			'username'  => 'abge13',
			'password'  => 'Abge3280743',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),*/

		'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'homestead',
			'username' => 'homestead',
			'password' => 'secret',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),

	),
	'migrations' => 'migrations',
	

);
