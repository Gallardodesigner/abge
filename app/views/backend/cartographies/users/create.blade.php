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
 		
    jQuery(document).ready(function(){
    	jQuery('#date').datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy"
        });
    });
</script>
@stop

@section("title")
Adicionar Usuario do Cartografïa
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Adicionar Usuario do Cartografïa
@stop

@section("nameview")
    Adicionar
@stop

@section("MainContent")
<div class="maincontent">
            <div class="maincontentinner">
            
                <!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
                <div class="widgetbox">
                <div class="headtitle">
                    <div class="btn-group">
                        <a href="{{ $route }}" class="btn dropdown-toggle">Voltar</a>
                    </div>
                    </div>
                <h4 class="widgettitle">Adicionar Usuario do Cartografïa</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Nome</label>
                                <span class="field"><input type="text" name="name"/></span>
                            </p>
                            <p>
                                <label>Username</label>
                                <span class="field"><input type="text" name="username"/></span>
                            </p>
                            <p>
                                <label>Correo</label>
                                <span class="field"><input type="email" name="email"/></span>
                            </p>
                            <p>
                                <label>Senha</label>
                                <span class="field"><input type="text" name="password_1"/></span>
                            </p>
                            <p>
                                <label>Repita a Senha</label>
                                <span class="field"><input type="text" name="password_2"/></span>
                            </p>
                            <p>
                                <label>Tipo de Usuario</label>
                                <span class="field">
                                	<select name="usertype" required>
                                		<option value>---SELECIONE UM TIPO DE USUARIO ---</option>
                                		<option value="Registered">Cadastrado</option>
                                		<option value="Super Administrador">Super Admin</option>
                                	</select>
                                </span>
                            </p>
                            <p class="pull-right">
                                <button class="btn btn-primary">Adicionar</button>
                                <button type="reset" class="btn">Limpiar</button>
                            </p>
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop