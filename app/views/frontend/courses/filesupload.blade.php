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
      <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5>
    </div>
    <div id="content">	
        Sus archivos han sido subidos exitosamente y serán revisados por un moderador.

              <a href="{{URL::to('courses/'.$course->id.'/')}}">volver a la informacion del curso</a>
    </div>
    </div>
	</div>

@stop