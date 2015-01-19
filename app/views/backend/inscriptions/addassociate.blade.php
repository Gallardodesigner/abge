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
Associados
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Associados
@stop

@section("nameview")
    Inscrever Associado
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Atrás</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Inscrever Associado</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" id="register-form" method="post" enctype="multipart/form-data">
					    	<p>
								<label>Associados: </label>
								<span class="field">
									<select name="associado" required>
										<option value="0" selected>Selecione um associado</option>
										@foreach($associates as $associate)
											<option value="{{$associate->id_asociado}}">{{$associate->nombre_completo}}</option>
										@endforeach
									</select>
								</span>
							</p>
					    	<p>
								<label>Tipo: </label>
								<span class="field">
									<select name="usertype" required>
										<option value="0" selected>Selecione um tipo de inscrição</option>
										@foreach($usertypes as $usertype)
											@if($usertype->associate == 1)
												<option value="{{$usertype->id}}">{{$usertype->title}}</option>
											@endif
										@endforeach
									</select>
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