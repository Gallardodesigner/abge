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
Teacher
@stop

@section("nameview")
    Add Teacher
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/teachers" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Add Teacher</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Picture</label>
                                <span class="field"><input type="file" name="url" id="url" class="btn btn-primary"></span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.name') }}</label>
                                <span class="field"><input type="text" name="firstName" id="firstName" class="input-xxlarge"></span>
                            </p>
                            <p>
                                <label>Lastname</label>
                                <span class="field"><input type="text" name="lastName" id="lastName" class="input-xxlarge"></span>
                            </p>
                            
                            <p>
                                <label>{{ Lang::get('display.description') }}</label>
                                <span class="field"><textarea cols="80" rows="5" name="content" id="content" class="span6"></textarea></span>
                            </p>    
                             <p>
                                <label>Contact</label>
                                <span class="field"><textarea cols="80" rows="5" name="contact" id="contact" class="span6"></textarea></span>
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