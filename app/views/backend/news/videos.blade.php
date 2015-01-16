@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 -->
{{HTML::style("http://harvesthq.github.io/chosen/chosen.css")}}
{{HTML::script("http://harvesthq.github.io/chosen/chosen.jquery.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}
{{HTML::script("assetsadmin/js/wysiwyg.js")}}
<script>
 		
    jQuery(document).ready(function(){
    	jQuery('#date').datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy"
        });
        jQuery('.chzn-select').chosen();
        var db = jQuery('#dualselect').find('.ds_arrow button');	//get arrows of dual select
		var sel1 = jQuery('#dualselect select:first-child');		//get first select element
		var sel2 = jQuery('#dualselect select:last-child');			//get second select element
		
		sel2.empty(); //empty it first from dom.
		
		db.click(function(){
			var t = (jQuery(this).hasClass('ds_prev'))? 0 : 1;	// 0 if arrow prev otherwise arrow next
			if(t) {
				sel1.find('option').each(function(){
					if(jQuery(this).is(':selected')) {
						jQuery(this).attr('selected',false);
						var op = sel2.find('option:first-child');
						sel2.append(jQuery(this));
					}
				});	
			} else {
				sel2.find('option').each(function(){
					if(jQuery(this).is(':selected')) {
						jQuery(this).attr('selected',false);
						sel1.append(jQuery(this));
					}
				});		
			}
			return false;
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
    {{ Lang::get('display.add_video') }}
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
                <h4 class="widgettitle">{{ Lang::get('display.add_video') }}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                        <p>
                            <label>Videos</label>
                            <span class="formwrapper">
                                <select data-placeholder="Selecionar um Video..." class="chzn-select" multiple="multiple" style="width:100%;" tabindex="4" name="videos[]">
                                    @foreach( $videos as $video )
                                    	<option value="{{$video->id_video}}" {{ $news->hasVideo($video) ? 'selected' : '' }}>{{ $video->titulo_video}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </p>
                        </br>
                        <p class="pull-right">
                            <button class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn">Reset</button>
                        </p>
                        <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop