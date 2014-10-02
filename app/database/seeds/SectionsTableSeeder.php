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

        $section = array(
            'title' => Lang::get('display.inscriptions'),
            'description' => '',
            'file' => false,
            'status' => 'publish',
            'type' => 'inscriptions',
            'order' => 4
            );

        Sections::create( $section );

        $section = array(
            'title' => Lang::get('display.works'),
            'description' => '',
            'file' => false,
            'status' => 'publish',
            'type' => 'works',
            'order' => 5
            );

        Sections::create( $section );

    }

}