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
      <!-- <h5>Data : {{$course->start}} a {{$course->end}} - Local : {{$course->address}}</h5> -->
    </div>
    <div id="content">
    <div style="width:50%; margin:0 auto;text-align:center;">
    <div class="titulo_empresa"><h3>CPF - Digite seu CPF utilizando somente números, sem pontos e traços abaixo</h3></div>
    <form class="updateform" method="post" action="">
      <input type="hidden" name="course" value="{{$course->id}}"/>
      <input type="hidden" name="usertype" value="{{$usertype->id}}"/>
		<div class="control-box">
      <label>CPF: </label>
      <input type="number" name="cpf" min="11" required  max="11" maxlength="11" /><br>
		</div>
    <div class="control-box">
      <input type="submit" value="Enviar"/>
    </div>
  </form>
  </div>
    </div>
    </div>
	</div>

@stop
