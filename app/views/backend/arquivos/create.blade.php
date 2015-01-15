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
{{ Lang::get('titles.arquivos') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.arquivos') }}
@stop

@section("nameview")
    {{ Lang::get('display.add_arquivo') }}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">{{ Lang::get('display.add_arquivo') }}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Titulo Arquivo</label>
                                <span class="field"><input type="text" name="titulo_archivo" id="title" class="input-xxlarge"></span>
                            </p>                       
                            <p>
                                <label>Categoria</label>
                                <span class="field">
									<select name="id_categoria">
										<option value="0">General</option>
										<option value="6">Prueba</option>
									</select>
                                </span>
                            </p>
                            <p>
                                <label>Arquivo associado</label>
                                <span class="field"><input type="file" name="archivo" value="true"></span></span>
                            </p>
                            <p>
                                <label>Imagen associada</label>
                                <span class="field"><input type="file" name="imagen" value="true"></span>
                            </p>               
                            <p>
                                <label>Resumem</label>
                                <span class="field"><textarea cols="80" rows="5" name="resumem" id="resumem" class="span6"></textarea></span>
                            </p>                         
                            <p>
                                <label>Selecione</label>
                                <span class="field">
									<select name="tipo_archivo">
										<option value="1">Arquivos de seções</option>
										<option value="2">Arquivos restritos para associados</option>
									</select>
                                </span>
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