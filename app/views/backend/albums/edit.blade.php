@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 -->
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}
{{HTML::script("assetsadmin/js/wysiwyg.js")}}
<script>
 		
    jQuery(document).ready(function(){
    	jQuery('#date').datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy"
        });
    });
</script>
@stop

@section("title")
Galerias
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Galerias
@stop

@section("nameview")
    Atualiza Galeria
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Voltar</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Atualiza Galeria</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">                    
                            <p>
                                <label>Nome</label>
                                <span class="field"><input type="text" name="album_name" id="album_name" class="input-xxlarge" value="{{ $album->album_name }}"></span>
                            </p>                           
                            <p>
                                <label>Leyenda</label>
                                <span class="field">
                                <textarea name="leyenda">{{ $album->leyenda }}</textarea>
                                </span>
                            </p>                 
                            <p>
                                <label>Fecha</label>
                                <span class="field"><input type="text" name="fecha" id="date" class="input-xxlarge" value="{{ date('d-m-Y', strtotime($album->fecha)) }}"></span>
                            </p> 
                            <p class="pull-right">
                                <button class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn">Reset</button>
                            </p>    
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop