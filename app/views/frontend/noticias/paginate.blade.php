<div style="text-align: right;">

    Página:  
            <span style="font-size: 16px; position: relative; top: -1px; font-weight: bold;"><span id="pagination-from">{{ $noticias->getFrom() }}</span> - <span id="pagination-to">{{ $noticias->getTo() }}</span> de <span id="pagination-total">{{ $noticias->getTotal() }}</span></span>

	@if($noticias->getCurrentPage() > 1)

    	<a href="{{ $route }}?{{ 'page='.($noticias->getCurrentPage()-1) }}"><img alt="" title="" border="0" src="http://abge.org.br/images/icon_prew_page.jpg"> </a> 

	@endif
	@if($noticias->getCurrentPage() < $noticias->getLastPage())
            
        <a href="{{ $route }}?{{ 'page='.($noticias->getCurrentPage()+1) }}"><img alt="" title="" border="0" src="http://abge.org.br/images/icon_next_page.jpg"></a>
	
	@endif

</div>