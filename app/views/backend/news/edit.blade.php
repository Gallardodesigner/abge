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
{{ Lang::get('titles.news') }}
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.news') }}
@stop

@section("nameview")
    {{ Lang::get('display.edit_new') }}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">{{ Lang::get('display.edit_new') }}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>{{ Lang::get('display.category') }}</label>
                                <span class="field">
									<select name="category">
										<option value="0" {{ $new->category == '0' ? 'selected' : '' }}>Foreground</option>
										<option value="1" {{ $new->category == '1' ? 'selected' : '' }}>Primary</option>
										<option value="2" {{ $new->category == '2' ? 'selected' : '' }}>Secodary</option>
									</select>
                                </span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.image') }}</label>
                                <span class="field"><input type="file" name="image" value="{{ $new->image }}"></span></span>
                            </p>
                            <p>
                                <label>{{ Lang::get('display.main_image') }}</label>
                                <span class="field"><input type="file" name="image_principal" value="{{ $new->imageprincipal }}"></span>
                            </p>                          
                            <p>
                                <label>{{ Lang::get('display.date') }}</label>
                                <span class="field"><input type="text" name="date" id="date" class="input-xxlarge" value="{{ date('d-m-Y', strtotime($new->date)) }}"></span>
                            </p>                     
                            <p>
                                <label>{{ Lang::get('display.title') }}</label>
                                <span class="field"><input type="text" name="title" id="title" class="input-xxlarge" value="{{ $new->title }}"></span>
                            </p>                       
                            <p>
                                <label>{{ Lang::get('display.sub_title') }}</label>
                                <span class="field"><input type="text" name="sub_title" id="sub_title" class="input-xxlarge" value="{{ $new->sub_title }}"></span>
                            </p>                     
                            <p>
                                <label>{{ Lang::get('display.home_title') }}</label>
                                <span class="field"><input type="text" name="home_title" id="home_title" class="input-xxlarge" value="{{ $new->home_title }}"></span>
                            </p>                  
                            <p>
                                <label>{{ Lang::get('display.summary') }}</label>
                                <span class="field"><textarea cols="80" rows="5" name="summary" id="summary" class="span6">{{ $new->summary }}</textarea></span>
                            </p>                  
                            <p>
                                <label>{{ Lang::get('display.body') }}</label>
                                <span class="field"><textarea cols="80" rows="5" name="body" id="body" class="span6">{{ $new->body }}</textarea></span>
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