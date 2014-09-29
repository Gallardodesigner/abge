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
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
      @foreach($helpers as $helper)
      <div>
        <div class="thumb">
          <img src="/uploads/thumb_{{$helper->url}}" />
        </div>
        <div class="org_desc">
          <p>{{$helper->title}}</p>
          <p>{{$helper->address}}</p>
        </div>
      </div>
      @endforeach
    </div>
    </div>
	</div>

@stop