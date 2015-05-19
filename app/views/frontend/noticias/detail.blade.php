<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	{{ $noticia->title }}
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="courses-list">
		<div class="home_article">
          	<div class="home_article_title texto_azul">
            	{{ $noticia->title }}
          	</div>
            <div class="addthis_toolbox addthis_default_style" style="margin-top: 10px">
		      	<a class="addthis_button_facebook"></a>
		      	<a class="addthis_button_twitter"></a>
		      	<a class="addthis_button_email"></a>
		      	<span class="addthis_separator">|</span>
		      	<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4bf320ab510bd283" class="addthis_button_expanded">More</a>
		    </div>
		    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4bf320ab510bd283"></script>

          {{ $noticia->body }}
        </div>
		
	</div>
@stop