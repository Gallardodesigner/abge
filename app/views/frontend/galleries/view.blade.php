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
            <a rel="gallery_abge" title="" href="/uploads/photo_album/big_{{ $gallery->image }}">
            	<img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_{{ $gallery->image }}">
            </a>
          </div>          
        @endforeach
      @endif
                
                               <!--                  <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_139_frazao-003.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_139_frazao-003.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_138_frazao-002.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_138_frazao-002.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_137_frazao-001.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_137_frazao-001.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_141_frazao-005.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_141_frazao-005.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_142_frazao-006.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_142_frazao-006.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_143_frazao-007.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_143_frazao-007.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_144_frazao-008.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_144_frazao-008.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_145_frazao-009.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_145_frazao-009.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_146_frazao-010.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_146_frazao-010.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_147_frazao-011.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_147_frazao-011.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_148_frazao-012.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_148_frazao-012.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_149_frazao-013.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_149_frazao-013.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_150_frazao-014.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_150_frazao-014.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_151_frazao-015.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_151_frazao-015.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_152_frazao-016.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_152_frazao-016.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_153_frazao-017.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_153_frazao-017.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_154_frazao-018.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_154_frazao-018.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_155_frazao-019.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_155_frazao-019.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_156_frazao-020.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_156_frazao-020.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_157_frazao-021.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_157_frazao-021.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_158_frazao-022.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_158_frazao-022.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_159_frazao-023_red.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_159_frazao-023_red.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_160_frazao-024.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_160_frazao-024.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_161_frazao-025.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_161_frazao-025.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_162_frazao-026.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_162_frazao-026.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_163_frazao-027.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_163_frazao-027.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_164_frazao-028.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_164_frazao-028.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_165_frazao-028_red.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_165_frazao-028_red.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_166_frazao-029.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_166_frazao-029.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_167_frazao-030.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_167_frazao-030.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_168_frazao-030_red.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_168_frazao-030_red.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_169_frazao-031.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_169_frazao-031.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_170_frazao-032.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_170_frazao-032.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_171_frazao-033.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_171_frazao-033.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_172_frazao-034.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_172_frazao-034.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_173_frazao-035.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_173_frazao-035.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_174_frazao-036.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_174_frazao-036.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_175_frazao-037.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_175_frazao-037.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_176_frazao-038.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_176_frazao-038.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_177_frazao-039.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_177_frazao-039.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_178_frazao-040.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_178_frazao-040.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_179_frazao-041.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_179_frazao-041.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_180_frazao-043.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_180_frazao-043.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_181_frazao-043_red.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_181_frazao-043_red.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_182_frazao-044.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_182_frazao-044.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_183_frazao-045.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_183_frazao-045.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_184_frazao-046.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_184_frazao-046.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_185_frazao-047.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_185_frazao-047.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_186_frazao-048.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_186_frazao-048.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_187_frazao-049.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_187_frazao-049.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_188_frazao-050.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_188_frazao-050.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_189_frazao-051.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_189_frazao-051.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_190_frazao-052.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_190_frazao-052.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_191_frazao-053.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_191_frazao-053.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_192_frazao-054.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_192_frazao-054.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_193_frazao-054_red.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_193_frazao-054_red.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_194_frazao-056.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_194_frazao-056.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_195_frazao-057.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_195_frazao-057.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_196_frazao-058.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_196_frazao-058.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_197_frazao-059.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_197_frazao-059.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_198_frazao-060.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_198_frazao-060.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_200_frazao-060_red.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_200_frazao-060_red.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_201_frazao-061.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_201_frazao-061.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_202_frazao-062.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_202_frazao-062.jpg"></a>                                  </div>
                                               
                               <div class="listGallery" style="width: 222px; float: left; min-height: 190px;">
                                                 <a rel="gallery_abge" title="" href="/uploads/photo_album/big_203_frazao-063.jpg"><img height="165" width="220" alt="" title="" src="/uploads/photo_album/medium_203_frazao-063.jpg"></a>                                  </div> -->
                
  </div>
  <div class="column span-17 last">
    <a href="{{ $route }}">Volver na lista</a>        
  </div>
                           
</div>
@stop