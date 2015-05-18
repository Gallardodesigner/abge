<!-- Layout principal -->
@extends("frontend.layout")

<!-- Titulo de la pagina -->
@section("title")
	Noticias
@stop

<!-- Contenido principal -->
@section("maincontent")

<style>
  	table, tr, td{
	  border:0px !important;
	}
</style>


<div class="left_column" style="margin-bottom:62px">

	<div class="home_article">
		<div class="home_article_title texto_azul">
		    Noticias
		</div>
	</div>

	<div style="width:100%; text-align:left;margin-bottom:1em;">

		<style type="text/css">
			p {
			  margin: 0 0 0.7em !important;
			  line-height: 18px;
			}
		</style>

	<hr style="height: 1px; background-color: #e5e5e5;">

	@if(count($noticias))

		<?php setlocale(LC_TIME, 'portuguese');?>

	    <div id="noticias_content">

	        @foreach($noticias as $noticia)

	          	<div class="newsPress">

		            <table>

		              <tbody>

		                <tr>

		                  <td width="100" style="padding-left: 0;">
		    
		                    @if($noticia->image)
		                      {{ HTML::image('/uploads/news/small_'.$noticia->image, '', array('class'=>'borderImage', 'width' => '100')) }}
		                    @else:
		                      {{ HTML::image('mujer.jpg', '', array('class'=>'borderImage', 'border' => '0', 'width' => '100')) }}
		                    @endif

		                  </td>

		                  <td width="3"></td>

		                  <td valign="top">
		                    <div style="position: relative; height: 110px;">
		                        
		                      <div><a class="titulo_listado" href="{{ $route }}/detalle/{{ $noticia->permalink }}">{{ $noticia->title }}</a></div>
		                      <div class="summary"></div>
		                      <div class="fecha_listado">{{ iconv('ISO-8859-2', 'UTF-8', strftime('%d de %B del %Y', strtotime($noticia->date))) }}</div>
		                    </div>
		                  </td>

		                </tr>

		              </tbody>

		            </table>

	          	</div>

	          	<hr style="height: 1px; background-color: #e5e5e5;" />

	        @endforeach

	        {{ $noticias->links('frontend.noticias.paginate')->with(array('noticias' => $noticias, 'route' => $route )) }}

		</div>

	@else

		{{ 'Não há profissionais cadastrados nesta área de atuação' }}

	@endif


	</div>
</div>
<div class="right_column" style="margin-bottom:62px">
	<div class="home_article">
        <div class="home_article_title texto_azul">
		    Área do Associado
		</div>
		<div class="div_float" style="line-height: 17px; ">   
		    <div id="content_logeo" style="float: left;">
		    	Olá, seja bem-vindo<br><br>
		    	<a target="_blank" href="/entrar"><img src="http://abge.org.br/images/bt-area-associado.png"></a><br>
		    	<!--<a href=""> Clique aqui para sair</a>-->
			</div>
      	</div>
    </div>


                <div class="home_article">
                  <div class="home_article_title texto_azul">
                    Socios - Patrocinadores
                  </div>

                  <div class="div_float">
       <script type="text/javascript"><!--//<![CDATA[
         var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
         var m3_r = Math.floor(Math.random()*99999999999);
         if (!document.MAX_used) document.MAX_used = ',';
         document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
         document.write ("?zoneid=1");
         document.write ('&amp;cb=' + m3_r);
         if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
         document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
         document.write ("&amp;loc=" + escape(window.location));
         if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
         if (document.context) document.write ("&context=" + escape(document.context));
         if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
         document.write ("'><\/scr"+"ipt>");
         //]]>--></script>
         <noscript>&lt;a href='http://abge1.hospedagemdesites.ws/openx/www/delivery/ck.php?n=a06014f3&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'&gt;&lt;img src='http://abge1.hospedagemdesites.ws/openx/www/delivery/avw.php?zoneid=1&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;amp;n=a06014f3' border='0' alt='' /&gt;&lt;/a&gt;</noscript>

       </div>
       <div style="position: relative;top: 0px;">
        <a style="font-size: 12px; float: right; text-decoration: underline;" href="http://abge.org.br/index.php/abge/socios-patrocinadore">Ver todos</a></div>
      </div>

      <div class="home_article">
        <div class="home_article_title texto_azul">
          Eventos- Apoio ABGE
        </div>

        <div class="div_float">

     <script type="text/javascript"><!--//<![CDATA[
       var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
       var m3_r = Math.floor(Math.random()*99999999999);
       if (!document.MAX_used) document.MAX_used = ',';
       document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
       document.write ("?zoneid=2");
       document.write ('&amp;cb=' + m3_r);
       if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
       document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
       document.write ("&amp;loc=" + escape(window.location));
       if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
       if (document.context) document.write ("&context=" + escape(document.context));
       if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
       document.write ("'><\/scr"+"ipt>");
       //]]>--></script>
       <noscript>&lt;a href='http://abge1.hospedagemdesites.ws/openx/www/delivery/ck.php?n=a09182f5&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'&gt;&lt;img src='http://abge1.hospedagemdesites.ws/openx/www/delivery/avw.php?zoneid=2&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;amp;n=a09182f5' border='0' alt='' /&gt;&lt;/a&gt;</noscript>


     </div>
     <div style="position: relative;top: 0px;">
      <br>
      <a style="font-size: 12px; float: right; text-decoration: underline; margin-top:10px;" href="http://abge.org.br/index.php/abge/apoio">Ver Todos</a></div>
    </div>

    <div class="home_article">
     <div class="home_article_title texto_azul">
      Parceiros
    </div>

    <div class="div_float">

<script type="text/javascript"><!--//<![CDATA[
 var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
 var m3_r = Math.floor(Math.random()*99999999999);
 if (!document.MAX_used) document.MAX_used = ',';
 document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
 document.write ("?zoneid=3");
 document.write ('&amp;cb=' + m3_r);
 if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
 document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
 document.write ("&amp;loc=" + escape(window.location));
 if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
 if (document.context) document.write ("&context=" + escape(document.context));
 if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
 document.write ("'><\/scr"+"ipt>");
 //]]>--></script>
 <noscript>&lt;a href='http://abge1.hospedagemdesites.ws/openx/www/delivery/ck.php?n=ad50381e&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'&gt;&lt;img src='http://abge1.hospedagemdesites.ws/openx/www/delivery/avw.php?zoneid=3&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;amp;n=ad50381e' border='0' alt='' /&gt;&lt;/a&gt;</noscript>



</div>
<div style="position: relative;top: 0px;">
  <a style="font-size: 12px; float: right; text-decoration: underline;" href="http://abge.org.br/index.php/abge/entidades">Ver Todos</a></div>
</div>
</div>
@stop