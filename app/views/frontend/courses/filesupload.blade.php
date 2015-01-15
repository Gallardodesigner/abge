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
        Os arquivos foram submetidos com sucesso e serão encaminhados para a Comissão para avaliação. 

              <a href="{{URL::to($course->route.'/')}}">Clique aqui para voltar ao evento.</a>
    </div>
    </div>
	</div>

@stop