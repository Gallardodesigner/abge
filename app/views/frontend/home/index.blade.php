<?php setlocale(LC_TIME, 'portuguese');?>
<!-- Layout principal -->
@extends("frontend.layouts.home")

<!-- Titulo de la pagina -->
@section("title")
	ABGE - Home
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="home_article">
    <div class="home_article_title texto_azul" style="position: relative;">
      Notícias
    <div style="font-size: 12px; position: absolute; right: 0; top: 0;">
      <a class="link_ver_todos" href="/noticias">Ver Todas</a>  
    </div>
  </div>
  <div id="home_news_content" class="div_float">
    @if(count($principal)>0)
      @foreach($principal as $element)
        <div style="padding-bottom: 21px;border-bottom: 1px solid #e5e5e5;">
          <h5 style="font-size: 16px;font-family: Arial; color: #09F;">
            <a style="color: #09F;" href="/noticias/detalle/{{ $element->permalink }}">
              {{ $element->title }}            
            </a>    
          </h5>
          <div style="margin: 17px 0;">
            <a href="/noticias/detalle/{{ $element->permalink }}">
              <img title="{{ $element->title }}" alt="{{ $element->title }}" src="/uploads/news/medium_{{ $element->image }}">
            </a>
          </div>
          <span class="home_news_date">
            {{ iconv('ISO-8859-2', 'UTF-8',strftime('%d de %B de %Y', strtotime($element->date))) }} | 
            <a class="texto_gris_claro" href="/noticias/detalle/{{ $element->permalink }}">
              Ler mais
            </a>
          </span>
        </div>
      @endforeach
    @endif
    @if(count($news)>0)
      @foreach($news as $element)
        <div style="float: left; padding-top: 30px;">
          <div style="float: left; width: 96px; height: 72px;">
            <a href="/noticias/detalle/{{ $element->permalink }}">
              <img title="{{ $element->title }}" alt="" width="100" src="/uploads/news/small_{{ $element->image }}">            
            </a>
          </div>
          <div style="float: left; padding: 0 0 22px 19px; width: 285px; min-height: 72px; position: relative;">
            <h5>
              <a title="{{ $element->title }}" style="color: #09F;" href="/noticias/detalle/{{ $element->permalink }}">
                {{ $element->title }}                
              </a>
            </h5>
            <div class="home_news_date" style="bottom: 0; margin-top: 5px;">
              {{ iconv('ISO-8859-2', 'UTF-8',strftime('%d de %B de %Y', strtotime($element->date))) }} {{--|--}} 
              {{-- {{ date('d-m-Y', strtotime($element->date)) }}             --}}
              <a class="texto_gris_claro" href="/noticias/detalle/{{ $element->permalink }}">
                Ler mais
              </a>
            </div>
          </div>
        </div>
      @endforeach
    @endif
        <!-- 
        <div style="float: left; padding-top: 30px;">
          <div style="float: left; width: 96px; height: 72px;">
            <a href="/index.php/abge/noticias/detalle/171-Festa-do-dia-do-ge-logo">
              <img title="Festa do Dia do Geólogo" alt="" width="100" src="/uploads/news/small_171_cmb-dia-do-geologo.jpg">            
            </a>
          </div>
          <div style="float: left; padding: 0 0 22px 19px; width: 285px; min-height: 72px; position: relative;">
            <h5>
              <a title="Festa do Dia do Geólogo" style="color: #09F;" href="/index.php/abge/noticias/detalle/171-Festa-do-dia-do-ge-logo">
                Festa do Dia do Geólogo                
              </a>
            </h5>
            <div class="home_news_date" style="bottom: 0; margin-top: 5px;">
              14 de maio de 2015 | 
              14-05-2015              
              <a class="texto_gris_claro" href="/index.php/abge/noticias/detalle/171-Festa-do-dia-do-ge-logo">
                Ler mais
              </a>
            </div>
          </div>
        </div>
        <div style="float: left; padding-top: 30px;">
          <div style="float: left; width: 96px; height: 72px;">
            <a href="/index.php/abge/noticias/detalle/169-Mesa-redonda-especial-no-15-cbge-gest-o-de-riscos-e-resposta-a-desastres">
              <img title="Mesa Redonda Especial no 15º CBGE: Gestão de Riscos e resposta a desastres" alt="" width="100" src="/uploads/news/small_169_foto_fundo_marcadagu.jpg">            
            </a>
          </div>
          <div style="float: left; padding: 0 0 22px 19px; width: 285px; min-height: 72px; position: relative;">
            <h5>
              <a title="Mesa Redonda Especial no 15º CBGE: Gestão de Riscos e resposta a desastres" style="color: #09F;" href="/index.php/abge/noticias/detalle/169-Mesa-redonda-especial-no-15-cbge-gest-o-de-riscos-e-resposta-a-desastres">
                Mesa Redonda Especial no 15º CBGE: Gestão de Riscos e resposta a desastres                
              </a>
            </h5>
            <div class="home_news_date" style="bottom: 0; margin-top: 5px;">
              23 de abril de 2015 | 
              23-04-2015              
              <a class="texto_gris_claro" href="/index.php/abge/noticias/detalle/169-Mesa-redonda-especial-no-15-cbge-gest-o-de-riscos-e-resposta-a-desastres">
                Ler mais
              </a>
            </div>
          </div>
        </div>
         -->
      </div>  
    </div>
    <div class="home_article">
      <div class="home_article_title texto_azul" style="position: relative;">
        Eventos
        <div style="font-size: 12px; position: absolute; right: 0; top: 0;">
          <a class="link_ver_todos" href="/eventos">Ver Todos</a>  
        </div>
      </div>
      <div id="home_news_content" class="div_float">
        @if(count($courses)>0)
          @foreach($courses as $element)
            <div style="float: left; padding-top: 0px;">
              <div style="float: left; width: 60px; height: 72px;">
                <img class="borderImage" src="/uploads/courses/{{ $element->image }}" width="60">                      
              </div>        
              <div style="float: left; padding: 0 0 0px 19px; width: 320px; min-height: 60px; position: relative;">
                <h5>
                  <a title="{{ $element->title }}" style="color: #09F;" href="/{{ $element->route }}">
                    {{ $element->title }}                                
                  </a>
                </h5>
                {{ $element->description }}
                <br>
                <div class="home_news_date" style="margin-bottom: 10px; margin-top: 4px;     bottom: 0;">
                  {{ iconv('ISO-8859-2', 'UTF-8',strftime('%d de %B de %Y', strtotime($element->start))) }} | 
                  <a class="texto_gris_claro" href="/{{ $element->route }}">
                    Ler mais
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        @endif
        <!-- 
        <div style="float: left; padding-top: 0px;">
          <div style="float: left; width: 60px; height: 72px;">
            <img class="borderImage" src="/uploads/eventos/small_70_sefe82.jpg">                      
          </div>        
          <div style="float: left; padding: 0 0 0px 19px; width: 320px; min-height: 60px; position: relative;">
            <h5>
              <a title="Seminário de Engenharia de Fundações Especiais e Geotecnia - SEFE 8" style="color: #09F;" href="/index.php/abge/eventos/detalle/Seminario-De-Engenharia-De-Fundac--es-Especiais-E-Geotecnia---Sefe-8">
                Seminário de Engenharia de Fundações Especiais e Geotecnia - SEFE 8                               
              </a>
            </h5>
            23 a 25 de junho de 2015 
            Expo Transamérica Pavilhão D e E
            São Paulo-SP<br>
            <div class="home_news_date" style="margin-bottom: 10px; margin-top: 4px;     bottom: 0;">
              23 de junho de 2015 | 
              <a class="texto_gris_claro" href="/index.php/abge/eventos/detalle/Seminario-De-Engenharia-De-Fundac--es-Especiais-E-Geotecnia---Sefe-8">
                Ler mais
              </a>
            </div>
          </div>
        </div>
        <div style="float: left; padding-top: 0px;">
          <div style="float: left; width: 60px; height: 72px;">
            <img class="borderImage" src="/uploads/eventos/small_96_20-03-201511-22-33.jpg">                    
          </div>        
          <div style="float: left; padding: 0 0 0px 19px; width: 320px; min-height: 60px; position: relative;">
            <h5>
              <a title="Karst Symposium 2015, " style="color: #09F;" href="/index.php/abge/eventos/detalle/Karst-Symposium-2015-">
                Karst Symposium 2015,                                
              </a>
            </h5>
            May 26-29, 2015 - Perm State University (Russia, Perm) <br>
            <div class="home_news_date" style="margin-bottom: 10px; margin-top: 4px;     bottom: 0;">
              26 de maio de 2015 | 
              <a class="texto_gris_claro" href="/index.php/abge/eventos/detalle/Karst-Symposium-2015-">
                Ler mais
              </a>
            </div>
          </div>
        </div>
         -->
      </div>  
    </div>
@stop