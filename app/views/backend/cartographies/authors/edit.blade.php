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
Editar Autor de Cartografía
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Editar Autor de Cartografía
@stop

@section("nameview")
    Editar
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
                <h4 class="widgettitle">Editar Autor de Cartografía: {{ $cartography->work_title }}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Nome</label>
                                <span class="field"><input type="text" name="first_name" value="{{$cartography_author->first_name}}"/></span>
                            </p>
                            <p>
                                <label>Nome do Meio</label>
                                <span class="field"><input type="text" name="middle_name" value="{{$cartography_author->middle_name}}"/></span>
                            </p>
                            <p>
                                <label>Sobrenome</label>
                                <span class="field"><input type="text" name="last_name" value="{{$cartography_author->last_name}}"/></span>
                            </p>
                            <p>
                                <label>Instituição</label>
                                <span class="field"><input type="text" name="institution" value="{{$cartography_author->institution}}"/></span>
                            </p>
                            <p>
                                <label>Email</label>
                                <span class="field"><input type="text" name="email" value="{{$cartography_author->email}}"/></span>
                            </p>
                            <p class="pull-right">
                                <button class="btn btn-primary">Atualizar</button>
                                <button type="reset" class="btn">Limpiar</button>
                            </p>
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop