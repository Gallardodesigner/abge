<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="courses-list">
		@foreach($courses as $course)
			<div class="course" data-id="{{$course->id}}">
			 	<a href="{{ URL::to($course->route) }}" >{{$course->title}}</a>
			 	<div class="spec">
			 		<p>{{$course->event->title}}</p>
			 		<p>{{$course->start}} {{$course->end}}</p>
			 	</div>
			 	<p>{{$course->title}}, nos dias {{$course->start}} a {{$course->end}} em {{$course->address}}</p>
			</div>
		@endforeach
	</div>
@stop