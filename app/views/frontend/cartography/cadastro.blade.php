@extends('frontend.cartography.layout')

@section('cartography_section')
	Cadastro
@stop

@section('cartography_content')
          
    <form id="usercarto" action="" method="post">

		<div class="frameForm" align="left">
		  	<table width="100%">
		      	<tbody>
		      		<tr>
				        <td>
				            &nbsp;Os campos marcados com <span class="required">*</span> são requeridos        
				        </td>
			      	</tr>
			      	<tr>
			        	<td id="errorGlobal"></td>
			      	</tr>
		    	</tbody>
		    	<tfoot>
		      		<tr>
				        <td>
				            <input type="hidden" name="id_user" id="id_user">            
				            <table cellspacing="4">
				                <tbody>
				                	<tr>
					                    <td width="5%">
					                        <div class="button">
					                            <a class="boton" href="{{ $route }}">Voltar</a>                        
					                        </div>
					                    </td>            
					                    <td>
					                        <input type="submit" value="Salvar" class="boton">
					                    </td>
					                </tr>
					            </tbody>
					        </table>
				        </td>
		      		</tr>
			    </tfoot>
			    <tbody>
			        <tr>
			            <td>                
			                <table cellpadding="0" cellspacing="2" border="0" width="100%">
			                    <tbody>
			                    	<tr>
			                      		<td>
			                      			<label for="nome">Nome</label><br>
			                        		<input class="required" size="50" style="padding: 5px; width: 215px;" type="text" name="nome" value="" id="nome" required>
			                        	</td>
			                  		</tr>
			                		<tr>
			                    		<td>
			                    			<label for="username">Nome de usuário</label><br>
			                        		<input class="required" size="50" style="padding: 5px; width: 215px;" type="text" name="username" value="" id="username" required>
			                        	</td>
				                  	</tr>
				                  	<tr>
				                      	<td>
				                      		<label for="email_user">Email</label><br>
				                        	<input class="required" size="50" style="padding: 5px; width: 215px;" type="text" name="email_user" value="" id="email_user" required>
				                        </td>
				                  	</tr>
				                  	<tr>
				                      	<td>
				                      		<label for="senha">Senha</label><br>
				                        	<input size="35" maxlength="12" style="padding: 5px; width: 215px;" type="password" name="senha" id="senha" required>
				                       	</td>
				                  	</tr>
			                    </tbody>
			                </table>                
			            </td>
			        </tr>
			    </tbody>
		  	</table>
	    </div>
	</form>

@stop