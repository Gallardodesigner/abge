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
      <h1>{{$course->title}}</h1>
      <!-- <h5 class="data-adress">Data : </h5> -->
    </div>
    <div id="content">	
        <form method="post" enctype="multipart/form-data">
        <fieldset class="submitwork">
          <legend>Trabalho 1</legend>
          
          
          <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
          <div class="file">
            <input type="file" name="files[]" />
            <label for="file">Submeta o Arquivo 1
          </div>
          <div class="file">
            <input type="file" name="files[]" />
            <label for="file">Submeta o Arquivo 2</label>
          </div>
        </fieldset>

        <fieldset class="submitwork">
          <legend>Trabalho 2</legend>
          
          
          <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
          <div class="file">
            <input type="file" name="files[]" />
            <label for="file">Submeta o Arquivo 1
          </div>
          <div class="file">
            <input type="file" name="files[]" />
            <label for="file">Submeta o Arquivo 2</label>
          </div>
        </fieldset>
        
          <fieldset class="submitwork">
          <legend>Trabalho 3</legend>
          
          
          <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
          <div class="file">
            <input type="file" name="files[]" />
            <label for="file">Submeta o Arquivo 1
          </div>
          <div class="file">
            <input type="file" name="files[]" />
            <label for="file">Submeta o Arquivo 2</label>
          </div>
        </fieldset>
          <input type="submit" value="Enviar"/><br>
        </form>
    </div>
    </div>
	</div>

@stop