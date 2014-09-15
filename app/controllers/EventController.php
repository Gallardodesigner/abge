<?php

class EventController extends \BaseController {

	protected $route = '/dashboard/events';

	public function getIndex(){

		$events = Events::getUntrash();

		$msg_success = Session::get('msg_success');

		$msg_error = Session::get('msg_error');

		return View::make('backend.events.index', array(
			'events' => $events,
			'msg_success' => $msg_success,
			'msg_error' => $msg_error
			));

	}

	public function getCreate(){

		return View::make('backend.events.create');

	}

	public function postCreate(){

		$event = new Events();
		$event->title = Input::get('title');
		$event->content = Input::get('content');
		$event->type = 'event';
		$event->status = 'draft';
		
		if($event->save()):

			return Redirect::to($this->route)->with('msg_success', Lang::get('messages.events_create', array( 'title' => $event->title )));

		else:

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_create_err', array( 'title' => $event->title )));

		endif;
	}

	public function getUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$event = Events::find($id);

			if(!$event):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_display_err'));

			else:

				return View::make('backend.events.update', array('event' => $event));

			endif;

		endif;

	}

	public function postUpdate( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route);
		
		else:

			$event = Events::find($id);

			if(!$event):

				return Redirect::to($this->route);

			else:

				$event->title = Input::get('title');
				$event->content = Input::get('content');

				if($event->save()):

					return Redirect::to($this->route)->with('msg_succes', Lang::get('messages.events_update', array( 'title' => $event->title )));

				else:

					return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_update_err', array( 'title' => $event->title )));

				endif;

			endif;

		endif;

	}

	public function getPublish( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_display_err'));
		
		else:

			$event = Events::find($id);

			$publish = Events::publish($id);

			if(!$publish):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_publish_err', array( 'title' => $event->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.events_publish', array( 'title' => $event->title )));

			endif;

		endif;

	}

	public function getDraft( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_display_err'));
		
		else:

			$event = Events::find($id);

			$draft = Events::draft($id);

			if(!$draft):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_draft_err', array( 'title' => $event->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.events_draft', array( 'title' => $event->title )));

			endif;

		endif;

	}

	public function getTrash( $id = '' ){

		if( $id == '' ):

			$events = Events::getTrash();

			$msg_success = Session::get('msg_success');

			$msg_error = Session::get('msg_error');

			return View::make('backend.events.trash', array(
				'events' => $events,
				'msg_success' => $msg_success,
				'msg_error' => $msg_error
				));
		
		else:

			$event = Events::find($id);

			$trash = Events::trash($id);

			if(!$trash):

				return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_trash_err', array( 'title' => $event->title )));

			else:

				return Redirect::to($this->route)->with('msg_success', Lang::get('messages.events_trash', array( 'title' => $event->title )));

			endif;

		endif;

	}

	public function getUntrash( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_display_err'));
		
		else:

			$event = Events::find($id);

			$draft = Events::draft($id);

			if(!$draft):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.events_untrash_err', array( 'title' => $event->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.events_untrash', array( 'title' => $event->title )));

			endif;

		endif;

	}

	public function getDelete( $id = '' ){

		if( $id == '' ):

			return Redirect::to($this->route)->with('msg_error', Lang::get('messages.events_display_err'));

		else:

			$event = Events::find($id);

			$delete = Events::destroy($id);

			if(!$delete):

				return Redirect::to($this->route.'/trash')->with('msg_error', Lang::get('messages.events_delete_err', array( 'title' => $event->title )));

			else:

				return Redirect::to($this->route.'/trash')->with('msg_success', Lang::get('messages.events_delete', array( 'title' => $event->title )));

			endif;

		endif;

	}

}
