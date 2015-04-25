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
				@if(count($associate->anuidades) > 0)
					@foreach($associate->anuidades as $anuidade)
						<tr>
							<td>
								{{ $anuidade->nome }}
							</td>
							<td>
								{{ $anuidade->status ? 'Pago' : 'Aberto' }}
							</td>
							<td>
								{{ $anuidade->ano }}
							</td>
							<td>
								R$ {{ number_format($anuidade->valor, 2, ',', '.') }}
							</td>
							<td>
								R$ {{ number_format($anuidade->valor_pago, 2, ',', '.') }}
							</td>
							<td>
								<!-- {{ $anuidade->ano }} -->
							</td>
							<td>
								<!-- {{ $anuidade->ano }} -->
							</td>
						</tr>
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