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
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
Teacher
@stop

@section("nameview")
    Edit Teacher
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/companies" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Edit Teacher</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Picture</label>
                                <span class="field"><img class="rounded" src="/uploads/thumb_{{$teacher->url}}"/><input type="file" name="url" id="url" class="btn btn-primary"></span>
                            </p>
                            <p>
                                <label>Name</label>
                                <span class="field"><input type="text" name="name" id="name" class="input-xxlarge" value="{{$teacher->name}}"></span>
                            </p>
                            <p>
                                <label>Lastname</label>
                                <span class="field"><input type="text" name="lastname" id="lastname" class="input-xxlarge" value="{{$teacher->lastname}}"></span>
                            </p>
                            
                            <p>
                                <label>Description</label>
                                <span class="field"><textarea cols="40" rows="5" name="content" id="content" class="span6">{{$teacher->content}}</textarea></span>
                            </p>    
                             <p>
                                <label>Contact</label>
                                <span class="field"><textarea cols="40" rows="5" name="contact" id="contact" class="span6">{{$teacher->contact}}</textarea></span>
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