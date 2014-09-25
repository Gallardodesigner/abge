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
        	'type' => 'teachers',
            'order' => 1
        	);

        Sections::create( $section );

        $section = array(
            'title' => Lang::get('display.promotioners'),
            'description' => '',
        	'file' => false,
        	'status' => 'publish',
        	'type' => 'promotioners',
            'order' => 2
        	);

        Sections::create( $section );

        $section = array(
            'title' => Lang::get('display.supporters'),
            'description' => '',
        	'file' => false,
        	'status' => 'publish',
        	'type' => 'supporters',
            'order' => 3
        	);

        Sections::create( $section );

    }

}