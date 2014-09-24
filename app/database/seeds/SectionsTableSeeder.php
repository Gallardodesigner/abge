<?php

class SectionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sections')->delete();

        $section = array(
            'title' => Lang::get('display.teachers'),
            'description' => '',
        	'file' => false,
        	'status' => 'publish',
        	'type' => 'teachers'
        	);

        Sections::create( $section );

        $section = array(
            'title' => Lang::get('display.promotioners'),
            'description' => '',
        	'file' => false,
        	'status' => 'publish',
        	'type' => 'promotioners'
        	);

        Sections::create( $section );

        $section = array(
            'title' => Lang::get('display.supporters'),
            'description' => '',
        	'file' => false,
        	'status' => 'publish',
        	'type' => 'supporters'
        	);

        Sections::create( $section );

    }

}