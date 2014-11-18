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

 
@stop

@section("title")
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.supporters')}}
@stop

@section("nameview")
    {{ Lang::get('display.add_supporter')}}
@stop


@section("MainContent")

<script type="text/javascript">
    jQuery(document).on('ready', function(){
        jQuery('.chosen-select').chosen({no_results_text: "{{ Lang::get('display.nothing_found')}}"});
    });
</script>
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">{{ Lang::get('display.back') }}</a>
                    </div>
                    </div>
                <h4 class="widgettitle">{{ Lang::get('display.edit_supporter')}}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                        <p>
                            <label>{{ $content->section->title }}</label>
                            <span class="field">
                                
                                @if (isset($supporters))
                                    <select class="chosen-select" name="supporters[]" multiple>
                                    @foreach ($supporters as $supporter)
                                        <?php $bandera = false; ?>
                                        @foreach($course->supporters as $supp)
                                            @if($supp->id == $supporter->id)
                                                 <?php $bandera = true; ?>
                                            @endif
                                        @endforeach
                                        @if($bandera)
                                            <option type="checkbox" value="{{$supporter->id}}" selected>{{$supporter->title}}</option><br />
                                        @else
                                             <option type="checkbox"value="{{$supporter->id}}">{{$supporter->title}}</option><br />
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
                            <button class="btn btn-primary">{{ Lang::get('display.submit') }}</button>
                            <button type="reset" class="btn">{{ Lang::get('display.reset') }}</button>
                        </p>
                        <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop