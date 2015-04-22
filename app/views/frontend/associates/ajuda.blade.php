@extends('frontend.associates.layout')

@section('css')

@stop

@section('content')

	<div class="row"> 
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div style="padding:10px;">
				<ul>
					
				    <li><a href="#agero"> 1-Como posso reemitir meu boleto de Anuidade?</a></li>
				    <li><a href="#aaltero"> 2-Como altero a quantidade de parcelas para pagamento da minha Anuidade?</a></li>
				    <li><a href="#adesfazer"> 3-Posso desfazer a alteração da quantidade de parcelas?</a></li>
				    <li><a href="#aimprimo"> 4-Como imprimo meu boleto?</a></li>
				    <li><a href="#adados"> 5-Como altero dados no meu cadastro?</a></li>
				    <li><a href="#avejo"> 6-Como vejo minhas parcelas em aberto?</a></li>
				    <li><a href="#asair"> 7-Como saio do sistema?</a></li>
				    <li><a href="?op=ajuda.contato">Envie suas dúvidas</a></li>

				</ul>

			    <h4 align="center"><strong>Dúvidas mais freqüentes</strong></h4>

			    <p>&nbsp;</p>

			    <div id="agero">

			      <h4>1-	Como posso gerar meu boleto?</h4>

			      <p>R-  Para gerar seu boleto clique na opção <span class="style5">Anuidades</span>  localizada no Menu. Depois clique na opção em destaque <span class="style5">Parcelas em Aberto</span> selecione a parcela em aberto desejada e em seguida clique na opção em destaque <span class="style5">Emitir boleto.</span></p>

			    </div>

			    <div id="aaltero">

			      <h4>2-	Como altero a quantidade de parcelas para pagamento da minha Anuidade?</h4>

			      <p>R-	Clique na opção <span class="style7"><em>Anuidades</em></span>  localizada no Menu. Após clique na opção em destaque <span class="style5">Parcelas em Aberto</span> e em seguida na opção em destaque na parte inferior da página <span class="style5">Alterar plano de pagamento para: n parcela(s)<em>,</em></span><span class="style9"> onde n  é o numero de parcelas do novo  plano de pagamento (caso a opção de  parcelamento esteja disponível)</span>.</p>

			    </div>

			    <div id="adesfazer">

			      <h4>3-	Posso desfazer a alteração da quantidade de parcelas?</h4>

			      <p>R- Sim. Caso haja a disponibilidade, repita a operação descrita na<span class="style7"> pergunta 2 <span class="style9">(</span></span>Como  altero a quantidade de parcelas para pagamento da minha Anuidade?) e escolha a  quantidade de parcelas anterior.</p>

			    </div>

			    <div id="aimprimo">

			      <h4>4-	Como imprimo meu boleto?</h4>

			      <p>R- Após seguir os passos para gerar o boleto <span class="style7">(pergunta 1), </span>clique no botão <span class="style7"><em>Imprimir</em></span> que aparecerá no canto esquerdo na parte inferior da tela. Caso não o visualize utilize a barra de rolagem lateral para descer a página e localizá-lo. Ou pressione as teclas <span class="style7">Ctrl + p. </span></p>

			    </div>

			    <div id="adados">

			      <h4>5-	Como altero dados no meu cadastro? </h4>

			      <p>R- Clique na opção <span class="style7"><em>Meu Cadastro</em></span> que localizada no Menu. Em seguida clique no campo que deseja alterar, para finalizar e salvar as alterações clique no botão <span class="style7"><em>Gravar </em></span>na parte inferior da tela. </p>

			    </div>

			    <div id="avejo">

			      <h4>6-	Como vejo minhas parcelas em aberto?</h4>

			      <p>R-	Clique na opção <span class="style7"><em>Anuidades</em></span> localizada no Menu. Após clique na opção em destaque <span class="style7"><em>Parcelas em Aberto</em>.</span></p>

			    </div>

			    <div id="asair">

			      <h4>7-	Como saio do sistema? </h4>

			      <p>R-	Clique no botão <span class="style7"><em>Sair</em></span>  localizado na barra de Menu. </p>

			    </div>

			  </div>

		</div>
		<div class="col-md-2"></div>
	</div>

    <!-- <div class="row center">
      	<div class="col-md-3">
           <span class="tile col-md-12 bg-light-blue">
                <span class="title">Personal Registrado: <span>0</span></span>
                <a href="/administrador/personal" class="content">Haga click aqui para ver todos el personal registrado</a>
           </span>
     	 </div>
      	<div class="col-md-3">
           <span class="tile col-md-12 bg-red">
                <span class="title">Sanciones: <span>0</span></span>
                <a href="/administrador/sanciones" class="content">Haga click aqui para ver todos el personal registrado</a>
           </span>
      	</div>
      	<div class="col-md-3">
           <span class="tile col-md-12 bg-light-green">
                <span class="title">Condecoraciones: <span>0</span></span>
                <a href="/administrador/condecoraciones" class="content">Haga click aqui para ver todos el personal registrado</a>
           </span>
      	</div>
     	<div class="col-md-3">
               <span class="tile col-md-12 bg-blue-grey">
                    <span class="title">Usuarios de Dpto: <span>0</span></span>
                    <a href="/administrador/usuarios" class="content">Haga click aqui para ver todos el personal registrado</a>
               </span>
          </div>
    </div> -->

@stop

@section('javascripts')

@stop