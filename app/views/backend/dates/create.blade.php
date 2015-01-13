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
{{ Lang::get('titles.courses') }}
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
{{ Lang::get('titles.dates')}}
@stop

@section("nameview")
    {{ Lang::get('display.add_date')}}
@stop


@section("MainContent")

<script type="text/javascript">
    jQuery(document).on('ready', function(){

        jQuery('#start').datepicker({
                defaultDate: "+1w",
            dateFormat: "dd-mm-yy",

              onClose: function( selectedDate ) {
                jQuery("#end" ).datepicker("option", "minDate", selectedDate );
            }
        });

        jQuery( "#end" ).datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
          onClose: function( selectedDate ) {
            jQuery( "#start" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
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
                <h4 class="widgettitle">{{ Lang::get('display.add_date')}}</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>{{ Lang::get('display.price')}}</label>
                                <span class="field"><input type="number" name="price" id="price"></span>
                            </p>
                            <p>
                                <label>{{Lang::get('display.data_start')}}</label>
                                <span class="field"><input type="input" name="start" id="start" class="datepicker"></span>
                            </p>
                            <p>
                                <label>{{Lang::get('display.data_end')}}</label>
                                <span class="field"><input type="input" name="end" id="end" class="datepicker"></span>
                            </p>
                            
                            <p>
                                <label>{{Lang::get('display.message')}}</label>
                                <span class="field"><textarea cols="80" rows="5" name="message" id="message" class="span6"></textarea></span>
                            </p>    
                             <p>
                                <label>{{ Lang::get('display.button_code')}}</label>
                                <span class="field"><input type="text" name="button" id="button" style="width:100%"/></textarea></span>
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