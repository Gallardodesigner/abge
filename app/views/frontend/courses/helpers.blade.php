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
      
    </div>
    <div id="content">  
        <!-- {{$section->section->title}} -->
        {{$section->content}}
    </div>
    <style type="text/css">
      .line-container{
        text-align: center;
      }
      .frame{
        width: 350px;
        height: 200px;
        border: 0px solid red;
        white-space: nowrap;
        text-align: center; margin: 1em 0;
        display: inline-block;
        margin: 0;
      }
      .helper {
          display: inline-block;
          height: 100%;
          vertical-align: middle;
      }
      .thumb-image{
        vertical-align: middle;
        max-height: 180px;
        max-width: 300px;
      }
    </style>
    <div id="content">
      <div class="line-container">
      @if(count($helpers) > 0 AND ($counter = 0) == 0)
        @foreach($helpers as $helper)
          <div class="frame">
            @if($helper->route != null and $helper->route != '')
              <span class="helper"></span><a href="{{ $helper->route }}"><img class="thumb-image" src="/uploads/small_{{$helper->url}}" /></a>
            @else
              <span class="helper"></span><img class="thumb-image" src="/uploads/small_{{$helper->url}}" />
            @endif
          </div>
          @if(++$counter%2 == 0)
          @endif
        @endforeach
      @endif
      </div>
    </div>
    </div>
  </div>

@stop