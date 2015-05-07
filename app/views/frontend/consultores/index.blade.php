<!-- Layout principal -->
@extends("frontend.layout")

<!-- Titulo de la pagina -->
@section("title")
	Painel de Consultores
@stop

<!-- Contenido principal -->
@section("maincontent")

<style>
  	table, tr, td{
	  border:0px !important;
	}
</style>


<div class="left_column">

	<div class="home_article">
		<div class="home_article_title texto_azul">
		    Painel de Consultores
		</div>
	</div>

	<div style="width:100%; text-align:left;margin-bottom:1em;">

		<style type="text/css">
			p {
			  margin: 0 0 0.5em !important;
			}
		</style>

	  <p>É com grata satisfação que informamos que a ABGE implantou em seu site o “Painel de Consultores”, um local onde os profissionais que prestam serviços de consultoria na área de Geologia de Engenharia, Ambiental e Geotecnia possam divulgar as suas capacitações, colocando-se à disposição do mercado.</p>
	  <p>Tal medida busca atender às inúmeras consultas provenientes do meio externo e que, por meio da ABGE, buscam atendimento profissional.</p>
	  <p>Tais consultas podem se caracterizar por questões bastante simples, algumas vezes até prosaicas, mas, por diversas vezes, são questões mais complexas e que demandam maior empenho dos profissionais.</p>
	  <p>Aproveite a oportunidade.</p>
	  <p>Ressalta-se que a ABGE exime-se de qualquer tipo de responsabilidade pelo serviço prestado por qualquer profissional associado ou pelo eventual mau uso do “Painel de Consultores”.</p>
	  <p>Sugestões são bem vindas.</p>
	  <p>A Diretoria</p>

	</div>

	<hr style="height: 1px; background-color: #e5e5e5;">
	<form method="get" style="background-color: #e5e5e5; padding-left:1em; margin-bottom:1.5em">
	  <label style="font-size:16px">Área de Atuação: </label>
	  <select name="area_de_especializacion" style="font-size:12px;height:30px">
	    <option value="-1" {{ ($data == "-1") ? 'selected' : '' }}>TODAS</option>
	    <optgroup label="OBRAS DE INFRAESTRUCTURA">
	      <option value="14" {{ ($data == "14") ? 'selected' : '' }}>BARRAGENS</option>
	      <option value="15" {{ ($data == "15") ? 'selected' : '' }}>SUBTERRÂNEAS</option>
	      <option value="16" {{ ($data == "16") ? 'selected' : '' }}>LINEARES</option>
	    </optgroup>
	    <!-- <option value="10">ENSINO/PESQUISA</option> -->
	    <option value="5" {{ ($data == "5") ? 'selected' : '' }}>CONSULTORIA EM GEOLOGIA DE ENGENHARIA, GEOTECNICA E AMBIENTAL</option>
	    <option value="8" {{ ($data == "8") ? 'selected' : '' }} >FUNDAÇÕES</option>
	    <option value="9" {{ ($data == "9") ? 'selected' : '' }}>GEOTECNOLOGIAS, GEOPROCESSAMENTOS E SENSORIAMENTO REMOTO</option>
	    <!-- <option value="11">GERENCIAMENTO DE EMPREENDIMENTO</option> -->
	    <option value="6" {{ ($data == "6") ? 'selected' : '' }}>GESTÃO, PLANEJAMENTO E LICENCIAMENTO AMBIENTAL</option>
	    <!-- <option value="7">HIDROGEOLOGIA</option> -->
	    <option value="3" {{ ($data == "3") ? 'selected' : '' }}>MINERAÇÃO</option>
	    <option value="2" {{ ($data == "2") ? 'selected' : '' }}>RECURSOS HIDRICOS</option>
	    <option value="12" {{ ($data == "12") ? 'selected' : '' }}>RESÍDUOS E ÁREAS CONTAMINADAS</option>
	    <option value="13" {{ ($data == "13") ? 'selected' : '' }}>SERVIÇOS EM GEOLOGIA DE ENGENHARIA, GEOTECNICA E AMBIENTAL</option>
	    <!-- <option value="1">OBRA CIVIL</option> -->
	    <!-- <option value="5">PLANEJAMENTO URBANO</option> -->
	    <!-- <option value="0">OUTRAS</option> -->
	  </select>
	  <input type="submit" value="Pesquisar" style="font-size:12px;height:30px">
	</form>

	@if(count($consultores))

	    <div id="noticias_content">

	        @foreach($consultores as $classificados)

	          <div class="newsPress">

	            <table>

	              <tbody>

	                <tr>

	                  <td width="150" style="padding-left: 0;">
	    
	                    @if($classificados->classificados_imagem)
	                      {{ HTML::image('/uploads/classificados/'.$classificados->classificados_imagem, '', array('class'=>'borderImage', 'width' => '150', 'height' => '110')) }}
	                    @elseif($classificados->sexo != 2)
	                      {{ HTML::image('hombre.jpg', '', array('class'=>'borderImage', 'border' => '0', 'width' => '150', 'height' => '110')) }}
	                    @else:
	                      {{ HTML::image('mujer.jpg', '', array('class'=>'borderImage', 'border' => '0', 'width' => '150', 'height' => '110')) }}
	                    @endif

	                  </td>

	                  <td width="3"></td>

	                  <td valign="top">

	                    <div style="position: relative; height: 130px;">
	                        <b>{{ $classificados->nombre_completo }}</b>
	                      <!-- <div><?php /*echo link_to($associados->getTitle(), '@permalink?nucleo='.$nucleo.'&secciones='.$sf_params->get('secciones').'&subseccion=detalle&permalink='.$associados->getIdNews().'-new', array('class' => 'titulo_listado')); */ ?></div>  -->

	                      <div class="summary">e-mail: <a href="mailto:{{ $classificados->email }}">{{ $classificados->email }}</a> | {{ 'Telefone: '.($classificados->telefone_res != '' ? $classificados->ddi_res.' '.$classificados->telefone_res : 'Sem telefone' ); }}</div>
	                      <div class="summary" style="line-height:16px">{{ substr($classificados->classificados_conteudo,0,500) }}</div>

	                      <div class="fecha_listado">

	                      </div>

	                    </div>

	                  </td>

	                </tr>

	              </tbody>

	            </table>

	          </div>

	          <hr style="height: 1px; background-color: #e5e5e5;" />

	        @endforeach

	        {{ $consultores->links('frontend.consultores.paginate')->with(array('consultores' => $consultores, 'data' => $data, 'route' => $route )) }}

		</div>

	@else

		{{ 'Não há profissionais cadastrados nesta área de atuação' }}

	@endif


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