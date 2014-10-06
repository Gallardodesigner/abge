@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 -->
 <!-- {{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}} -->
<!-- {{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}} -->
<!-- {{HTML::script("assetsadmin/js/wysiwyg.js")}} -->
<script>
 
</script>
@stop

@section("title")
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
User Types
@stop

@section("nameview")
    Add User Types
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Edit User Types</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>{{ Lang::get('display.title')}}</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge" value="{{ $usertype->title }}"></span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.description')}}</label>
                                <span class="field"><input type="text" name="content" id="content" class="input-xxlarge" value="{{ $usertype->content }}"></span>
                            </p>
                            <p>
                                <label>Is Associate?</label>
                                <span class="field"><input type="checkbox" name="associate" id="associate" value="true" class="input-xxlarge" {{ $usertype->associate ? 'checked' : '' }}><em>Check this input to indicate that this user type is an associate</em></span>
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