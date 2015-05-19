<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	{{ $page->title }}
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="courses-list">
		<div class="home_article">
          <div class="home_article_title texto_azul">
            {{ $page->title }}
          </div>
          {{ $page->content }}
        </div>
		
	</div>
@stop