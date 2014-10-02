<!-- Layout principal -->
@extends("frontend.layout");

<!-- Titulo de la pagina -->
@section("title");
	Cursos
@stop

<!-- Contenido principal -->
@section("maincontent")
<div class="left_column">
	<div class="courses-list">
		@foreach($courses as $course)
			<div class="course" data-id="{{$course->id}}">
			 	<a href="{{ URL::to($course->route) }}" >{{$course->title}}</a>
			 	<div class="spec">
			 		<p>{{$course->event->title}}</p>
			 		<p>{{$course->start}} {{$course->end}}</p>
			 	</div>
			 	<p>{{$course->title}}, nos dias {{$course->start}} a {{$course->end}} em {{$course->address}}</p>
			</div>
		@endforeach
	</div>
</div>
<div class="right_column">

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