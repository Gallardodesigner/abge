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
Participantes
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Participantes
@stop

@section("nameview")
    Adicionar Participante
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
                <h4 class="widgettitle">Adicionar Participante</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" id="register-form" method="post" enctype="multipart/form-data">
                            <p>
								<label>Nome: </label>
								<span class="field">
									<input type="text" name="nome" value="{{ $participant->nome }}"/>
								</span>
									<!-- 
								<input type="text" name="nome" required/> -->
							</p>
					    	<p>
								<label>Email: </label>
								<span class="field">
									<input type="email" name="email" value="{{ $participant->email }}"/>
								</span>
									<!-- 
								<input type="email" name="email" required/> -->
							</p>
					    	<p>
								<label>RG: </label>
								<span class="field">
									<input type="text" name="rg" value="{{ $participant->rg }}"/>
								</span>
							</p>
					    	<p>
								<label>CPF: </label>
								<span class="field">
									<input type="text" name="cpf" value="{{ $participant->cpf }}"/>
								</span>
									<!-- 
								<input type="text" name="cpf" required/> -->
							</p>
					    	<p>
								<label>Endereço: </label>
								<span class="field">
									<input type="text" name="endereco" value="{{ $participant->endereco }}"/>
								</span>
							</p>
					    	<p>
								<label>N°: </label>
								<span class="field">
									<input type="text" name="numero" value="{{ $participant->numero }}"/>
								</span>
							</p>
					    	<p>
								<label>Complemento: </label>
								<span class="field">
									<input type="text" name="complemento" value="{{ $participant->complemento }}"/>
								</span>
							</p>
					    	<p>
								<label>CEP: </label>
								<span class="field">
									<input type="text" name="cep" value="{{ $participant->cep }}"/>
								</span>
							</p>
					    	<p>
								<label>Estado: </label>
								<span class="field">
										<select name="estado" required>
									</span>
										<option value="0" selected>Selecione um estado</option>
										@foreach($estados as $state)
											<option value="{{$state->id_estado}}" {{ $participant->estado == $state->name_estado ? 'selected' : '' }}>{{$state->name_estado}}</option>
										@endforeach
									</select>
							</p>
					    	<p>
								<label>Cidade: </label>
								<span class="field">
									<input type="text" name="cidade" value="{{ $participant->cidade }}"/>
								</span>
							</p>
					    	<p>
								<label>Empresa: </label>
								<span class="field">
									<input type="text" name="empresa" value="{{ $participant->empresa }}"/>
								</span>
							</p>
					    	<p>
								<label>Telefone: </label>
								<span class="field">
									<input type="text" name="telefone" value="{{ $participant->telefone }}"/>
								</span>
							</p>
					    	<p>
								<label>Celular: </label>
								<span class="field">
									<input type="text" name="celular" value="{{ $participant->celular }}"/>
								</span>
							</p>
							<script>
							jQuery(document).on('ready', function(){
								console.log()
								jQuery('#register-form').on('submit', function(e){
									e.preventDefault();
									if(jQuery('select[name=estado]').val() == 0){
										alert('Selecione um estado');
										jQuery('select[name=estado]').focus();
										return false;
									}
									else{
										this.submit();
									}
								});
							});
							</script>
                            <p class="pull-right">
                                <button class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn">Reset</button>
                            </p>
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop