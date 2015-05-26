<div style="text-align: right;">

    Página:  
            <span style="font-size: 16px; position: relative; top: -1px; font-weight: bold;"><span id="pagination-from">{{ $trabalhos->getFrom() }}</span> - <span id="pagination-to">{{ $trabalhos->getTo() }}</span> de <span id="pagination-total">{{ $trabalhos->getTotal() }}</span></span>

	@if($trabalhos->getCurrentPage() > 1)

    	<a href="{{ $route }}?{{ 'page='.($trabalhos->getCurrentPage()-1) }}{{ $q != null ? '&q='.$q : '' }}"><img alt="" title="" border="0" src="http://abge.org.br/images/icon_prew_page.jpg"> </a> 

	@endif
	@if($trabalhos->getCurrentPage() < $trabalhos->getLastPage())
            
        <a href="{{ $route }}?{{ 'page='.($trabalhos->getCurrentPage()+1) }}{{ $q != null ? '&q='.$q : '' }}"><img alt="" title="" border="0" src="http://abge.org.br/images/icon_next_page.jpg"></a>
	
	@endif

</div>