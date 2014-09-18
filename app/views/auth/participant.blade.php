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
		<label>CPF: </label><input type="text" name="cpf"/><br>
		<input type="submit" value="Enviar"/>
	</form>
    </div>
    </div>
	</div>

@stop
<form method="post">
	<label>Email: </label><input type="text" name="email"/><br>
	<label>Password: </label><input type="password" name="password"/><br>
	<input type="submit" value="Enviar"/>
</form>
