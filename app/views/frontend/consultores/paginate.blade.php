<div style="text-align: right;">

    Página:  
            <span style="font-size: 16px; position: relative; top: -1px; font-weight: bold;"><span id="pagination-from">{{ $consultores->getFrom() }}</span> - <span id="pagination-to">{{ $consultores->getTo() }}</span> de <span id="pagination-total">{{ $consultores->getTotal() }}</span></span>

	@if($consultores->getCurrentPage() > 1)

    	<a href="{{ $route }}?{{ ($data != null) ? 'area_de_especializacion='.$data.'&' : '' }}{{ 'page='.($consultores->getCurrentPage()-1) }}"><img alt="" title="" border="0" src="http://abge.org.br/images/icon_prew_page.jpg"> </a> 

	@endif
	@if($consultores->getCurrentPage() < $consultores->getLastPage())
            
        <a href="{{ $route }}?{{ ($data != null) ? 'area_de_especializacion='.$data.'&' : '' }}{{ 'page='.($consultores->getCurrentPage()+1) }}"><img alt="" title="" border="0" src="http://abge.org.br/images/icon_next_page.jpg"></a>
	
	@endif

</div>