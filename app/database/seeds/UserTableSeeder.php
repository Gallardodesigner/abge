<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $user = array(
        	'email' => 'robertdacorte@gmail.com',
        	'login' => 'robertdacorte',
        	'password' => Hash::make('18554560'),
        	'type' => 'superadmin',
        	'status' => 'publish',
        	);

        User::create( $user );

        $user = array(
        	'email' => 'amontenegro.sistemas@gmail.com',
        	'login' => 'AlexanderZon',
        	'password' => Hash::make('23498535'),
        	'type' => 'superadmin',
        	'status' => 'publish',
        	);

        User::create( $user );

    }

}