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
			<input type="text" name="nome" value="{{ $participant->nome }}"/><br>
		</div>
		<label>Email: </label><input type="email" name="email" value="{{ $participant->email }}"/><br>
		<label>RG: </label><input type="text" name="rg" value="{{ $participant->rg }}"/><br>
		<label>CPF: </label><input type="text" name="cpf" value="{{ $participant->cpf }}"/><br>
		<label>Endereço: </label><input type="text" name="endereco" value="{{ $participant->endereco }}"/><br>
		<label>N°: </label><input type="text" name="numero" value="{{ $participant->numero }}"/><br>
		<label>Complemento: </label><input type="text" name="complemento" value="{{ $participant->complemento }}"/><br>
		<label>CEP: </label><input type="text" name="cep" value="{{ $participant->cep }}"/><br>
		<label>Estado: </label>
			<select name="estado">
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					@if($participant->estado == $state->name_estado)
						<option value="{{$state->id_estado}}" selected>{{$state->name_estado}}</option>
					@else
						<option value="{{$state->id_estado}}">{{$state->name_estado}}</option>
					@endif
				@endforeach
			</select>
			<br>
		<label>Cidade: </label><input type="text" name="cidade" value="{{ $participant->cidade }}"/><br>
		<div><h3>Informações de Empresa</h3></div>
		<label>Empresa: </label><input type="text" name="empresa" value="{{ $participant->empresa }}"/><br>
		<label>CNPJ: </label><input type="text" name="cnpj_empresa" value="{{ $participant->cnpj_empresa }}"/><br>
		<label>Endereço: </label><input type="text" name="endereco_empresa" value="{{ $participant->endereco_empresa }}"/><br>
		<label>N°: </label><input type="text" name="numero_empresa" value="{{ $participant->numero_empresa }}"/><br>
		<label>Complemento: </label><input type="text" name="complemento_empresa" value="{{ $participant->complemento_empresa }}"/><br>
		<label>CEP: </label><input type="text" name="cep_empresa" value="{{ $participant->cep_empresa }}"/><br>
		<label>Estado: </label>
			<select name="estado_empresa">
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					@if($participant->estado_empresa == $state->name_estado)
						<option value="{{$state->id_estado}}" selected>{{$state->name_estado}}</option>
					@else
						<option value="{{$state->id_estado}}">{{$state->name_estado}}</option>
					@endif
				@endforeach
			</select>
			<br>
		<label>Cidade: </label><input type="text" name="cidade_empresa" value="{{ $participant->cidade_empresa }}"/><br>
		<label>Telefone: </label><input type="text" name="telefone_empresa" value="{{ $participant->telefone_empresa }}"/><br>
		<label>Celular: </label><input type="text" name="celular_empresa" value="{{ $participant->celular_empresa }}"/><br>
		<label>Tipo de participante: </label><select name="type">
			<option value="0" selected>Seleccione um tipo</option>
			@foreach($course->usertypes as $user)
				@if(!$user->associate)
					<option value="{{ $user->id }}">{{$user->title}}</option>
				@endif
			@endforeach
		</select><br>
		<input type="submit" value="Enviar"/>
	</form>
    </div>
    </div>
	</div>

@stop
