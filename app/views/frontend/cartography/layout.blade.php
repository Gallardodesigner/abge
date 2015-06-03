<!-- Layout principal -->
@extends("frontend.layouts.master")

<!-- Titulo de la pagina -->
@section("title")
	Cartografia
@stop

<!-- Contenido principal -->
@section("maincontent")
	<style type="text/css">
		.course{
			vertical-align: top;
		}
		.inline-block{
			vertical-align: inherit;
			display: inline-block;
			padding:1em;
		}
		.course-image{
			width: 200px;
		}
		.course-content{
			width:60%;
		}
		.boton {
		  background-color: #06C !important;
		  border: 0px;
		  padding: 7px 15px 7px 15px;
		  color: white;
		  cursor: pointer;
		}
		a {
			text-decoration: none;
			color: #656565;
		}
	</style>
	<div class="courses-list">
		<div class="column span-24 last home_article">
        	<h1>Banco de Datos de Cartografia Geotécnica e Geoambiental</h1>
            <h1>@yield('cartography_section')</h1>
            
            <form method="get" name="adminForm" action="{{ $route }}/trabalhos ">        
		        <table width="50%" style="border-bottom: 1px solid #0066CC;">
		            <tbody>
		                <tr>                
		                    <td colspan="2" align="right" style="border: 0px solid #000; text-align: right;"> 
		                        <div class="borderMenu" align="right" style="width: 480px; float: right;">
		                            <a class="boton_white" href="{{ $route }}/index">Histórico</a>&nbsp;|&nbsp;
		                            <a class="boton_white" href="{{ $route }}/objetivos">Objetivos</a>&nbsp;|&nbsp;
		                            <a class="boton_white" href="{{ $route }}/trabalhos">Trabalhos</a><!-- &nbsp;|&nbsp;
		                                                                <a class="boton_white" href="{{ $route }}/acesso">Acesso</a>&nbsp;|&nbsp;
		                                                                <a class="boton_white" href="{{ $route }}/cadastro">Cadastre-se</a> -->
                                </div>
                    		</td>
						</tr>
						@yield('cartography_info')
                    </tbody>
        		</table>
        	</form>                       
            <div style="line-height: 20px;">
            	@yield('cartography_content')       
			</div>    
            <div style="line-height: 20px; margin-top: 20px;">
            	<a class="boton" href="{{ $route }}">Voltar</a>        
            </div>
            <table style="width: 100%"></table>
        </div>
	</div>
@stop