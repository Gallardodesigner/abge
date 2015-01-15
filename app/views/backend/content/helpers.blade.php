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
{{HTML::style("assetsadmin/js/chosen/chosen.min.css")}}
{{HTML::script("assetsadmin/js/chosen/chosen.jquery.min.js")}}
{{HTML::script("assetsadmin/js/chosen/chosen.proto.min.js")}}
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
Helpers
@stop

@section("nameview")
    Add Helpers
@stop


@section("MainContent")
<script type="text/javascript">
    jQuery(document).on('ready', function(){
        jQuery('.chosen-select').chosen({no_results_text: "Oops, nothing found!"});
    });
</script>
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Edit Helpers</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                        <p>
                            <label>{{ $content->section->title }}</label>
                            <span class="field">
                                
                                @if (isset($helpers))
                                    <select class="chosen-select" name="helpers[]" multiple>
                                    @foreach ($helpers as $helper)
                                        <?php $bandera = false; ?>
                                        @foreach($course->helpers as $prom)
                                            @if($prom->id == $helper->id)
                                                 <?php $bandera = true; ?>
                                            @endif
                                        @endforeach
                                        @if($bandera)
                                            <option type="checkbox" value="{{$helper->id}}" selected>{{$helper->title}}</option><br />
                                        @else
                                             <option type="checkbox"value="{{$helper->id}}">{{$helper->title}}</option><br />
                                        @endif
                                    @endforeach
                                    </select>
                                @endif
                            </span>
                        </p>   
                        <p>
                            <label>{{ Lang::get('display.content') }}</label>
                            <span class="field"><textarea type="text" name="content" id="content" class="input-xxlarge">{{ $content->content }}</textarea></span>
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