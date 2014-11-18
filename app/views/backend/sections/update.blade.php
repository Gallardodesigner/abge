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
Sections
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
Section
@stop

@section("nameview")
    {{ Lang::get('display.edit_section') }}
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/sections" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                    </div>
                    </div>
                <h4 class="widgettitle">{{ Lang::get('display.edit_section') }}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post">
                            
                            <p>
                                <label>{{ Lang::get('display.title') }}</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge" value="{{$section->title}}"></span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.description') }}</label>
                                <span class="field"><textarea cols="40" rows="5" name="description" id="description" class="span6">{{$section->description}}</textarea></span>
                            </p>    
                             <p>
                                <label>File to download?</label>
                                <span class="field"><input type="checkbox" name="file" <?php ($section->file) ? "checked value='true'" : "value='false'";?>></span>
                            </p>                            
                            <p class="pull-right">
                                <button class="btn btn-primary">{{ Lang::get('display.submit') }}</button>
                                <button type="reset" class="btn">{{ Lang::get('display.reset') }}</button>
                            </p>
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop