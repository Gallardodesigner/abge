<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Galeria de Fotos
@stop

<!-- Contenido principal -->
@section("maincontent")

	<?php setlocale(LC_TIME, 'portuguese');?>

	<div class="column span-24 last home_article">
        <h1>Galeria de Fotos</h1>
        <table style="width: 100%"></table>
        @if(count($albums)>0)
        	@foreach( $albums as $album )
            @if($album->galleries->count() > 0)
  		        <div class="contentPrviewAlbum">
  		            <a title="" href="{{ $route }}/ver/{{ $album->getBitURI() }}" style="display: block;height: 165px;overflow: hidden;">
  		            	<img width="220" alt="" title="" src="/uploads/photo_album/medium_{{ $album->getFirstImageURI() }}">
  		            </a>                    
  			        <div>
  				        <label>Album:</label> {{ $album->album_name }}<br>
  				        <label>Total: </label>{{ count($album->galleries) }} fotos<br>
  				        <label>Data: </label>{{ iconv('ISO-8859-2', 'UTF-8', strftime('%d de %B del %Y', strtotime($album->fecha))) }}<br>
  		            </div>
  		        </div>
            @endif
        	@endforeach
        @endif
               <!--                                  <div class="contentPrviewAlbum">
                                   <a title="" href="/index.php/abge/gallery/27-"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_207_dsc02950.jpg"></a>                    <div>
                                       <label>Album:</label> Mesa Redonda Sondagens – Método, Procedimentos, Qualidade<br>
                                       <label>Total: </label>36 fotos<br>
                   <label>Data: </label>19 de junho de 2013 <br>
                                                           </div>
                               </div>
               <div class="contentPrviewAlbum">
                                   <a title="" href="/index.php/abge/gallery/28-45Anos"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_244_2.gif"></a>                    <div>
                                       <label>Album:</label> 45 Anos<br>
                                       <label>Total: </label>40 fotos<br>
                   <label>Data: </label>4 de setembro de 2013 <br>
                                                           </div>
                               </div> -->
                                               
</div>
@stop