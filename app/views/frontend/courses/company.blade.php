<!-- Layout principal -->
@extends("frontend.courses.layout_destaque")

<!-- Titulo de la pagina -->
@section("title")
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
      <div>
        <div class="thumb">
          @if($course->company->route != null and $course->company->route != '')
            <a href="{{ $course->company->route}}"><img src="/uploads/thumb_{{$course->company->url}}"></a>
          @else
            <img src="/uploads/thumb_{{$course->company->url}}" />
          @endif
        </div>
        <div class="org_desc">
          <p>{{$course->company->title}}</p>
          <p>{{$course->company->address}}</p>
        </div>
      </div>
    </div>
    </div>
	</div>

@stop