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
    <div class="titulo_empresa"><h3>Acesso do Associado</h3></div>
    <form class="updateform" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="course" value="{{$course->id}}"/>
    	<input type="hidden" name="usertype" value="{{$usertype->id}}"/>
        <div class="control-box">
		    <label>Email: </label>
            <input type="text" name="email"/>
        </div>
        <div class="control-box">
		    <label>Senha: </label>
            <input type="password" name="password"/>
        </div>
        <div class="control-box">
            <a href="http://www.abge.org.br/index.php/abge/cadastro">Associe-se</a>
            <a class="right" href="http://www.abge.org.br/index.php/abge/esqueci-minha-senha">Esqueci minha senha</a>
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