<?php

class FrontendAnnuityController extends \BaseController {

	protected static $route = '/anuidades';

	public function getIndex(){

		if(Auth::check()):

			if(Auth::user()->type == 'associate'):

				if($payment = ORGAssociateAnnuities::hasAnnuity(Auth::user())):

					return Redirect::to( self::$route . '/acusado' );

				else:

					return Redirect::to( self::$route . '/pagamento' );

				endif;

			else:

				Auth::logout();
				return Redirect::to(self::$route);

			endif;

		else:

			$args = array(
				'route' => self::$route,
				);

			return View::make('frontend.anuidades.index')->with( $args );

		endif;

	}

	public function getAuth(){

		if( Auth::check() ) Auth::logout();

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.anuidades.auth')->with( $args );

	}

	public function postAuth(){

		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'type' => 'associate'
			);

		$course = Courses::find(Input::get('course'));

		if(Auth::attempt($credentials)):

			if($payment = ORGAssociateAnnuities::hasAnnuity(Auth::user())):

				return Redirect::to( self::$route . '/acusado' );

			else:

				return Redirect::to( self::$route . '/pagamento' );

			endif;

		else:

			$associate = Associates::getByEmail($credentials['email']);

			if(!empty($associate[0])):

				$associate = $associate[0];

				if($associate->password == md5($credentials['password']) ):

					$user_finded = User::where('email','=', $credentials['email'])->take(1)->get();

					$user = null;

					if(!empty($user_finded[0])):

						$user = $user_finded[0];					
						$user->password = Hash::make($credentials['password']);
						$user->save();

					else:

						$user = new User();
						$user->email = $associate->email;
						if($associate->nombre_completo != null):
							$user->name = $associate->nombre_completo;
						else:
							$user->name = "User without name";
						endif;
						$user->status = 'publish';
						$user->type = 'associate';
						$user->password = Hash::make($credentials['password']);
						$user->save();

						$associate->user = $user->id;
						$associate->save();

					endif;

					Auth::login($user);

					if($payment = ORGAssociateAnnuities::hasAnnuity(Auth::user())):

						return Redirect::to( self::$route . '/acusado' );

					else:

						return Redirect::to( self::$route . '/pagamento' );

					endif;

				else:

					$associate = ORGAssociates::getByEmail($credentials['email']);

					if(!empty($associate[0])):

						$associate = $associate[0];

						if($associate->senha == md5($credentials['password']) ):

							$user = new User();
							$user->email = $associate->email;
							if($associate->nombre_completo != null):
								$user->name = $associate->nombre_completo;
							else:
								$user->name = "User without name";
							endif;
							$user->status = 'publish';
							$user->type = 'associate';
							$user->password = Hash::make($credentials['password']);
							$user->save();

							$assoc = new Associates();
							$assoc->associate = $associate->id_asociado;
							$assoc->user = $user->id;
							$assoc->email = $associate->email;
							if($associate->nombre_completo != null):
								$assoc->name = $associate->nombre_completo;
							else:
								$assoc->name = "User without name";
							endif;
							$assoc->cpf = $associate->cpf;
							$assoc->password = $associate->senha;
							$assoc->status = 'publish';
							$assoc->type = 'associate';
							$assoc->save();

							Auth::login($user);

							if($payment = ORGAssociateAnnuities::hasAnnuity(Auth::user())):

								return Redirect::to( self::$route . '/acusado' );

							else:

								return Redirect::to( self::$route . '/pagamento' );

							endif;

						else:

							return Redirec::to( self::$route . '/error' );

						endif;

					else:

						return Redirec::to( self::$route . '/error' );

					endif;

					return Redirec::to( self::$route . '/error' );

				endif;

			else:

				$associate = ORGAssociates::getByEmail($credentials['email']);

				if(!empty($associate[0])):

					$associate = $associate[0];

					if($associate->senha == md5($credentials['password']) ):

						$user = new User();
						$user->email = $associate->email;
						if($associate->nombre_completo != null):
							$user->name = $associate->nombre_completo;
						else:
							$user->name = "User without name";
						endif;
						$user->status = 'publish';
						$user->type = 'associate';
						$user->password = Hash::make($credentials['password']);
						$user->save();

						$assoc = new Associates();
						$assoc->associate = $associate->id_asociado;
						$assoc->user = $user->id;
						$assoc->email = $associate->email;
						if($associate->nombre_completo != null):
							$assoc->name = $associate->nombre_completo;
						else:
							$assoc->name = "User without name";
						endif;
						$assoc->cpf = $associate->cpf;
						$assoc->password = $associate->senha;
						$assoc->status = 'publish';
						$assoc->type = 'associate';
						$assoc->save();

						Auth::login($user);

						if($payment = ORGAssociateAnnuities::hasAnnuity(Auth::user())):

							return Redirect::to( self::$route . '/acusado' );

						else:

							return Redirect::to( self::$route . '/pagamento' );

						endif;

					else:

						return Redirec::to( self::$route . '/error' );

					endif;

				else:

					return Redirec::to( self::$route . '/error' );

				endif;

			endif;

		endif;

	}

	public function getCheckout(){

		Auth::logout();

		return Redirect::to( self::$route );

	}

	public function getAcusado(){

		$args = array(
			'associate' => Auth::user()->associate->associate,
			'user' => Auth::user(),
			'route' => self::$route
			);

		return View::make('frontend.anuidades.processed')->with( $args );

	}

	public function getPagamento(){

		$user = Auth::user();
		$associate = $user->associate->asociado;
		$associateCategory = $associate->category;

		$annuity = ORGAnnuities::getLastAnnuity();
		$category = $annuity->getAnnuityCategoryByAssociateCategory( $associateCategory );

		if($date = $category->getActualInterval()):

			if( $associateAnnuity = $category->hasPayment( $associate ) ):

				$associateAnnuity->data_pagamento = date('Y-m-d');
				$associateAnnuity->save();

			else:

				$associateAnnuity = new ORGAssociateAnnuities();
				$associateAnnuity->id_anuidade_categoria = $category->id;
				$associateAnnuity->id_asociado = $associate->id_asociado;
				$associateAnnuity->pagamento = $date->preco;
				$associateAnnuity->data_pagamento = date('Y-m-d');
				$associateAnnuity->status = 0;
				$associateAnnuity->save();

			endif;

			$args = array(
				'date' => $date,
				'associate' => $associate,
				'route' => self::$route
				);

			return View::make('frontend.anuidades.payment')->with( $args );

		else:

			return Redirect::to( self::$route . '/error');

		endif;

	}

	public function getError(){

		$args = array(
			'route' => self::$route,
			);

		return View::make('frontend.anuidades.error')->with( $args );

	}

}