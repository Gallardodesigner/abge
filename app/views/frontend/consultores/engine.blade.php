<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Painel de Consultores
@stop

<!-- Contenido principal -->
@section("maincontent")

<div class="left_column" style="margin-bottom:62px">

	<div class="home_article">
		<div class="home_article_title texto_azul">
		    Painel de Consultores
		</div>
	</div>

	<div style="width:100%; text-align:left;margin-bottom:1em;">

		<style type="text/css">
			p {
			  margin: 0 0 0.7em !important;
			  line-height: 18px;
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
	  <input type="text" name="q" placeholder="Pesquisar" value="{{ $q }}" style="font-size:12px;height:26px;display:inline-block; width:35%; padding-left:10px" />
	  <select name="area_de_especializacion" style="font-size:12px;height:30px;display:inline-block;width:50%">
	    <option value="-1" {{ ($data == "-1") ? 'selected' : '' }}>Selecione a Área de Atuação - TODAS</option>
	    <optgroup label="OBRAS DE INFRAESTRUTURA">
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
	    <option value="7" {{ ($data == "7") ? 'selected' : '' }}>RECURSOS HIDRICOS</option>
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

	                  <td width="100" style="padding-left: 0;">
	    
	                    @if($classificados->classificados_imagem)
	                      {{ HTML::image('/uploads/classificados/'.$classificados->classificados_imagem, '', array('class'=>'borderImage', 'width' => '100')) }}
	                    @elseif($classificados->sexo != 2)
	                      {{ HTML::image('images/hombre.jpg', '', array('class'=>'borderImage', 'border' => '0', 'width' => '100')) }}
	                    @else:
	                      {{ HTML::image('images/mujer.jpg', '', array('class'=>'borderImage', 'border' => '0', 'width' => '100')) }}
	                    @endif
						<input type="hidden" name="sexo" value="{{$classificados->sexo}}">
	                  </td>

	                  <td width="3"></td>

	                  <td valign="top">

	                    <div style="position: relative; height: 130px;">
	                        <b>{{ $classificados->nombre_completo }}</b>
	                      <!-- <div><?php /*echo link_to($associados->getTitle(), '@permalink?nucleo='.$nucleo.'&secciones='.$sf_params->get('secciones').'&subseccion=detalle&permalink='.$associados->getIdNews().'-new', array('class' => 'titulo_listado')); */ ?></div>  -->

	                      <div class="summary">e-mail: 
							@if($classificados->light_email != null)
	                      		<a href="mailto:{{ $classificados->email }}">{{ $classificados->light_email }}</a> 
							@else
	                      		<a href="mailto:{{ $classificados->email }}">{{ $classificados->email }}</a> 
							@endif
	                      		| {{ 'Telefone: '}}
	                      		@if($classificados->telefone_com != '') 
	                      			{{ $classificados->ddi_com.' '.$classificados->telefone_com }} 
								@elseif($classificados->telefone_res != '')
	                      			{{ $classificados->ddi_res.' '.$classificados->telefone_res }} 
	                      		@else
	                      		{{ 'Sem telefone' }}
	                      		@endif
	                      	</div>
	                      <div class="summary" style="line-height:16px">{{ $classificados->classificados_conteudo }}</div>

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

	        {{ $consultores->links('frontend.consultores.engine_paginate')->with(array('consultores' => $consultores, 'data' => $data, 'route' => $route , 'q' => $q )) }}

		</div>

	@else

		{{ 'Não há profissionais cadastrados nesta área de atuação' }}

	@endif

	</div>


@stop