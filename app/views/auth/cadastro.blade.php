<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ABGE - Administration Panel</title>
<!-- <link rel="stylesheet" href="/assetsadmin/css/style.default.css" type="text/css" /> -->
<!-- <link rel="stylesheet" href="/assetsadmin/css/style.shinyblue.css" type="text/css" /> -->

<!--  -->

<style>
.loginpanelinner .logo {
text-align: center;
padding: 20px 0;
}
.inputwrapper button:focus, .inputwrapper button:active, .inputwrapper button:hover {
background: #1e82e8;
}
.inputwrapper button {
display: block;
border: 1px solid #0c57a3;
padding: 10px;
background: #0972dd;
width: 100%;
color: #fff;
text-transform: uppercase;
}
body.loginpage {
background: #0866c6;
}
.loginfooter {
background: #0866c6;
font-size: 11px;
color: rgba(255,255,255,0.5);
position: absolute;
position: fixed;
bottom: 0;
left: 0;
width: 100%;
text-align: center;
font-family: arial, sans-serif !important;
padding: 5px 0;
}
.loginpanel {
position: absolute;
top: 30%;
left: 50%;
height: 300px;
}
.loginpanelinner {
position: relative;
top: -150px;
left: -50%;
}

.inputwrapper input {
border: 0;
padding: 10px;
background: #fff;
width: 250px;
}

input[type="text"],input[type="password"]{
    display: inline-block;
    height: 20px;
    padding: 10px;
    margin-bottom: 10px;
    outline: none;
    font-size: 14px;
    line-height: 20px;
    color: #555555;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    vertical-align: middle;
}
</style>
</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="/assetsadmin/images/logo.png" alt="" /></div>
        <p align="center">
        <strong>
            <a href="{{ $route }}/cadastrofisica" style="color:rgb(220,220,220);font-family: Verdana;">PESSOA FÍSICA</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
            <a href="{{ $route }}/cadastrojuridica" style="color:rgb(220,220,220);font-family: Verdana;">PESSOA JURÍDICA</a>
        </strong>
        </p>
        <p align="center"> </p>
        <p align="center"> </p>
		<div align="justify">

		    <p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big>A ABGE possui as categorias de associados abaixo:<br>
			<br>
			<strong>Afiliado:</strong> Estudante de graduação ou técnico de nível médio.<br>
			<strong>Titular:</strong> Nível universitário (graduado, mestrado e doutorado).<br>
			<strong>Sênior: </strong>associados com idade entre 65 e 75 anos.<br>
			<strong>Master:</strong> associados com 76 anos ou maiss.<br>
			<strong><br>
			Patrocinador:</strong> Empresas/Instituições</big></span></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big>Platina<br>
			Ouro<br>
			Prata</big></span></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big><strong>Patrocinadores Coletivos: </strong>prefeituras e entidades da sociedade civil</big></span></span></span></p>
			<p><span style="color: rgb(200, 200, 200);"><span style="font-family: Verdana;">Esmeralda<br>
			Rubi<br>
			Cristal</span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big> &nbsp;<strong><br>
			VALORES ANUIDADE 2015 (até o dia 10 de abril de 2015)</strong><br>
			&nbsp;</big></span></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big><strong>Pessoa Física</strong></big></span></span></span></p>
			<p><span style="font-family: Verdana;"><span style="color: rgb(200, 200, 200);">Titular (Nível Universitário)&nbsp;&nbsp;&nbsp; R$ 205,00<br>
			Afiliado (Estudante)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; R$ 100,00<br>
			Senior (associado com idade entre 65 e 75 anos) R$ 100,00<br>
			Master (associado acima dos 76 anos) ISENTO</span></span></p>
			<p><span style="font-family: Verdana;"><span style="color: rgb(200, 200, 200);"><strong>Sócios Patrocinadores Coletivos</strong></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big>Até 50 mil habitantes – Categoria Cristal –&nbsp; R$ 415,00<br>
			Entre 50 mil e 500 mil habitantes – Categoria Rubi –&nbsp; R$ 625,00<br>
			Acima de 500 mil habitantes – Categoria Esmeralda –&nbsp; R$ 830,00</big></span></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big><strong>Sócios Patrocinadores</strong></big></span></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big>Patrocinador Prata (Empresa/Instituição)&nbsp;&nbsp;&nbsp; R$ 1.440,00<br>
			Patrocinador Ouro (Empresa/Instituição)&nbsp;&nbsp;&nbsp;&nbsp; R$ 2.720,00<br>
			Patrocinador Platina (Empresa/Instituição)&nbsp; R$ 4.500,00</big></span></span></span></p>
			<p style="text-align: left;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big><strong><br>
			VANTAGENS DO SÓCIO ABGE</strong><br>
			<br>
			- Receberá todas as publicações editadas pela entidade durante o período de filiação (livros, traduções, artigos técnicos, anais de simpósios e congressos);<br>
			<br>
			- Terá desconto na aquisição de publicações editadas pela entidade;<br>
			<br>
			- Receberá a RBGEA, Revista Informativa e Informes Técnicos;<br>
			<br>
			- Terá desconto na inscrição dos eventos promovidos pela ABGE e entidades parceiras;<br>
			<br>
			- Terá acesso a conteúdo restrito na homepage.<br>
			&nbsp;</big></span></span></span></p>
			<p style="text-align: center;"><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big><br>
			<a href="http://abge.org.br/uploads/arquivos/archivoseccion_225_regulamento_abge_est.pdf "><br>
			<span style="color: rgb(200, 200, 200);"><u>Regulamento Afiliado Estudante</u></span></a><span style="color: rgb(200, 200, 200);"><br>
			<br>
			</span><a href="http://abge1.hospedagemdesites.ws/uploads/arquivos/archivoseccion_224_regulamentosciopatro.pdf "><span style="color: rgb(200, 200, 200);">Regulamento Sócio Patrocinador</span></a></big><span style="color: rgb(200, 200, 200);"><big><br>
			</big></span></span></span></span></p>
			<p style="text-align: center;"><a href="http://abge1.hospedagemdesites.ws/uploads/arquivos/archivoseccion_223_regulamentosciocolet.pdf "><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big><span style="color: rgb(200, 200, 200);">Regulamento Sócio Coletivo</span></big></span></span></span></a></p>
			<p style="text-align: center;"><a href="http://abge.org.br/uploads/arquivos/archivoseccion_222_modelodeleimunicipal.pdf "><span style="color: rgb(200, 200, 200);"><span style="font-size: smaller;"><span style="font-family: Verdana;"><big>Minuta de Lei Municipal</big></span></span></span><br>
			</a></p>    

            <p align="center">&nbsp; </p>
            <p align="center">&nbsp; </p>
            <p align="center">&nbsp; </p>
    	
    	</div>

    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2014. ABGE. All Rights Reserved. - Design by <a href="http://www.gallardodesign.com.br/" style="color: #FFF !important;" target="_new">GallardoDesigner</a></p>
</div>

</body>
</html>


<!------------ -->

