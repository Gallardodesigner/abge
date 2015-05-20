<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<style type="text/css">
		.course{
			vertical-align: top;
		}
		.inline-block{
			vertical-align: inherit;
			display: inline-block;
			padding:1em;
		}
		.course-image{
			width: 200px;
		}
		.course-content{
			width:60%;
		}
	</style>
	<div class="courses-list">
		@foreach($courses as $course)
			<div class="course" data-id="{{$course->id}}">
				<div class="inline-block course-image">
					<img src="/uploads/courses/{{$course->image}}">
				</div>
				<div class="inline-block course-content">
				 	<a href="{{ URL::to($course->route) }}" >{{$course->title}}</a>
				 	<div class="spec">
				 		<p>{{$course->event->title}}</p>
				 		<p>{{$course->start}} {{$course->end}}</p>
				 	</div>
				 	<p>{{$course->title}}, nos dias {{$course->start}} a {{$course->end}} em {{$course->address}}</p>
				</div>
			</div>
		@endforeach
	</div>
@stop