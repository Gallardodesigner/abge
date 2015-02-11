<form id="adicionarescolaridade">
    <div id="wiz1step5" class="formwiz">
        <h4 class="widgettitle">Adicionar Escolaridade</h4>
        <p>
            <label>Tipo de graduação</label>
            <span class="field">
                <select name="tipo_graduacion" id="asociados_datos_academicos_tipo_graduacion" required>
                    <option value="0">DOUTORADO</option>
                    <option value="1">ESPECIALIZAÇÃO</option>
                    <option value="2">GRADUAÇÃO</option>
                    <option value="3">MESTRADO</option>
                    <option value="4">PÓS-GRADUAÇÃO</option>
                </select>
            </span>
        </p>
        <p>
            <label>Instituição:</label>
            <span class="field"><input type="text" name="institucion" id="institucion" class="input-xxlarge" required/></span>
        </p>
        <p>
            <label>Faculdade:</label>
            <span class="field"><input type="text" name="facultad" id="facultad" class="input-xxlarge" required/></span>
        </p>
        <p>
            <label>Formação:</label>
            <span class="field">
                @if (isset($formacoes))
                    <select class="chosen-select" name="curso_realizado">
                        @foreach ($formacoes as $formacao)
                            <option value="{{$formacao->id}}">{{$formacao->nome}}</option>
                        @endforeach
                    </select>
                @endif
            </span>
        </p>
        <p>
            <label>Ano de início</label>
            <span class="field"><input type="text" name="ano_inicio" id="ano_inicio" class="input-xxlarge" required/></span>
        </p>
        <p>
            <label>Ano de finalização</label>
            <span class="field"><input type="text" name="ano_finalizacion" id="ano_finalizacion" class="input-xxlarge" required/></span>
        </p>  
        <p>
            
            <span class="right"><input type="submit" class="input-xxlarge btn" value="Adicionar"/></span>
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
    jQuery('#adicionarescolaridade').on('submit', function(e){
    	jQuery('#adicionarescolaridade').ajaxStart(function(e){
    		jQuery('#adicionarescolaridade').css({
    			'display':'none'
    		});
    		jQuery('#loader_container').css({
    			'display':'block'
    		});
    	});
    	jQuery('#adicionarescolaridade').ajaxStop(function(e){
    		jQuery('#loader_container').css({
    			'display':'none'
    		});
    	});
    	e.preventDefault();
    	jQuery.ajax({
    		url: '/ajax/adicionarescolaridade/{{ $id_asociado }}',
    		type: 'post',
    		data: jQuery(this).serialize(),
    		success: function(data){
    			jQuery('#adicionarbutton').before('<div id="esolaridade_'+data.id_datos_acad+'" style="margin-left: 5em;display:inline-block">'+
                                            '<p>'+
                                                '<b>Tipo de graduação:</b> '+
                                                '<span id="tipo_graduacion_'+data.id_datos_acad+'">'+
                                                	data.tipo_graduacion+
                                                '</span>'+
                                            '</p>'+
                                            '<p>'+
                                                '<b>Instituição:</b> '+
                                                '<span id="institucion_'+data.id_datos_acad+'">'+
                                                    data.institucion+
                                                '</span>'+
                                            '</p>'+
                                            '<p>'+
                                                '<b>Faculdade:</b> '+
                                                '<span id="facultad_'+data.id_datos_acad+'">'+
                                                    data.facultad+
                                                '</span>'+
                                            '</p>'+
                                            '<p>'+
                                                '<b>Formação:</b> '+
                                                '<span id="curso_realizado_'+data.id_datos_acad+'">'+
                                                   data.curso_realizado+
                                                '</span>'+
                                            '</p>'+
                                            '<p>'+
                                                '<b>Ano de início:</b> '+
                                                '<span id="ano_inicio_'+data.id_datos_acad+'">'+
                                                    data.ano_inicio+
                                                '</span>'+
                                            '</p>'+
                                            '<p>'+
                                                '<b>Ano de finalização:</b> '+
                                                '<span id="ano_finalizacion_'+data.id_datos_acad+'">'+
                                                    data.ano_finalizacion+
                                                '</span>'+
                                            '</p>'+
                                            '<p>'+
                                                '<span>'+
                                                    '<a href="/ajax/atualizarescolaridade/'+data.id_datos_acad+'" class="fancybox fancybox.ajax btn" id="adicionar_escolaridade" >Atualizar</a>'+
                                                    '<a href="/ajax/deletarescolaridade/'+data.id_datos_acad+'" class="fancybox fancybox.ajax btn" id="adicionar_escolaridade" >Deletar</a>'+
                                                '</span>'+
                                            '</p>'+
                                        '</div>');
    			console.log(data);
    			jQuery('.fancybox-close').click();
    		},
    		error: function(e){	
    			console.log(e);
    		}
    	})
    	console.log('Fancy ready');
    });
</script>