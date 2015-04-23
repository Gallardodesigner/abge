<form id="atualizarescolaridade">
    <div>
        <h4 class="widgettitle">Atualizar Escolaridade</h4>
        <p>
            <label class="control-label">Tipo de graduação</label>
            <span class="field">
                <select class="form-control" name="tipo_graduacion" id="asociados_datos_academicos_tipo_graduacion">
                    <option value="0" {{ $academic->tipo_graduacion == '0' ? 'selected' : '' }}>DOUTORADO</option>
                    <option value="1" {{ $academic->tipo_graduacion == '1' ? 'selected' : '' }}>ESPECIALIZAÇÃO</option>
                    <option value="2" {{ $academic->tipo_graduacion == '2' ? 'selected' : '' }}>GRADUAÇÃO</option>
                    <option value="3" {{ $academic->tipo_graduacion == '3' ? 'selected' : '' }}>MESTRADO</option>
                    <option value="4" {{ $academic->tipo_graduacion == '4' ? 'selected' : '' }}>PÓS-GRADUAÇÃO</option>
                </select>
            </span>
        </p>
        <p>
            <label class="control-label">Instituição:</label>
            <span class="field"><input type="text" name="institucion" id="institucion" class="form-control" value="{{ $academic->institucion }}"/></span>
        </p>
        <p>
            <label class="control-label">Faculdade:</label>
            <span class="field"><input type="text" name="facultad" id="facultad" class="form-control" value="{{ $academic->facultad }}"/></span>
        </p>
        <p>
            <label class="control-label">Formação:</label>
            <span class="field">
                @if (isset($formacoes))
                    <select class="form-control" name="curso_realizado">
                        @foreach ($formacoes as $formacao)
                            <option value="{{$formacao->id}}" {{ $academic->curso_realizado == $formacao->id ? 'selected' : '' }}>{{$formacao->nome}}</option>
                        @endforeach
                    </select>
                @endif
            </span>
        </p>
        <p>
            <label class="control-label">Ano de início</label>
            <span class="field"><input type="text" name="ano_inicio" id="ano_inicio" class="form-control" value="{{ $academic->ano_inicio }}"/></span>
        </p>
        <p>
            <label class="control-label">Ano de finalização</label>
            <span class="field"><input type="text" name="ano_finalizacion" id="ano_finalizacion" class="form-control" value="{{ $academic->ano_finalizacion }}" /></span>
        </p> 
        <p>
            
            <span class="right"><input type="submit" class="btn btn-primary" value="Atualizar"/></span>
        </p>  
    </div>
</form>
<div id="loader_container" style="display:none; ">
	<img src="/assets/fancybox/fancybox_loading.gif" id="loading_image"/>
</div>
<style type="text/css">
	#loader_container{
		width: 100%;
		height: 300px;
		padding-top: 150px;
		display:none;
		background-color: rgba(255,255,255,0.2);
		background-position: cover;
		text-align:center;
		vertical-align: middle;
	}
</style>

<script type="text/javascript">
    jQuery('#atualizarescolaridade').on('submit', function(e){
    	jQuery('#atualizarescolaridade').ajaxStart(function(e){
    		jQuery('#atualizarescolaridade').css({
    			'display':'none'
    		});
    		jQuery('#loader_container').css({
    			'display':'block'
    		});
    	});
    	jQuery('#atualizarescolaridade').ajaxStop(function(e){
    		jQuery('#loader_container').css({
    			'display':'none'
    		});
    	});
    	e.preventDefault();
    	jQuery.ajax({
    		url: '/ajax/atualizarescolaridade/{{ $academic->id_datos_acad }}',
    		type: 'post',
    		data: jQuery(this).serialize(),
    		success: function(data){
    			jQuery('#tipo_graduacion_'+data.id_datos_acad).html(data.tipo_graduacion);
    			jQuery('#institucion_'+data.id_datos_acad).html(data.institucion);
    			jQuery('#facultad_'+data.id_datos_acad).html(data.facultad);
    			jQuery('#curso_realizado_'+data.id_datos_acad).html(data.curso_realizado);
    			jQuery('#curso_realizado_'+data.id_datos_acad).html(data.curso_realizado);
    			jQuery('#ano_finalizacion_'+data.id_datos_acad).html(data.ano_finalizacion);
    			console.log(data);
    			jQuery('.fancybox-close').click();
    		},
    		error: function(e){
    			console.log(e);
    		}
    	});
    	console.log('Fancy ready');
    });
</script>