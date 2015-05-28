<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Noticias
@stop

<!-- Contenido principal -->
@section("maincontent")

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
		                      <div class="fecha_listado">{{ iconv('ISO-8859-2', 'UTF-8', strftime('%d de %B de %Y', strtotime($noticia->date))) }}</div>
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

@stop