<?php

class TicketInstructionController extends \BaseController {

	public static $route = '/dashboard/instructions';

	public function getIndex(){

		$args = array(
			'categories' => ORGAssociateCategories::all(),
			'route' => self::$route,
			);

		return View::make('backend.instructions.index')->with( $args );

	}

	public function getUpdate( $id ){

		$category = ORGAssociateCategories::find($id);

		$args = array(
			'category' => $category,
			'instruction' => $category->instruction,
			'route' => self::$route
			);

		return View::make('backend.instructions.update')->with( $args );

	}

	public function postUpdate( $id ){

		$category = ORGAssociateCategories::find($id);

		$category->instruction->linea_1 = Input::get('linea_1');
		$category->instruction->linea_2 = Input::get('linea_2');
		$category->instruction->linea_3 = Input::get('linea_3');
		// $category->instruction->linea_1 = Input::get('linea_1');
		$category->instruction->save();

		$args = array(
			'category' => $category,
			'instruction' => $category->instruction,
			'route' => self::$route
			);

		return View::make('backend.instructions.update')->with( $args );

	}

}