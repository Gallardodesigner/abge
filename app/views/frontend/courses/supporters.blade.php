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
      <div>
      @foreach($supporters as $supporter)
        <div class="thumb" style="width:33.33333333333%">
          <img src="/uploads/small_{{$supporter->url}}" />
        </div>
      @endforeach
      </div>
    </div>
    </div>
	</div>

@stop