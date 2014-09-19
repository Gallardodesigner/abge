<!-- Layout principal -->
@extends("frontend.courses.layout_destaque");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	
	<div class="columna_central_home">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->event->title}} : {{$course->title}}</h1>
      <h5>Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5>
    </div>
    <div id="content">
    <form method="post">
		<label>Nome: </label><input type="text" name="nome"/><br>
		<label>Email: </label><input type="email" name="email"/><br>
		<label>RG: </label><input type="text" name="rg"/><br>
		<label>CPF: </label><input type="text" name="cpf"/><br>
		<label>Endereço: </label><input type="text" name="endereco"/><br>
		<label>N°: </label><input type="text" name="numero"/><br>
		<label>Complemento: </label><input type="text" name="complemento"/><br>
		<label>CEP: </label><input type="text" name="cep"/><br>
		<label>Estado: </label>
			<selec name="estado"/>
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					<option value="{{$state->id_estado}}">{{$state->name_estado}}</option>
				@endforeach
			</select>
			<br>
		<label>Cidade: </label><input type="text" name="cidade"/><br>
		<div><h3>Informações de Empresa</h3></div>
		<label>Empresa: </label><input type="text" name="empresa"/><br>
		<label>CNPJ: </label><input type="text" name="cnpj_empresa"/><br>
		<label>Endereço: </label><input type="text" name="endereco_empresa"/><br>
		<label>N°: </label><input type="text" name="numero"/><br>
		<label>Complemento: </label><input type="text" name="complemento_empresa"/><br>
		<label>CEP: </label><input type="text" name="cep_empresa"/><br>
		<label>Estado: </label>
			<selec name="estado_empresa"/>
				<option value="0" selected>Seleccione um estado</option>
				@foreach($estados as $state)
					<option value="{{$state->id_estado}}">{{$state->name_estado}}</option>
				@endforeach
			</select>
			<br>
		<label>Cidade: </label><input type="text" name="cidade_empresa"/><br>
		<label>Telefone: </label><input type="text" name="telefone_empresa"/><br>
		<label>Celular: </label><input type="text" name="celular_empresa"/><br>
		<label>Tipo de participante: </label><select name="type">
			<option value="0" selected>Seleccione um tipo</option>
			<option value="student">Estudiante</option>
			<option value="participant">Participant</option>
		</select><br>
		<input type="submit" value="Enviar"/>
	</form>
    </div>
    </div>
	</div>

@stop
