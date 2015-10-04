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
<span class="iconfa-briefcase"></span>
@stop

@section("maintitle")
Company
@stop

@section("nameview")
    Add Company
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
                <h4 class="widgettitle">Add Company</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Logo</label>
                                <span class="field"><img class="rounded" src="/uploads/thumb_{{$company->url}}"/><input type="file" name="url" id="url" class="btn btn-primary"></span>
                            </p>
                            <p>
                                <label>URL</label>
                                <span class="field"><input type="text" name="route" id="route" class="input-xxlarge"></span>
                            </p>
                            <p>
                                <label>Title</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge" value="{{$company->title}}"></span>
                            </p>
                            
                            <p>
                                <label>Description</label>
                                <span class="field"><textarea cols="40" rows="5" name="content" id="content" class="span6">{{$company->content}}</textarea></span>
                            </p>    
                             <p>
                                <label>Address</label>
                                <span class="field"><textarea cols="40" rows="5" name="address" id="address" class="span6">{{$company->address}}</textarea></span>
                            </p>
                             <p>
                                <label>Contact</label>
                                <span class="field"><textarea cols="40" rows="5" name="contact" id="contact" class="span6">{{$company->contact}}</textarea></span>
                            </p>  
                            <p>
                                <label>Banner</label>
                                <span class="field">
                                    Patrocinadores <input type="checkbox" name="type[]" value="patrocinadores" {{ Str::contains($company->type, 'patrocinadores' ) ? 'checked' : '' }} />
                                    Apoio <input type="checkbox" name="type[]" value="apoio"{{ Str::contains($company->type, 'apoio' ) ? 'checked' : '' }}/>
                                    Parceiros <input type="checkbox" name="type[]" value="parceiros"{{ Str::contains($company->type, 'parceiros' ) ? 'checked' : '' }}/>
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