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
    <form id="participant" class="updateform" method="post" action="">
      <input type="hidden" name="course" value="{{$course->id}}"/>
      <input type="hidden" name="usertype" value="{{$usertype->id}}"/>
		<div class="control-box">
      <label>CPF: </label>
      <input id="cpf" type="text" name="cpf"  required   maxlength="11" /><br>
		</div>
    <div class="control-box">
      <input type="submit" value="Enviar"/>
    </div>
  </form>
  </div>
    </div>
    </div>
	</div>
  <script>
  jQuery(document).bind("ready",function(e){

    function TestaCPF(strCPF) { var Soma; var Resto; Soma = 0; if (strCPF == "00000000000") return false; for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i); Resto = (Soma * 10) % 11; if ((Resto == 10) || (Resto == 11)) Resto = 0; if (Resto != parseInt(strCPF.substring(9, 10)) ) return false; Soma = 0; for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i); Resto = (Soma * 10) % 11; if ((Resto == 10) || (Resto == 11)) Resto = 0; if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false; return true; } 



      jQuery("#participant").bind("submit",function(eve){
        eve.preventDefault();
        var todoCorrecto = true;
        // console.log(jQuery("#cpf"));
        input = (jQuery("#cpf").val())
        expresion = /^\s*$/
         formulario = jQuery(this);
        // console.log(formulario );

                               if (input == null || input.length < 11 || expresion.test(input)){
                                alert ('O CPF não pode ter espaços vazios e deve ser igual a 11 dígitos');
                                todoCorrecto=false;
                                console.log(input.length)
                              }
                              if(TestaCPF(input)){
                                todoCorrecto=true;
                                alert("CPF Valido");
                              }else{
                                todoCorrecto=false;
                                alert("CPF no Valido");
                              }
                               // }else{
                               //  jQuery("#participant").submit();
                               // }
                               if (todoCorrecto ==true) {this.submit();}
      })

  })
  </script>

@stop
