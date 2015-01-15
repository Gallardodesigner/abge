<!-- Layout principal -->
@extends("frontend.courses.layout_destaque")

<!-- Titulo de la pagina -->
@section("title")
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="content">
		<div class="course" data-id="{{$course->id}}">
    <div class="course_title">
      <h1>{{$course->title}}</h1>
      <!-- <h5 class="data-adress">Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">  
        <!-- {{$section->section->title}} -->
        {{$section->content}}
    </div>
    <div id="content">
      <div>
      @foreach($helpers as $helper)
       <div class="thumb" style="width:33.33333333333%">
          <img src="/uploads/small_{{$helper->url}}" />
        </div>
      @endforeach
      </div>
    </div>
    </div>
	</div>

@stop