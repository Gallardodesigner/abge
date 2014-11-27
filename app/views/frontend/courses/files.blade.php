<!-- Layout principal -->
@extends("frontend.courses.layout_destaque");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
<style type="text/css">
  .file:nth-child(even){
    margin-left: 30px;
  }
  .file{
    display:inline-block;
    width: 45%;
    text-align: center;
  }
  .file img{
    width: 75px;
    height: auto;
  }
  .file p{
    padding-top: 10px;
  }
</style>
<?php 
function iconito( $mime ){
  $url = null;
  /*return $mime;*/
  switch($mime){
    case 'application/pdf':
      $url = 'http://www.illorem.com/wp-content/uploads/2011/12/pdf-icon.png';
      break;
    case 'application/msword':
      $url = 'http://www.xnergic.org/wp-content/uploads/2014/09/word-doc-icon.png';
      break;
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
      $url = 'http://www.xnergic.org/wp-content/uploads/2014/09/word-doc-icon.png';
      break;
    default:
      /*$url = 'http://forums.watchuseek.com/attachments/f21/1809442d1414115865-classic-seiko-missing-link-5-sarb-x-grand-seiko-question2.png';*/
      $url = $mime;
      break;
  }

  return $url;
}
 ?>
	
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
            @if(count($files)==0)
              <input type="text" name="titles[]" placeholder="Nome do seu trabalho" required/>
            @else
              <input type="text" name="titles[]" placeholder="Nome do seu trabalho" value="{{ str_replace(substr($files[0]->title, -4), '', $files[0]->title) }}" readonly/>
            @endif
            <div class="file">
              @if(count($files) >= 1)
                <img src="{{ iconito($files[0]->mime) }}">
                <p>Arquivo 1 - {{$files[0]->title}}</p>
              <!-- <input type="file" data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/> -->
              @else
                <input type="file" disabled data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/>
                <label for="file">Submeta o Arquivo 1</label>
              @endif
            </div>
            <div class="file">
              @if(count($files) >= 2)
                <img src="{{ iconito($files[1]->mime) }}">
                <p>Arquivo 2 - {{$files[1]->title}}</p>
              <!-- <input type="file" data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/> -->
              @else
                <input type="file" disabled data-nome="Arquivo-2" data-display=1 data-number=2 name="files[]" accept=".pdf,.doc,.docx"/>
                <label for="file">Submeta o Arquivo 2</label>
              @endif
            </div>
            <div id="display-1" style="padding-top:20px;">
              
            </div>
          </fieldset>
          <fieldset class="submitwork">
            <legend>Trabalho 2</legend>
            @if(count($files)<=2)
              <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
            @else
              <input type="text" name="titles[]" placeholder="Nome do seu trabalho" value="{{ str_replace(substr($files[2]->title, -4), '', $files[2]->title) }}" readonly/>
            @endif
            <div class="file">
              @if(count($files) >= 3)
                <img src="{{ iconito($files[2]->mime) }}">
                <p>Arquivo 3 - {{$files[2]->title}}</p>
              <!-- <input type="file" data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/> -->
              @else
                <input type="file" disabled name="files[]" data-nome="Arquivo-3" data-display=2 data-number=3 accept=".pdf,.doc,.docx" />
                <label for="file">Submeta o Arquivo 1</label>
              @endif
            </div>
            <div class="file">
              @if(count($files) >= 4)
                <img src="{{ iconito($files[3]->mime) }}">
                <p>Arquivo 4 - {{$files[3]->title}}</p>
              <!-- <input type="file" data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/> -->
              @else
                <input type="file" disabled name="files[]" data-nome="Arquivo-4" data-display=2 data-number=4 accept=".pdf,.doc,.docx" /> 
                <label for="file">Submeta o Arquivo 2</label>
              @endif                
            </div>
            <div id="display-2" style="padding-top:20px;">
              
            </div>
          </fieldset>     
          <fieldset class="submitwork">
            <legend>Trabalho 3</legend>
            @if(count($files)<=4)
              <input type="text" name="titles[]" placeholder="Nome do seu trabalho"/>
            @else
              <input type="text" name="titles[]" placeholder="Nome do seu trabalho" value="{{ str_replace(substr($files[4]->title, -4), '', $files[4]->title) }}" readonly/>
            @endif
            <div class="file">
              @if(count($files) >= 5)
                <img src="{{ iconito($files[4]->mime) }}">
                <p>Arquivo 5 - {{$files[4]->title}}</p>
              <!-- <input type="file" data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/> -->
              @else
                <input type="file" disabled name="files[]" data-nome="Arquivo-5" data-display=3 data-number=5 accept=".pdf,.doc,.docx" />
                <label for="file">Submeta o Arquivo 1</label>
              @endif
            </div>
            <div class="file">
              @if(count($files) >= 6)
                <img src="{{ iconito($files[5]->mime) }}">
                <p>Arquivo 6 - {{$files[5]->title}}</p>
              <!-- <input type="file" data-nome="Arquivo-1" data-display=1 data-number=1 name="files[]" accept=".pdf,.doc,.docx" required/> -->
              @else
                <input type="file" disabled name="files[]" data-nome="Arquivo-6" data-display=3 data-number=6 accept=".pdf,.doc,.docx" />
                <label for="file">Submeta o Arquivo 2</label>
              @endif
            </div>
            <div id="display-3" style="padding-top:20px;">
              
            </div>
          </fieldset>
          <input type="submit" value="Enviar"/><br>
        </form>
    </div>
    </div>
	</div>

  <script type="text/javascript">

  var inputFileValidation = function(element,number){
    if(element.attr("data-number")==number){



      if($("#"+element.attr("data-nome")).length==0){

        $("#display-"+element.attr("data-display")).append("<p id='"+element.attr("data-nome")+"'>"+element.attr("data-nome") + " - " +element.attr("value")+"</p>");

        // console.log("Mamá no existe")
      }else{
        console.log($("#"+element.attr("data-nome")).length);
        $("#"+element.attr("data-nome")).html(element.attr("data-nome") + " - " +element.attr("value"))
      }
    }else{
      $("#display-"+element.attr("data-display")).append("<p>No cumple"+element.attr("data-nome")+"</p>")

    }
  }

  $(document).ready( function(){

    




    $('input[type=file]').each(function(index){
      console.log(index + " "+ $(this).attr("data-number"));
      if(index==0){
        $('input[data-number='+(parseInt(($(this).attr("data-number"))))+']').removeAttr("disabled");
      }
        $(this).bind("change",function(){
          inputFileValidation($(this),$(this).attr("data-number"));
          console.log($('input[data-number='+(1 + parseInt(($(this).attr("data-number"))))+']'));
          $('input[data-number='+(1 + parseInt(($(this).attr("data-number"))))+']').removeAttr("disabled");
          // alert($(this).attr("data-number"))
        })
    });

    // $('#arquivo-form').submit(function(e) {

    //   e.preventDefault();
    //   var extensiones_permitidas = new Array(".docx", ".doc", ".pdf");

    //   var band = true;

    //   $('input[type=file]').each(function(){

    //     var elem = $(this);
    //     // console.log(elem.files);
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