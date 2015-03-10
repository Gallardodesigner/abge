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
    </div>
    <div id="content">
    <form class="updateform" method="post">
    	<input type="hidden" name="usertype" value="{{$usertype->id}}"/>
    	<input type="hidden" name="course" value="{{$course->id}}"/>
    	<input type="hidden" name="cpf" value="{{$cpf}}"/>
		<div class="control-box">
			<label>Nome: </label>
			<input type="text" name="nome" />
		</div>
		<div class="control-box">
			<label>RG: </label>
			<input type="text" name="rg" />
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
			<label>Empresa: </label>
			<input type="text" name="empresa"/>
		</div>
		<div class="control-box">
			<label>Email: </label>
			<input type="email" name="email"/>
		</div>
		
		<div class="control-box">
			<input type="submit" value="Enviar"/>
		</div>
	</form>
    </div>
    </div>
	</div>

@stop
