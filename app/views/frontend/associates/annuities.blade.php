@extends('frontend.associates.layout')

@section('css')

@stop

@section('content')

	<div class="row"> 
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<table class="table">
				<tr>
					<th>Nome</th>
					<th>Status</th>
					<th>Ano</th>
					<th>Valor</th>
					<th>Valor Pago</th>
					<th>2ª via da anuidade</th>
					<th>Formas de Pagamento</th>
				</tr>
				@if(count($annuities) > 0)
					@foreach($annuities as $annuity)
						@if($annuity->ano < date('Y'))
							@if($payment = $associate->getPaymentByAnnuity( $annuity ))
								<?php $interval = $payment->category->getCustomInterval( $payment->data_pagamento ) ?>
								<tr>
									<td>
										{{ $interval->nome }}
									</td>
									<td>
										{{ $payment->status ? 'Pago' : 'Não Pago' }}
									</td>
									<td>
										{{ $annuity->ano }}
									</td>
									<td>
										{{ BaseController::money_format($interval->preco) }}
									</td>
									<td>
										{{ BaseController::money_format($payment->pagamento) }}
									</td>
									<td>
										---
									</td>
									<td>
										---
									</td>
								</tr>
							@endif
						@elseif($annuity->ano == date('Y'))

							@if($payment = $associate->getPaymentByAnnuity( $annuity ))
								<?php $interval = $payment->category->getCustomInterval( $payment->data_pagamento ) ?>
								@if($payment->status)
									<tr>
										<td>
											{{ $interval->nome }}
										</td>
										<td>
											{{ $payment->status ? 'Pago' : 'Aberto' }}
										</td>
										<td>
											{{ $annuity->ano }}
										</td>
										<td>
											{{ BaseController::money_format($interval->preco) }}
										</td>
										<td>
											{{ BaseController::money_format($payment->pagamento) }}
										</td>
										<td>
											---
										</td>
										<td>
											---
										</td>
									</tr>
								@else
									<tr>
										<td>
											{{ $interval->nome }}
										</td>
										<td>
											{{ $payment->status ? 'Pago' : 'Aberto' }}
										</td>
										<td>
											{{ $annuity->ano }}
										</td>
										<td>
											{{ BaseController::money_format($interval->preco) }}
										</td>
										<td>
											{{ BaseController::money_format($payment->pagamento) }}
										</td>
										<td>
											Codigo de barras
										</td>
										<td>
											{{ $interval->pagseguro }}
										</td>
									</tr>
								@endif
							@else
								<?php $category = $annuity->getAnnuityCategoryByAssociateCategory($associate->category) ?>
								<?php $interval = $category->getCustomInterval( date('Y-m-d') ) ?>
								<tr>
									<td>
										{{ $interval->nome }}
									</td>
									<td>
										{{ 'Aberto' }}
									</td>
									<td>
										{{ $annuity->ano }}
									</td>
									<td>
										{{ BaseController::money_format($interval->preco) }}
									</td>
									<td>
										{{ BaseController::money_format(0) }}
									</td>
									<td>
										Codigo de barras
									</td>
									<td>
										{{ $interval->pagseguro }}
									</td>
								</tr>
							@endif
						@endif
						<!-- <tr>
							<td>
								{{ $annuity->nome }}
							</td>
							<td>
								{{ $annuity->status ? 'Pago' : 'Aberto' }}
							</td>
							<td>
								{{ $annuity->ano }}
							</td>
							<td>
								{{ $annuity->valor }}
							</td>
							<td>
								{{ $annuity->valor_pago }}
							</td>
							<td>
								@if(!$annuity->status)
									{{ $annuity->ano }}
								@endif
							</td>
							<td>
								@if(!$annuity->status)
									{{ $annuity->ano }}
								@endif
							</td>
						</tr> -->
					@endforeach
				@endif
			</table>
		</div>
		<div class="col-md-2"></div>
	</div>

    <!-- <div class="row center">
      	<div class="col-md-3">
           <span class="tile col-md-12 bg-light-blue">
                <span class="title">Personal Registrado: <span>0</span></span>
                <a href="/administrador/personal" class="content">Haga click aqui para ver todos el personal registrado</a>
           </span>
     	 </div>
      	<div class="col-md-3">
           <span class="tile col-md-12 bg-red">
                <span class="title">Sanciones: <span>0</span></span>
                <a href="/administrador/sanciones" class="content">Haga click aqui para ver todos el personal registrado</a>
           </span>
      	</div>
      	<div class="col-md-3">
           <span class="tile col-md-12 bg-light-green">
                <span class="title">Condecoraciones: <span>0</span></span>
                <a href="/administrador/condecoraciones" class="content">Haga click aqui para ver todos el personal registrado</a>
           </span>
      	</div>
     	<div class="col-md-3">
               <span class="tile col-md-12 bg-blue-grey">
                    <span class="title">Usuarios de Dpto: <span>0</span></span>
                    <a href="/administrador/usuarios" class="content">Haga click aqui para ver todos el personal registrado</a>
               </span>
          </div>
    </div> -->

@stop

@section('javascripts')

@stop