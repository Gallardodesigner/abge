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
Adicionar Cartografía
@stop

@section("iconpage")
<span class="iconfa-book"></span>
@stop

@section("maintitle")
Adicionar Cartografía
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
                <h4 class="widgettitle">Adicionar Cartografía</h4>
                <div class="widgetcontent">
                    <form class="stdform stdform2" method="post" enctype="multipart/form-data">
                            <p>
                                <label>Usuario</label>
                                <span class="field">
                                	<select name="user_id" required>
                                		<option value="1">---SELECIONE UM USUARIO---</option>
                                        @if($cartography_users)
                                            @foreach($cartography_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                	</select>
                                </span>
                            </p>
                            <p>
                                <label>Título do Trabalho</label>
                                <span class="field"><input type="text" name="work_title"/></span>
                            </p>
                            <p>
                                <label>Região do Trabalho</label>
                                <span class="field"><input type="text" name="region"/></span>
                            </p>
                            <p>
                                <label>Escala do Trabalho</label>
                                <span class="field"><input type="text" name="scale"/></span>
                            </p>
                            <p>
                                <label>Município do Trabalho</label>
                                <span class="field"><input type="text" name="backyard"/></span>
                            </p>
                            <p>
                                <label>Palavras Chaves</label>
                                <span class="field"><textarea rows="5" class="span6" cols="20" name="keywords"></textarea></span>
                            </p>
                            <p>
                                <label>Mapas Gerados</label>
                                <span class="field"><textarea rows="5" class="span6" cols="20" name="maps"></textarea></span>
                            </p>
                            <p>
                                <label>Ensaios Geotécnicos</label>
                                <span class="field"><input type="text" name="geotechnical_testing"/></span>
                            </p>
                            <p>
                                <label>Instituição</label>
                                <span class="field"><input type="text" name="institution"/></span>
                            </p>
                            <p>
                                <label>Ano</label>
                                <span class="field"><input type="text" name="year"/></span>
                            </p>
                            <p>
                                <label>Páginas</label>
                                <span class="field"><input type="text" name="pages"/></span>
                            </p>
                            <p>
                                <label>Área de Concentração</label>
                                <span class="field"><input type="text" name="concentration"/></span>
                            </p>
                            <p>
                                <label>Unidade de Ensino</label>
                                <span class="field"><input type="text" name="teaching_unit"/></span>
                            </p>
                            <p>
                                <label>Institucao do Cartografía</label>
                                <span class="field"><input type="text" name="cartography_institution"/></span>
                            </p>
                            <p>
                                <label>Local da Publicação</label>
                                <span class="field"><input type="text" name="locale"/></span>
                            </p>
                            <p>
                                <label>Subtítulo</label>
                                <span class="field"><input type="text" name="subtitle"/></span>
                            </p>
                            <p>
                                <label>Ano da Aprovação</label>
                                <span class="field"><input type="text" name="approval_year"/></span>
                            </p>
                            <p>
                                <label>Resumo</label>
                                <span class="field"><textarea rows="5" class="span6" cols="20" name="summary"></textarea></span>
                            </p>
                            <p>
                                <label>Link para a Publicação</label>
                                <span class="field"><input type="text" name="link"/></span>
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