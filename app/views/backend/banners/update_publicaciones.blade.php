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
 
</script>
@stop

@section("title")
Publicações
@stop

@section("iconpage")
<span class="iconfa-briefcase"></span>
@stop

@section("maintitle")
Publicações
@stop

@section("nameview")
    Atualizar Publicações
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}/publicaciones" class="btn dropdown-toggle">Voltar</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Atualizar Publicações</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Imagem do Publicações</label>
                                <span class="field"><img class="rounded" src="/{{ Banners::$images_folder }}thumb_{{$banner->image}}"/><input type="file" name="image" id="image" class="btn btn-primary"></span>
                            </p>
                            <p>
                                <label>Nome</label>
                                <span class="field"><input type="text" name="name" id="name" class="input-xxlarge" value="{{$banner->name}}"></span>
                            </p>  
                            <p>
                                <label>URL</label>
                                <span class="field"><input type="text" name="url" id="url" class="input-xxlarge" value="{{$banner->url}}"></span>
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