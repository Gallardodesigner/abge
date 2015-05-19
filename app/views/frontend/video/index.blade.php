<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Videos
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="column span-24 last home_article">
        <h1>
            Vídeos                          
        </h1>
        <table style="width: 100%">
        </table>
        @if(count($videos))
        	@foreach($videos as $video)
		        <div class="frameVideo" style="width: 143px; height: 121px;">
		            <div class="video">
		                <a href="{{ $route }}/ver/{{ $video->getBitURI() }}">
		                    <img src="{{ $video->getYoutubeImage() }}" class="big">
		                </a>
		                <div style="margin-top: 15px;">
		                    <a href="{{ $route }}/ver/{{ $video->getBitURI() }}">
		                    {{ $video->titulo_video }}
		                    </a>
		                </div>
		            </div>
		        </div>        	
        	@endforeach
        @endif
	</div>
@stop