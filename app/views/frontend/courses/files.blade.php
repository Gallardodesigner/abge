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
        <form method="post" enctype="multipart/form-data">
          <input type="text" name="title[]" placeholder="Titulo"><input type="file" name="files[]" ><br>
          <input type="text" name="title[]" placeholder="Titulo"><input type="file" name="files[]" ><br>
          <input type="text" name="title[]" placeholder="Titulo"><input type="file" name="files[]" ><br>
          <input type="text" name="title[]" placeholder="Titulo"><input type="file" name="files[]" ><br>
          <input type="text" name="title[]" placeholder="Titulo"><input type="file" name="files[]" ><br>
          <input type="submit" value="Enviar"/><br>
        </form>
    </div>
    </div>
	</div>

@stop