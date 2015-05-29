@extends('frontend.cartography.layout')

@section('cartography_section')
	Acesso
@stop

@section('cartography_content')
          
    <form id="carto_login" method="post">
	    <div align="center">
	        <table border="0" cellpadding="0" cellspacing="5">            
	            <tbody>
	                <tr>
	                    <td align="center">
	                        <div id="frmLogin">                            
	                            <h1>Área Restrita</h1>                          
	                            <table cellpadding="0" cellspacing="3" border="0" style="margin-top: 10px;margin-bottom: 20px;">
	                                <tbody>
		                                <tr align="left">
		                                    <td>
		                                        <label for="cartoLogin_login">Usuario</label><br>
		                                        <input maxlength="100" style="padding: 5px; width: 215px;" type="text" name="login" class="" id="cartoLogin_login" required>                                    
		                                    </td>
		                                </tr>
		                                <tr align="left">
		                                    <td style="background: none;">
		                                        <label for="cartoLogin_password">Senha</label><br>
		                                        <input maxlength="20" style="padding: 5px; width: 215px;" type="password" name="password" class="" id="cartoLogin_password" required>                                    
		                                    </td>
		                                </tr>
		                                <tr>
		                                   	<td align="right">                                       
		                                        <input type="submit" class="boton" value="Entrar">
		                                        <a class="boton" href="{{ $route }}">Voltar</a>
		                                    </td>
		                                </tr>        
		                            </tbody>
		                        </table>
	                        </div>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </div>
	</form>

@stop