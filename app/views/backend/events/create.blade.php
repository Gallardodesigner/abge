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
Courses
@stop

@section("iconpage")
<span class="iconfa-tags"></span>
@stop

@section("maintitle")
Event
@stop

@section("nameview")
    Add Event
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/events" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Add Event</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post">
                            <p>
                                <label>Title</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge"></span>
                            </p>
                            <p>
                                <label>Uploads</label>
                                <span class="field"><input type="checkbox" name="upload" value="true"/><em>Check/Uncheck this button to enable/disable the files upload</em></span>
                            </p>
                            
                            <p>
                                <label>Description</label>
                                <span class="field"><textarea cols="80" rows="5" name="content" id="content" class="span6"></textarea></span>
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