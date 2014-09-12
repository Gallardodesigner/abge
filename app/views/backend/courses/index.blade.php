@extends("backend.layout")

@section("css")
{{HTML::style("assetsadmin/css/bootstrap-fileupload.min.css")}}
{{HTML::style("assetsadmin/css/bootstrap-timepicker.min.css")}}

@stop


@section("js")
{{HTML::script("assetsadmin/js/tinymce/jquery.tinymce.js")}}
{{HTML::script("assetsadmin/js/tinymce/tiny_mce.js")}}

{{HTML::script("assetsadmin/js/wysiwyg.js")}}
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div>
                    <textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%" class="tinymce">
                        &lt;p&gt;
                            This is some example text that you can edit inside the &lt;strong&gt;TinyMCE editor&lt;/strong&gt;.
                        &lt;/p&gt;
                    </textarea>
                </div>
                <br />
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="reset" name="reset" class="btn">Reset</button>
                
@stop