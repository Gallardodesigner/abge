<form id="deletarescolaridade">
    <div>
        <h4 class="widgettitle">Atualizar Escolaridade</h4>
        <p>
            <label>Tipo de graduação</label>
            <span class="field">
                ¿Você tem certeza que deseja deletar escolaridade?
            </span>
        </p>
        <p>
            
            <span class="right"><input type="submit" class="input-xxlarge btn" value="Atualizar"/></span>
        </p> 
    </div>
</form>
<div id="loader_container" style="display:none; ">
	<img src="/assets/fancybox/fancybox_loading.gif" id="loading_image"/>
</div>
<style type="text/css">
	#loader_container{
		width: 100%;
		height: 150px;
		padding-top: 75px;
		display:none;
		background-color: rgba(255,255,255,0.2);
		background-position: cover;
		text-align:center;
		vertical-align: middle;
	}
</style>

<script type="text/javascript">
    jQuery('#deletarescolaridade').on('submit', function(e){
    	jQuery('#deletarescolaridade').ajaxStart(function(e){
    		jQuery('#deletarescolaridade').css({
    			'display':'none'
    		});
    		jQuery('#loader_container').css({
    			'display':'block'
    		});
    	});
    	jQuery('#deletarescolaridade').ajaxStop(function(e){
    		jQuery('#loader_container').css({
    			'display':'none'
    		});
    	});
    	e.preventDefault();
    	jQuery.ajax({
    		url: '/ajax/deletarescolaridade/{{ $academic->id_datos_acad }}',
    		type: 'post',
    		data: jQuery(this).serialize(),
    		success: function(data){
    			console.log(data);
    			jQuery('#escolaridade_'+data.id_datos_acad).remove();
    			jQuery('.fancybox-close').click();
    		},
    		error: function(e){
    			console.log(e);
    		}
    	});
    	console.log('Fancy ready');
    });
</script>