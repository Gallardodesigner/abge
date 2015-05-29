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

    <div style="line-height: 20px;">
        <h1>{{ $trabalho->titulo_trabajo }}</h1>
    </div>
    <div style="line-height: 20px; padding-top: 15px; text-align: justify">
        <b>Detalhes do Trabalho:</b><br>
        {{ $trabalho->resumen }}                       
    </div>
    <div class="summary">
        <b>Autores: </b> 
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
    </div>
    <!-- <div class="summary" style="line-height: 20px; text-align: justify;">
        <b>Resumo:</b> <br>
        Este trabalho apresenta uma metodologia adotada na execução de Zoneamento Geotécnico como
    		ferramenta cartográfica de estudo para a implantação de gasoduto ao longo da faixa GASFOR II
    		(Guamaré-Fortaleza), que liga as cidades de Pacajus a Caucaia (CE). Por meio de
    		fotointerpretação geotécnica (escala 1:8000), o método define o traçado conforme as exigências
    		do ambiente correspondentes a distribuição espacial das unidades geotécnicas. Os resultados
    		expressam a implementação do duto, sempre associado ao tipo de material predominante, a
    		classificação da categoria quanto à escavação, aos aspectos geológicos, geotécnicos e
    		geomorfológicos, além de alertar para os processos de movimentação de massa.                    
    	</div> -->
    <div class="summary" style="line-height: 20px;">
        <b>Palavras Chaves:</b> <br>
        {{ $trabalho->palabras_claves }}                      
        <br><br>
        <b>Município:</b> <br>
        {{ $trabalho->municipio }}                                          
    </div>
    <div class="summary" style="line-height: 20px;">
        <b>Instituição:</b> <br>
        {{ $trabalho->institucion }}<br>
        <b>Escala do Trabalho:</b> <br>
        {{ $trabalho->escala_trabajo }}                   
    </div>
	
@stop