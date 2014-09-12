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
{{HTML::script("assetsadmin/js/fullcalendar.min.js")}}
@stop

@section("title")
Courses
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Courses
@stop

@section("nameview")
    Add Course
@stop


@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="/dashboard/courses" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Add Category</h4>
                <div class="widgetcontent nopadding">
                    <form class="stdform stdform2" method="post" action="forms.html">
                            <p>
                                <label>First Name</label>
                                <span class="field"><input type="text" name="firstname" id="firstname2" class="input-xxlarge"></span>
                            </p>
                            
                            <p>
                                <label>Last Name</label>
                                <span class="field"><input type="text" name="lastname" id="lastname2" class="input-xxlarge"></span>
                            </p>
                            
                            <p>
                                <label>Email</label>
                                <span class="field"><input type="text" name="email" id="email2" class="input-xxlarge"></span>
                            </p>
                            
                            <p>
                                <label>Location <small>You can put your own description for this field here.</small></label>
                                <span class="field"><textarea cols="80" rows="5" name="location" id="location2" class="span5"></textarea></span>
                            </p>
                            
                            <p>
                                <label>Select</label>
                                <span class="field"><select name="selection" id="selection2" class="uniformselect">
                                    <option value="">Choose One</option>
                                    <option value="1">Selection One</option>
                                    <option value="2">Selection Two</option>
                                    <option value="3">Selection Three</option>
                                    <option value="4">Selection Four</option>
                                </select></span>
                            </p>
                                                    
                            <p class="stdformbutton">
                                <button class="btn btn-primary">Submit Button</button>
                                <button type="reset" class="btn">Reset Button</button>
                            </p>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop