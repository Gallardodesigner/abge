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
      @foreach($teachers as $teacher)
        <div class="teacher">
          <div class="thumb">
            <img src="thumb_{{$teacher->url}}" />
          </div>
          <div class="teacher_desc">
            <p>{{$teacher->firstName}} {{$teacher->lastName}}</p>
            <p>{{$teacher->content}}</p>
            <p>{{$teacher->contact}}</p>
          </div>
        </div>
      @endforeach
    </div>
    </div>
	</div>

@stop