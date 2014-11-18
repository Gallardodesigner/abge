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
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-tags"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.dates')}}
@stop

@section("nameview")
    {{Lang::get('display.add_event')}}
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/events" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                    </div>
                    </div>
                <h4 class="widgettitle">{{Lang::get('display.add_event')}}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post">
                            <p>
                                <label>{{ Lang::get('display.title') }}</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge"></span>
                            </p>
                            <p>
                                <label>{{Lang::get('dispay.uploads')}}</label>
                                <span class="field"><input type="checkbox" name="upload" value="true"/><em>{{Lang::get('reminders.check')}}</em></span>
                            </p>
                            
                            <p>
                                <label>{{ Lang::get('display.description') }}</label>
                                <span class="field"><textarea cols="80" rows="5" name="content" id="content" class="span6"></textarea></span>
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