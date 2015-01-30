<!-- Layout principal -->
@extends("frontend.courses.layout_destaque");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="content">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->event->title}} : {{$course->title}}</h1>
      <!-- <h5>Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
    <form class="updateform" method="post">
    	<input type="hidden" name="usertype" value="{{$usertype->id}}"/>
    	<input type="hidden" name="course" value="{{$course->id}}"/>
    	@if($inscription->user->type == 'associate')
    		<input type="hidden" name="id" value="{{$participant->id_asociado}}"/>
    	@else
    		<input type="hidden" name="id" value="{{$participant->id_participante}}"/>
    	@endif
    	<input type="hidden" name="inscription" value="{{$inscription->id}}"/>
		

		<div class="control-box">
			<label>Nome: </label>
			<input type="text" name="nombre_completo" value="{{ $participant->nombre_completo }}"/>
		</div>
		<div class="control-box">
			<label>RG: </label>
			<input type="text" name="rg" value="{{ $participant->rg }}"/>
		</div>
		<div class="control-box">
			<label>CPF: * </label>
			<input type="text" name="cpf" value="{{ $participant->cpf }}" required/>
		</div>
		<div class="control-box">
			<label>Formação Profissional: </label>
			<select name="formacao">
				<option value="0" selected>Seleccione uma formação</option>
				@foreach($formacoes as $formacao)
					@if($participant->formacao == $formacao->id)
						<option value="{{$formacao->id}}" selected>{{$formacao->nome}}</option>
					@else
						<option value="{{$formacao->id}}">{{$formacao->nome}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>Endereço: </label>
			<input type="text" name="dir_res" value="{{ $participant->dir_res }}"/>
		</div>
		<div class="control-box">
			<label>N°: </label>
			<input type="text" name="numero_res" value="{{ $participant->numero_res }}"/>
		</div>
		<div class="control-box">
			<label>Complemento: </label>
			<input type="text" name="complemento_res" value="{{ $participant->complemento_res }}"/>
		</div>
		<div class="control-box">
			<label>Bairro: </label>
			<input type="text" name="bairro_res" value="{{ $participant->bairro_res }}"/>
		</div>
		<div class="control-box">
			<label>Cidade: </label>
			<select name="logradouro_res">
				<option value="0" selected>Seleccione uma cidade</option>
				@foreach($logradouros as $logradouro)
					@if($participant->logradouro_res == $logradouro->id_logradouro)
						<option value="{{$logradouro->id_logradouro}}" selected>{{$logradouro->nombre}}</option>
					@else
						<option value="{{$logradouro->id_logradouro}}">{{$logradouro->nombre}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>Estado: </label>
			<select name="uf_res">
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					@if($participant->uf_res == $state->id_estado)
						<option value="{{$state->id_estado}}" selected>{{$state->name_estado}}</option>
					@else
						<option value="{{$state->id_estado}}">{{$state->name_estado}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>CEP: </label>
			<input type="text" name="cep_res" value="{{ $participant->cep_res }}"/>
		</div>

		<div class="control-box">
			<h4>Detalhes da empresa</h4>
		</div>

		<div class="control-box">
			<label>Empresa: </label>
			<input type="text" name="empresa" value="{{ $participant->empresa }}"/>
		</div>
		<div class="control-box">
			<label>CNPJ: * </label>
			<input type="text" name="cnpj" value="{{ $participant->cnpj }}"/>
		</div>
		<div class="control-box">
			<label>Endereço: </label>
			<input type="text" name="dir_com" value="{{ $participant->dir_com }}"/>
		</div>
		<div class="control-box">
			<label>N°: </label>
			<input type="text" name="numero_com" value="{{ $participant->numero_com }}"/>
		</div>
		<div class="control-box">
			<label>Complemento: </label>
			<input type="text" name="complemento_com" value="{{ $participant->complemento_com }}"/>
		</div>
		<div class="control-box">
			<label>Bairro: </label>
			<input type="text" name="bairro_com" value="{{ $participant->bairro_com }}"/>
		</div>
		<div class="control-box">
			<label>Cidade: </label>
			<select name="logradouro_com">
				<option value="0" selected>Seleccione uma cidade</option>
				@foreach($logradouros as $logradouro)
					@if($participant->logradouro_res == $logradouro->id_logradouro)
						<option value="{{$logradouro->id_logradouro}}" selected>{{$logradouro->nombre}}</option>
					@else
						<option value="{{$logradouro->id_logradouro}}">{{$logradouro->nombre}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>Estado: </label>
			<select name="uf_com">
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					@if($participant->uf_com == $state->id_estado)
						<option value="{{$state->id_estado}}" selected>{{$state->name_estado}}</option>
					@else
						<option value="{{$state->id_estado}}">{{$state->name_estado}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>CEP: </label>
			<input type="text" name="cep_com" value="{{ $participant->cep_com }}"/>
		</div>
		<!-- <br>
		<div class="titulo_empresa"><h3>Informações de Empresa</h3></div>
		<br>-->
		<div class="control-box">
			<label style="margin-right:86px">Telefone: </label>
			<input type="text" name="ddi_res" value="{{ $participant->ddi_res }}" placeholder="DDI" style="display:inline-block;width:80px;float:none !important;"/>
			<input type="text" name="ddd_res" value="{{ $participant->ddd_res }}" placeholder="DDD" style="display:inline-block;width:80px;float:none !important;"/>
			<input type="text" name="telefone_res" value="{{ $participant->telefone_res }}" placeholder="NUMERO" style="display:inline-block;width:150px;float:none !important;"/>
		</div>
		<div class="control-box" style="text-align:left">
			<label style="margin-right:95px">Celular: </label>
			<input type="text" name="ddi_cel_res" value="{{ $participant->ddi_cel_res }}" placeholder="DDI" style="display:inline-block;width:80px;float:none !important;"/>
			<input type="text" name="ddd_cel_res" value="{{ $participant->ddd_cel_res }}" placeholder="DDD" style="display:inline-block;width:80px;float:none !important;"/>
			<input type="text" name="celular_res" value="{{ $participant->celular_res }}" placeholder="NUMERO" style="display:inline-block;width:150px;float:none !important;"/>
		</div>

		<div class="control-box">
			<label>Email: </label>
			<input type="email" name="email" value="{{ $participant->email }}"/>
		</div>

		<div class="control-box">
			<h4>Pagamento</h4>
		</div>

		<div class="control-box">
			<label>Empresa: </label>
			<input type="text" name="pagamento_empresa" value="{{ $participant->pagamento_empresa }}"/>
		</div>

		<div class="control-box">
			<label>Email: </label>
			<input type="text" name="pagamento_participante" value="{{ $participant->pagamento_participante }}"/>
		</div>
		
		<!-- <div class="control-box">
		<label>Tipo de participante: </label>
			<select name="type">
				<option value="0" selected>Seleccione um tipo</option>
				@foreach($course->usertypes as $user)
					@if(!$user->associate)
						<option value="{{ $user->id }}">{{$user->title}}</option>
					@endif
				@endforeach
			</select>
		</div> -->
		<div class="control-box">
			<input type="submit" value="Enviar"/>
		</div>
	</form>
    </div>
    </div>
	</div>

@stop
