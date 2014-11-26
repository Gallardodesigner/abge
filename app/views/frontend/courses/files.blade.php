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
        <form method="post" enctype="multipart/form-data" id="arquivo-form">
        <fieldset class="submitwork">
          <legend>Trabalho 1</legend>
          
          
          <input type="text" name="titles[]" placeholder="Nome do seu trabalho" required/>
          <div class="file">
            <input type="file" name="files[]" accept=".pdf,.doc,.docx" required/>
            <label for="file">Submeta o Arquivo 1
          </div>
          <div class="file">
            <input type="file" name="files[]" accept=".pdf,.doc,.docx" required/>
            <label for="file">Submeta o Arquivo 2</label>
          </div>
        </fieldset>

        <fieldset class="submitwork">
          <legend>Trabalho 2</legend>
          
          
          <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
          <div class="file">
            <input type="file" name="files[]" accept=".pdf,.doc,.docx" />
            <label for="file">Submeta o Arquivo 1
          </div>
          <div class="file">
            <input type="file" name="files[]" accept=".pdf,.doc,.docx" />
            <label for="file">Submeta o Arquivo 2</label>
          </div>
        </fieldset>
        
          <fieldset class="submitwork">
          <legend>Trabalho 3</legend>
          
          
          <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
          <div class="file">
            <input type="file" name="files[]" accept=".pdf,.doc,.docx" />
            <label for="file">Submeta o Arquivo 1
          </div>
          <div class="file">
            <input type="file" name="files[]" accept=".pdf,.doc,.docx" />
            <label for="file">Submeta o Arquivo 2</label>
          </div>
        </fieldset>
          <input type="submit" value="Enviar"/><br>
        </form>
    </div>
    </div>
	</div>

  <script type="text/javascript">

  $(document).ready( function(){
    // $('#arquivo-form').submit(function(e) {

    //   e.preventDefault();
    //   var extensiones_permitidas = new Array(".docx", ".doc", ".pdf");

    //   var band = true;

    //   $('input[type=file]').each(function(){

    //     var elem = $(this);
    //     console.log(elem.files);
    //     var archivo = elem.val();
    //     var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 

    //     if( archivo != '' ){

    //       permitida = false;

    //       for (var i = 0; i < extensiones_permitidas.length; i++) { 
    //         if (extensiones_permitidas[i] == extension) { 

    //           permitida = true; 
    //           break; 
    //         } 
    //       } 

    //       if( !permitida ){
    //         band = false;
    //       }

    //     }

    //   });

    //   if(!band){

    //     alert("Os arquivos permitidos são PDF, DOC e DOCX");

    //     return false;

    //   }
    //   else{

    //     $('#arquivo-form').submit();

    //   }

    // });
  }); 

  </script>

@stop