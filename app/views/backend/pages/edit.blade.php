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
{{ Lang::get('Páginas') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
{{ Lang::get('Páginas') }}
@stop

@section("nameview")
    {{ Lang::get('Atualizar Página') }}
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
                <h4 class="widgettitle">{{ Lang::get('Atualizar Página') }}</h4>

                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Permalink</label>
                                <span class="field"><input type="text" name="name" id="name" class="input-xxlarge" value="{{ $page->name }}" required></span>
                            </p>  
                            <p>
                                <label>Titulo</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge" value="{{ $page->title }}" required></span>
                            </p> 
                            <p>
                                <label>Conteúdo</label>
                                <span class="field"><textarea name="content">{{ $page->content }}</textarea></span></span>
                            </p>
                            <p>
                                <label>URL Externa <br><em>(No es obligatorio)</em></label>
                                <span class="field"><input type="text" name="url" id="url" class="input-xxlarge" value="{{ $page->url }}"></span>
                            </p>  
                            <p>
                                <label>Status</label>
                                <span class="field">
									<select name="status">
										<option value="active" {{ $page->status == 'active' ? 'selected' : '' }}>Habilitado</option>
										<option value="inactive" {{ $page->status == 'inactive' ? 'selected' : '' }}>Deshabilitado</option>
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