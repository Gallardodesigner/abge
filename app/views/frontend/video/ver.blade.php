<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	{{ $video->titulo_video }}
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="column span-24 last home_article">
        <h1>
            Vídeos                          
        </h1>
        <table style="width: 100%">
        </table>
	    <div class="column span-17 last">
	        <h2>{{ $video->titulo_video }}</h2>
	        <object width="719" height="438">
	            <param name="movie" value="{{ $video->getYoutubeEmbbed() }}">
	            <param name="wmode" value="transparent">
	            <embed src="{{ $video->getYoutubeEmbbed() }}" type="application/x-shockwave-flash" wmode="transparent" width="719" height="438">
	            
	        </object>
	    </div>
	    <div class="column span-17 last">
	    	<br>
	    	<br>
            <a href="{{ $route }}">Volta para a lista</a>    
        </div>                       
	</div>
@stop