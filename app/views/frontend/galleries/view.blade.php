<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	{{ $album->album_name }}
@stop

<!-- Contenido principal -->
@section("maincontent")
	<div class="column span-24 last home_article">
    <h1>
        Galeria de Fotos                          
    </h1>
    <table style="width: 100%">
    </table>

    <link rel="stylesheet" type="text/css" href="/assets/fancybox/jquery.fancybox.css">

    <script type="text/javascript" src="/assets/fancybox/jquery.fancybox.js"></script>
           
    <script type="text/javascript">
        $(document).ready(function() {
          $("a[rel=gallery_abge]").fancybox({
            'transitionIn'	: 'none',
            'transitionOut'	: 'none',
            'titlePosition' 	: 'over'
          });
        });
    </script>
    <div class="column span-17 last">
      <h2>{{ $album->album_name}}</h2>
      <div style="width: 90%; margin-bottom: 15px; ">
        {{ $album->leyenda }}                 
      </div>
      
      @if(count($galleries)>0)
        @foreach( $galleries as $gallery )
          <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
            <a rel="gallery_abge" title="" href="/uploads/photo_album/big_{{ $gallery->image }}" style="height: 165px;display: block;text-align: center;background: currentColor;">
            	<img alt="" title="" src="/uploads/photo_album/medium_{{ $gallery->image }}" height="165">
            </a>
          </div>          
        @endforeach
      @endif
                
  </div>
  <div class="column span-17 last">
    <a href="{{ $route }}">Volver na lista</a>        
  </div>
                           
</div>
@stop