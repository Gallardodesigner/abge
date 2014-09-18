<!-- Layout principal -->
@extends("frontend.layout");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="courses-list">
		@foreach($courses as $course)
			<div class="course" data-id="{{$course->id}}">
				{{$course->title}}
			</div>
		@endforeach
	</div>
@stop