@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
<!-- <script src="http://tinymce.cachefly.net/4.1/jquery.tinymce.min.js"></script>
<script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

 {{HTML::script("assetsadmin/js/tiny_mce/jquery.tinymce.min.js")}}
{{HTML::script("assetsadmin/js/tiny_mce/tinymce.js")}}
{{HTML::script("assetsadmin/js/wysiwyg.js")}}
 -->
<script>
 
</script>
@stop

@section("title")
Dates
@stop

@section("iconpage")
<span class="iconfa-user-md"></span>
@stop

@section("maintitle")
Date
@stop

@section("nameview")
    Edit Date
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
                        <a href="{{ $route }}" class="btn dropdown-toggle">Back</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Edit Date</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Price</label>
                                <span class="field"><input type="number" name="price" id="price" value="{{ $date->price }}"></span>
                            </p>
                            <p>
                                <label>Start date</label>
                                <span class="field"><input type="input" name="start" id="start" class="datepicker" value="{{ $date->start }}"></span>
                            </p>
                            <p>
                                <label>End Date</label>
                                <span class="field"><input type="input" name="end" id="end" class="datepicker" value="{{ $date->end }}"></span>
                            </p>
                            
                            <p>
                                <label>Message</label>
                                <span class="field"><textarea cols="80" rows="5" name="message" id="message" class="span6">{{ $date->message }}</textarea></span>
                            </p>    
                             <p>
                                <label>Button Code</label>
                                <span class="field"><textarea cols="80" rows="5" name="button" id="button" class="span6">{{ $date->button }}</textarea></span>
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