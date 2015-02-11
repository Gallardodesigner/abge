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

		<div class="control-box">
			<label>Nome: </label>
			<input type="text" name="nome"/>
		</div>
		<div class="control-box">
			<label>RG: </label>
			<input type="text" name="rg"/>
		</div>
		<div class="control-box">
			<label>CPF: * </label>
			<input type="text" name="cpf" value="{{ $cpf }}" required/>
		</div>
		<div class="control-box">
			<label>Formação Profissional: </label>
			<select name="formacao">
				<option value="0" selected>Seleccione uma formação</option>
				@foreach($formacoes as $formacao)
					<option value="{{$formacao->id}}">{{$formacao->nome}}</option>
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>Endereço: </label>
			<input type="text" name="endereco"/>
		</div>
		<div class="control-box">
			<label>N°: </label>
			<input type="text" name="numero"/>
		</div>
		<div class="control-box">
			<label>Complemento: </label>
			<input type="text" name="complemento"/>
		</div>
		<div class="control-box">
			<label>Bairro: </label>
			<input type="text" name="bairro"/>
		</div>
		<div class="control-box">
			<label>Cidade: </label>
			<input type="text" name="cidade"/>
		</div>
		<div class="control-box">
			<label>Estado: </label>
			<select name="estado">
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					<option value="{{$state->name_estado}}">{{$state->name_estado}}</option>
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>CEP: </label>
			<input type="text" name="cep"/>
		</div>

		<div class="control-box">
			<hr>
		</div>
		<div class="control-box">
			<h4>Detalhes da empresa</h4>
		</div>
		<div class="control-box">
			<label>Empresa: </label>
			<input type="text" name="empresa"/>
		</div>
		<div class="control-box">
			<label>CNPJ: * </label>
			<input type="text" name="cnpj"/>
		</div>
		<div class="control-box">
			<label>Endereço: </label>
			<input type="text" name="endereco_empresa"/>
		</div>
		<div class="control-box">
			<label>N°: </label>
			<input type="text" name="numero_empresa"/>
		</div>
		<div class="control-box">
			<label>Complemento: </label>
			<input type="text" name="complemento_empresa"/>
		</div>
		<div class="control-box">
			<label>Bairro: </label>
			<input type="text" name="bairro_empresa"/>
		</div>
		<div class="control-box">
			<label>Cidade: </label>
			<input type="text" name="cidade_empresa"/>
		</div>
		<div class="control-box">
			<label>Estado: </label>
			<select name="estado_empresa">
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					<option value="{{$state->name_estado}}">{{$state->name_estado}}</option>
				@endforeach
			</select>
		</div>
		<div class="control-box">
			<label>CEP: </label>
			<input type="text" name="cep_empresa"/>
		</div>
		<!-- <br>
		<div class="titulo_empresa"><h3>Informações de Empresa</h3></div>
		<br>-->
		<div class="control-box">
			<label>Telefone: </label>
			<input type="text" name="telefone"/>
		</div>
		<div class="control-box">
			<label>Celular: </label>
			<input type="text" name="celular"/>
		</div>

		<div class="control-box">
			<label>Email: </label>
			<input type="email" name="email"/>
		</div>
		<hr>

		<div class="control-box">
			<h4>Pagamento</h4>
		</div>

		<div class="control-box">
			<label>Empresa: </label>
			<input type="text" name="pagamento_empresa"/>
		</div>

		<div class="control-box">
			<label>Participante: </label>
			<input type="text" name="pagamento_participante"/>
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