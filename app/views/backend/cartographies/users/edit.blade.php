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
Editar CArtografías
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Editar CArtografías
@stop

@section("nameview")
    Editar
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
                <h4 class="widgettitle">Editar Cartografía</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Username</label>
                                <span class="field"><input type="text" name="username" value="{{$cartography_user->username}}" readonly/></span>
                            </p>
                            <p>
                                <label>Email</label>
                                <span class="field"><input type="text" name="email" value="{{$cartography_user->email}}" readonly/></span>
                            </p>
                            <p>
                                <label>Nome</label>
                                <span class="field"><input type="text" name="name" value="{{$cartography_user->name}}"/></span>
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
                                		<option value="Registered" {{ $cartography_user->usertype == 'Registered' ? 'selected' : '' }}>Cadastrado</option>
                                		<option value="Super Administrador" {{ $cartography_user->usertype == 'Super Administrador' ? 'selected' : '' }}>Super Admin</option>
                                	</select>
                                </span>
                            </p> 
                            <p class="pull-right">
                                <button class="btn btn-primary">Atualizar</button>
                                <button type="reset" class="btn">Limpiar</button>
                            </p>
                            <div class="clearfix"></div>
                    </form>
                </div><!--widgetcontent-->
            </div>
    

                
@stop