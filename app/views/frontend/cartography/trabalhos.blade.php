@extends('frontend.cartography.layout')

@section('cartography_section')
	Histórico
@stop

@section('cartography_info')
	<tr>
        <td width="82%" align="right" style="text-align: right;">
            <input size="50" type="text" name="q" value="" class="inputbox" onchange="document.adminForm.submit();">
        </td>							
        <td align="left">
            &nbsp;<input type="submit" value="Pesquisa" class="boton">
        </td>  
    </tr>
    <tr>
	    <td colspan="2" style="background-color: #e5ecf9; color: #0066cc; text-align: right">
	        Opções de Pesquisa: Palavra Chave, Trabalho, Resumem do Trabalho, Autores,  Município, Região, Instituição.
	    </td>
	</tr>
@stop

@section('cartography_content')
	<h2>Trabalhos</h2>
	<div id="cartografia_content">
		@if($trabalhos->count() > 0)
			@foreach($trabalhos as $trabalho)
		        <div class="newsPress">
		          	<table>
		            	<tbody>
		              		<tr>
		                		<td width="3"></td>
		                		<td valign="top">
		                  			<div style="position: relative; min-height: 80px;">
		                    			<div style="line-height: 20px;">
		                                    <a class="titulo_listado" href="{{ $route }}/ver/cartografo-{{ $trabalho->id_cartografia }}">
		                                    	{{ $trabalho->titulo_trabajo }}
		                                    </a>                    
		                                </div>
		                    			<div class="summary" style="line-height: 20px;">
		                        			<b>Autores: </b> <br>
		                        			@if(($trabalho->nome_autor1 != '') OR ($trabalho->nome_do_meio1 != '') OR ($trabalho->nome_sobrenome1 != ''))
		                        				{{ $trabalho->nome_autor1 }} {{ $trabalho->nome_do_meio1 }} {{ $trabalho->nome_sobrenome1 }} - {{ $trabalho->email1 }}, 
		                        			@endif 
		                        			@if(($trabalho->nome_autor2 != '') OR ($trabalho->nome_do_meio2 != '') OR ($trabalho->nome_sobrenome2 != ''))
		                        				{{ $trabalho->nome_autor2 }} {{ $trabalho->nome_do_meio2 }} {{ $trabalho->nome_sobrenome2 }} - {{ $trabalho->email2 }}, 
		                        			@endif 
		                        			@if(($trabalho->nome_autor3 != '') OR ($trabalho->nome_do_meio3 != '') OR ($trabalho->nome_sobrenome3 != ''))
		                        				{{ $trabalho->nome_autor3 }} {{ $trabalho->nome_do_meio3 }} {{ $trabalho->nome_sobrenome3 }} - {{ $trabalho->email3 }}, 
		                        			@endif 
		                        			@if(($trabalho->nome_autor4 != '') OR ($trabalho->nome_do_meio4 != '') OR ($trabalho->nome_sobrenome4 != ''))
		                        				{{ $trabalho->nome_autor4 }} {{ $trabalho->nome_do_meio4 }} {{ $trabalho->nome_sobrenome4 }} - {{ $trabalho->email4 }}, 
		                        			@endif 
		                        			@if(($trabalho->nome_autor5 != '') OR ($trabalho->nome_do_meio5 != '') OR ($trabalho->nome_sobrenome5 != ''))
		                        				{{ $trabalho->nome_autor5 }} {{ $trabalho->nome_do_meio5 }} {{ $trabalho->nome_sobrenome5 }} - {{ $trabalho->email5 }}, 
		                        			@endif 
		                        			@if(($trabalho->nome_autor6 != '') OR ($trabalho->nome_do_meio6 != '') OR ($trabalho->nome_sobrenome6 != ''))
		                        				{{ $trabalho->nome_autor6 }} {{ $trabalho->nome_do_meio6 }} {{ $trabalho->nome_sobrenome6 }} - {{ $trabalho->email6 }}, 
		                        			@endif                                                                                   
		                        			<br><br>
		                        			<b>Município:</b> {{ $trabalho->municipio }} <br>
		                    			</div>
		                    			<div class="summary" style="line-height: 20px; text-align: left;">
		                        			<a class="link" href="{{ $route }}/ver/cartografo-{{ $trabalho->id_cartografia }}">Veja mais</a>
		                        		</div>
		                  			</div>
		                		</td>
		              		</tr>
		            	</tbody>
		          	</table>
		        </div>
		        <hr style="height: 1px; background-color: #e5e5e5;">
			@endforeach
		@endif
    </div>

    {{ $trabalhos->links('frontend.cartography.paginate')->with(array('trabalhos' => $trabalhos, 'route' => $route.'/trabalhos', 'q' => $q )) }}
	
@stop