<?php setlocale(LC_TIME, 'portuguese');?>

<!DOCTYPE html>
<!-- saved from url=(0040)http://abge.org.br/index.php/abge/cursos -->
<html xml:lang="pt" lang="pt">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="title" content="Cursos - ABGE">
  <meta name="description" content="ABGE">
  <meta name="keywords" content="ABGE">
  <meta name="language" content="en">
  <meta name="robots" content="index, follow">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="http://abge.org.br/favicon.ico">
  {{HTML::style("assets/frontend/css/screen.css")}}
  {{HTML::style("assets/frontend/css/print.css")}}
  {{HTML::style("assets/frontend/css/validationEngine.jquery.css")}}
  {{HTML::style("assets/frontend/css/style.css")}}
  {{HTML::style("assets/frontend/css/jqueryslidemenu-frontend.css")}}
  {{HTML::style("assets/frontend/css/jquery.fancybox-1.3.4.css")}}
  {{HTML::script("assets/frontend/js/jquery-1.4.2.min.js")}}
  {{HTML::script("assets/frontend/js/jqueryslidemenu.js")}}
  {{HTML::script("assets/frontend/js/jquery.validationEngine.js")}}
  {{HTML::script("assets/frontend/js/jquery.validationEngine-en_US.js")}}
  {{HTML::script("assets/frontend/js/jquery.fancybox-1.3.4.js")}}
</head>
<body>
<style>
  table, tr, td{
  border:1px solid;
}



</style>
    <!--[if lte IE 6]>
      <div align="center" style="border: 1px solid #ccc;padding:10px;">
          This browser is not supported to view this page. Please update it.
      </div>
      <![endif]-->
    
      <div id="page" class="container">

        <div id="header" class="div_float">
          	<div style="padding: 13px 8px 15px 10px; float: left;">
            	<a href="http://abge.org.br/index.php/"><img src="/assets/frontend/img/logo_header.png"></a>  
            </div>
            <div style="float:left; margin-left: 430px;margin-top: 20px;">
              	<a href="https://www.facebook.com/abge.abge" target="_blank"><img src="/assets/frontend/img/face-abge.jpg" border="0"></a>
            </div>
        </div>
        <div class="div_float" style="padding: 0 0 4px 0; height: 32px;">

              <!-- Nav Menu -->
              	<div id="myslidemenu" class="jqueryslidemenu">
	                <ul id="menu_top">
	                  @foreach(Pages::where('id_parent','=','0')->where('status','=','active')->orderBy('order','ASC')->get() as $page)
	                    <?php $children = $page->children ?>
	                    @if(count($children) > 0)
	                      <li>
	                        <a @if($page->content != '') href="{{ $page->url != '' ? $page->url : '/page/'.$page->name }}" @endif>{{ $page->title }}<img src="/images/right.png" class="rightarrowclass" style="border:0;"></a>
	                        <ul style="top: 31px; display: none; visibility: visible;">
	                          @foreach($children as $child)
	                            <?php $grandchildren = $child->children ?> 
	                            @if(count($grandchildren) > 0)
	                              <li>
	                                <a @if($child->content != '') href="{{ $child->url != '' ? $child->url : '/page/'.$child->name }}" @endif>{{ $child->title }}<img src="/images/right.png" class="rightarrowclass" style="border:0;"></a>  
	                                <ul style="top: 0px; left:174px !important; display: none; visibility: visible;">
	                                  @foreach($grandchildren as $grandchild)
	                                    <?php $bigchildren = $grandchild->children ?>
	                                    @if(count($bigchildren) > 0)
	                                      <li>
	                                        <a @if($grandchild->content != '') href="{{ $grandchild->url != '' ? $grandchild->url : '/page/'.$grandchild->name }}" @endif>{{ $grandchild->title }}<img src="/images/right.png" class="rightarrowclass" style="border:0;"></a>
	                                        <ul style="top: 0px; left:174px !important; display: none; visibility: visible;">
	                                          @foreach($bigchildren as $bigchild)
	                                            <li>
	                                              <a @if($bigchild->content != '') href="{{ $bigchild->url != '' ? $bigchild->url : '/page/'.$bigchild->name }}" @endif>{{ $bigchild->title }}</a>  
	                                            </li>
	                                          @endforeach
	                                        </ul>
	                                      </li>
	                                    @else
	                                      <li>
	                                        <a href="{{ $grandchild->url != '' ? $grandchild->url : '/page/'.$grandchild->name }}">{{ $grandchild->title }}</a>  
	                                      </li>
	                                    @endif
	                                  @endforeach
	                                </ul>
	                              </li>
	                            @else
	                              <li>
	                                <a href="{{ $child->url != '' ? $child->url : '/page/'.$child->name }}">{{ $child->title }}</a>  
	                              </li>
	                            @endif                           
	                          @endforeach
	                        </ul> 
	                      </li>
	                    @else
	                      <li>
	                        <a href="{{ $page->url != '' ? $page->url : '/page/'.$page->name }}">{{ $page->title }}</a>  
	                      </li>
	                    @endif
	                  @endforeach
	                </ul>
              	</div>
              <!-- Nav Menu -->

        </div>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-46004748-1', 'abge.org.br');
            ga('send', 'pageview');

        </script>

    </div>

        <div class="banner_principal_home">
      <div style="margin: 0 auto; padding-top: 10px; width: 1000px; height: 398px;">
        <link rel="stylesheet" type="text/css" media="screen" href="/css/home_banner_principal/style2.css" />
<script type="text/javascript" src="/js/home_banner_principal/jquery.js"></script>
<script type="text/javascript" src="/js/home_banner_principal/jquery.easing.js"></script>
<script type="text/javascript" src="/js/home_banner_principal/script.js"></script>
<script type="text/javascript">
  $(document).ready( function(){
    var buttons = {
      previous:$('#jslidernews2 .button-previous'),
      next:$('#jslidernews2 .button-next')
    };
    
    $('#jslidernews2').lofJSidernews( { 
      interval: 5000,
      easing: 'easeInOutQuad',
      duration: 1200,
      auto: true,
      mainWidth: 1000,
      mainHeight: 398,
      navigatorHeight: 100,
      navigatorWidth: 310,
      maxItemDisplay: 4,
      buttons:buttons } );					
  });
</script>

<style>
  ul.lof-main-wapper li {
    position:relative;	
  }
  
</style>
<!------------------------------------- THE CONTENT ------------------------------------------------->
<div id="jslidernews2" class="lof-slidecontent">
  <div class="preload"><div></div></div>
  <div  class="button-previous">Previous</div>
  
  <!-- MAIN CONTENT --> 
  <div class="main-slider-content" style="width:1000px; height:398px;">
    <ul class="sliders-wrap-inner">
      @if(count($banner) > 0)
        @foreach($banner as $element)
          <li>
            <a href="/noticias/detalle/{{ $element->permalink }}">
              <img title="ABGE promove Simpósio de sucesso em Cuiabá" alt="ABGE promove Simpósio de sucesso em Cuiabá" src="/uploads/news/banner_{{ $element->image }}" />              
            </a>  
          </li> 
        @endforeach
      @endif
      <!-- <li>
        <a href="/noticias/detalle/165-Abge-promove-simp-sio-de-sucesso-em-cuiab">
          <img title="ABGE promove Simpósio de sucesso em Cuiabá" alt="ABGE promove Simpósio de sucesso em Cuiabá" src="/uploads/news/banner_165_img_20150325_1545154.jpg" />              
        </a>  
      </li> 
      <li>
        <a href="/noticias/detalle/93-Bento-gon-alves-rs-sediar-o-15-cbge-em-2015">
          <img title="Bento Gonçalves-RS sediará o 15º CBGE em 2015" alt="Bento Gonçalves-RS sediará o 15º CBGE em 2015" src="/uploads/news/banner_93_15_cbge_horiz.jpg" />              
        </a>  
      </li> 
      <li>
        <a href="/index.php/abge/noticias/detalle/142-Abge-aborda-tbm-em-evento-de-sucesso">
          <img title="ABGE aborda TBM em evento de sucesso" alt="ABGE aborda TBM em evento de sucesso" src="/uploads/news/banner_142_dsc09450_red.jpg" />              
        </a>  
      </li>  -->
    </ul>  	
  </div>
  <!-- END MAIN CONTENT -->
  
  <!-- NAVIGATOR -->
  <div class="navigator-content">
    <div class="navigator-wrapper">
      <ul class="navigator-wrap-inner">
        @if(count($banner)>0)
          @foreach($banner as $element)
            <li>
              <div style="padding-top: 15px;">
                <h3>{{ $element->title }}</h3>
                <span>{{ iconv('ISO-8859-2', 'UTF-8',strftime('%d de %B del %Y', strtotime($element->date))) }}</span> &nbsp;-&nbsp;
                <a style="color: #FFF;" class="readmore" href="/noticias/detalle/{{ $element->permalink }}">
                    Veja Mais
                </a>
              </div>    
            </li>
          @endforeach
        @endif
        <!-- <li>
          <div style="padding-top: 15px;">
            <h3>Bento Gonçalves-RS sediará o 15º...</h3>
            <span>15 de janeiro de 2015</span> &nbsp;-&nbsp;
            <a style="color: #FFF;" class="readmore" href="/index.php/abge/noticias/detalle/93-Bento-gon-alves-rs-sediar-o-15-cbge-em-2015">
                Veja Mais
            </a>
          </div>    
        </li>
        <li>
          <div style="padding-top: 15px;">
            <h3>ABGE aborda TBM em evento de sucesso</h3>
            <span>24 de outubro de 2014</span> &nbsp;-&nbsp;
            <a style="color: #FFF;" class="readmore" href="/index.php/abge/noticias/detalle/142-Abge-aborda-tbm-em-evento-de-sucesso">
                Veja Mais
            </a>
          </div>    
        </li> -->
      </ul>
    </div>
    
  </div> 
  <!----------------- END OF NAVIGATOR --------------------->
  
  <div class="button-next">Next</div>
  
  <!-- BUTTON PLAY-STOP -->
  <div class="button-control"><span></span></div>
  <!-- END OF BUTTON PLAY-STOP -->
</div> 
      </div>
    </div>


        </div> 
      </div>
    </div>

    <div id="page" class="container" style="padding-top: 15px;">

    	<div class="columna_lateral_home">
  <div class="home_article">
    
<script type="text/javascript">
  $(document).ready( function(){
    var buttons = {
      previous:$('#slider-banco .button-previous'),
      next:$('#slider-banco .button-next')
    };
    
    $('#slider-banco').lofJSidernews( { 
      interval: 5000,
      easing: 'easeInOutQuad',
      duration: 1200,
      auto: true,
      mainWidth: 250,
      mainHeight: 200,
      navigatorHeight: 100,
      navigatorWidth: 310,
      maxItemDisplay: 4,
      buttons:buttons } );					
  });
</script>
<style>
  /*.cartografia_slider{
      background: transparent url(../../images/home_banner_principal/load-indicator.gif) no-repeat scroll 73% 53% !important;
      height: 150px !important;
      
  }*/
</style>
<div class="home_article_title texto_azul">
  Banco de Dados ABGE
</div>

<div class="div_float" style="text-align: center;">
        <!------------------------------------- THE CONTENT ------------------------------------------------->
    <div id="slider-banco" class="lof-slidecontent">      
      <!-- MAIN CONTENT --> 
      <div class="main-slider-content" style="width:250px; height:168px;">
              <a href="/page/banco-de-ensino"><img src="/images/frontend/img-banco-geologia-no-brasil.jpg"></a>
      </div>
      <!-- END MAIN CONTENT -->
      <!-- END OF BUTTON PLAY-STOP -->
    </div> 
    
</div>  </div>
  
  <div class="home_article">
    <div class="home_article_title texto_azul" style="position: relative;">
  Publicações
  
  <div class="link_ver_todos" style="position: absolute; right: 0; top: 0;">
    <a href="http://abge.org.br/magento/" target="_blank">Ver todos</a>    
  </div>
  
</div>

<div class="div_float">

<!--Zona - livro 1-->


<!--/* OpenX Javascript Tag v2.8.10 */-->

<!--/*
  * The backup image section of this tag has been generated for use on a
  * non-SSL page. If this tag is to be placed on an SSL page, change the
  *   'http://abge1.hospedagemdesites.ws/openx/www/delivery/...'
  * to
  *   'https://abge1.hospedagemdesites.ws/openx/www/delivery/...'
  *
  * This noscript section of this tag only shows image banners. There
  * is no width or height in these banners, so if you want these tags to
  * allocate space for the ad before it shows, you will need to add this
  * information to the <img> tag.
  *
  * If you do not want to deal with the intricities of the noscript
  * section, delete the tag (from <noscript>... to </noscript>). On
  * average, the noscript tag is called from less than 1% of internet
  * users.
  */-->

<script type="text/javascript"><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=4");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><script type="text/javascript" src="http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php?zoneid=4&amp;cb=41235144086&amp;charset=UTF-8&amp;loc=http%3A//abge.org.br/"></script><div id="beacon_63ce2dca10" style="position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="http://abge1.hospedagemdesites.ws/openx/www/delivery/lg.php?bannerid=68&amp;campaignid=37&amp;zoneid=4&amp;loc=http%3A%2F%2Fabge.org.br%2F&amp;cb=63ce2dca10" width="0" height="0" alt="" style="width: 0px; height: 0px;"></div>
</div>  </div>
  
  <div class="home_article">
    <div class="home_article_title texto_azul" style="position: relative;">
  Vídeos
  <div style="position: absolute; right: 0; top: 0;">
    <a class="link_ver_todos" href="/index.php/abge/videos">Ver todos</a>  </div>
</div>

<div class="div_float">
          <div class="column span-4 first">
            <div class="column span-4 last frameVideo" style="width: 250px; height: 187px; background-color: #fff; border: none;">
                <a href="/index.php/abge/videos/8-AreasDe">
                <div class="video" style="margin-top: 3px; ">
                    <img src="http://img.youtube.com/vi/bhKWHx08jFA/0.jpg" class="lateral">
                </div>
                </a>
            </div>
            
        </div>
    </div>  </div>
  
  <div class="home_article">
    <div class="div_float">
  <a href="http://abge1.hospedagemdesites.ws/frontend.php/abge/forum"><img src="/images/frontend/banner_forum.png"></a></div>  </div>
  
  <div class="home_article">
    <div class="home_article_title texto_azul">
  Receber notícias da ABGE
</div>

<div class="div_float">
    <form id="frm_newsletter" onsubmit="jQuery.ajax({type:'POST',dataType:'html',data:jQuery(this).serialize(),success:function(data, textStatus){jQuery('#content_newsletter').html(data);},beforeSend:function(XMLHttpRequest){$('#indicator').show();$('#content_newsletter').hide();},complete:function(XMLHttpRequest, textStatus){$('#indicator').hide();$('#content_newsletter').show();},url:'/index.php/ajax/recibirNoticia'}); return false;" action="/index.php/ajax/recibirNoticia" method="post">    <div id="indicator" class="" align="left" style="display: none;">
        <p><img src="/images/preload.gif"> Loading...</p>
    </div>
    <div id="content_newsletter">
    <style>
      table, tr, td{
        border:0px !important;
      }
    </style>
    <!--<form id="frm_newsletter" action="" method="post" >-->
        <table border="0" cellpadding="0" cellspacing="5">
            <tbody>                
                <tr>
                    <td align="center" style="padding: 0px !important;">
                        <div id="frmLogin">
                                                                                    <table cellpadding="0" cellspacing="3" border="0" style="margin-top: 0px;margin-bottom: 20px;>
                                <tbody><tr align="left">
                                    <td>
                                        <label for="newsletter_nombre">Nome</label><br>
                                        <input class="validate[required]" size="30" type="text" name="newsletter[nombre]" id="newsletter_nombre">                                    </td>
                                </tr>
                                <tr align="left">
                                    <td style="background-color: #FFF !important;">
                                        <label for="newsletter_email">Email</label><br>
                                        <input class="validate[required]" size="30" type="text" name="newsletter[email]" id="newsletter_email">                                    </td>
                                </tr>
                                <tr>

                                    <td align="right">
                                        <input type="hidden" name="newsletter[id_newsletter]" id="newsletter_id_newsletter">                                        <input type="submit" value="Enviar" class="boton" id="newsletter_button" name="newsletter_button">
                                    </td>
                                </tr>

                            </tbody></table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </form>
</div>  </div>
</div>

		<div class="columna_central_home">
        
        	@yield("maincontent")

		</div>

		<div class="columna_lateral_home" style="padding:0">

            <div class="home_article">
                  
                <div class="home_article_title texto_azul">
                    
                    Socios - Patrocinadores
                
                </div>

                <div class="div_float">

	       			<script type="text/javascript"><!--//<![CDATA[
	        			
	        			var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
	        			var m3_r = Math.floor(Math.random()*99999999999);
	        			if (!document.MAX_used) document.MAX_used = ',';
	        			document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
	        			document.write ("?zoneid=1");
	        			document.write ('&amp;cb=' + m3_r);
	        			if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
	        			document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
	        			document.write ("&amp;loc=" + escape(window.location));
	        			if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
	        			if (document.context) document.write ("&context=" + escape(document.context));
	        			if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
	        			document.write ("'><\/scr"+"ipt>");
	        		//]]>--></script>
	        		<noscript>&lt;a href='http://abge1.hospedagemdesites.ws/openx/www/delivery/ck.php?n=a06014f3&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'&gt;&lt;img src='http://abge1.hospedagemdesites.ws/openx/www/delivery/avw.php?zoneid=1&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;amp;n=a06014f3' border='0' alt='' /&gt;&lt;/a&gt;</noscript>

				</div>
	    		
	    		<div style="position: relative;top: 0px;">
	        		<a style="font-size: 12px; float: right; text-decoration: underline;" href="/page/socio-patro">Ver todos</a>
	        	</div>
	      	
	      	</div>

	      	<div class="home_article">
	        	
	        	<div class="home_article_title texto_azul">
	        		Eventos- Apoio ABGE
	        	</div>

		        <div class="div_float">

		    		<script type="text/javascript"><!--//<![CDATA[
				       var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
				       var m3_r = Math.floor(Math.random()*99999999999);
				       if (!document.MAX_used) document.MAX_used = ',';
				       document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
				       document.write ("?zoneid=2");
				       document.write ('&amp;cb=' + m3_r);
				       if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
				       document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
				       document.write ("&amp;loc=" + escape(window.location));
				       if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
				       if (document.context) document.write ("&context=" + escape(document.context));
				       if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
				       document.write ("'><\/scr"+"ipt>");
				    //]]>--></script>
				    <noscript>&lt;a href='http://abge1.hospedagemdesites.ws/openx/www/delivery/ck.php?n=a09182f5&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'&gt;&lt;img src='http://abge1.hospedagemdesites.ws/openx/www/delivery/avw.php?zoneid=2&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;amp;n=a09182f5' border='0' alt='' /&gt;&lt;/a&gt;</noscript>

		    	</div>
		    
		    	<div style="position: relative;top: 0px;">
		    
		    		<br>
		      		<a style="font-size: 12px; float: right; text-decoration: underline; margin-top:10px;" href="/page/apoio">Ver Todos</a>

		      	</div>
    
    		</div>

    		<div class="home_article">
		     	
		     	<div class="home_article_title texto_azul">
		      		Parceiros
		    	</div>

		    	<div class="div_float">

					<script type="text/javascript"><!--//<![CDATA[
						var m3_u = (location.protocol=='https:'?'https://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php':'http://abge1.hospedagemdesites.ws/openx/www/delivery/ajs.php');
						var m3_r = Math.floor(Math.random()*99999999999);
						if (!document.MAX_used) document.MAX_used = ',';
						document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
						document.write ("?zoneid=3");
						document.write ('&amp;cb=' + m3_r);
						if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
						document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
						document.write ("&amp;loc=" + escape(window.location));
						if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
						if (document.context) document.write ("&context=" + escape(document.context));
						if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
						document.write ("'><\/scr"+"ipt>");
					//]]>--></script>
					<noscript>&lt;a href='http://abge1.hospedagemdesites.ws/openx/www/delivery/ck.php?n=ad50381e&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'&gt;&lt;img src='http://abge1.hospedagemdesites.ws/openx/www/delivery/avw.php?zoneid=3&amp;amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;amp;n=ad50381e' border='0' alt='' /&gt;&lt;/a&gt;</noscript>

				</div>

				<div style="position: relative;top: 0px;">
					<a style="font-size: 12px; float: right; text-decoration: underline;" href="/page/entidades">Ver Todos</a>
				</div>
			
			</div>
		</div>

    </div>

    <div class="div_float footer_container" style="position: fixed;bottom:0px;z-index: 999;">
    	<div id="page" class="container" style="position: relative; height: 100%">
        	<div style="position: absolute; left: 10px; bottom: 10px; width: 814px;">
        		Secretaria Executiva ABGE <br> Av. Profº Almeida Prado, 532 - IPT (Prédio 11) - Cidade Universitária- SP 05508-901
        		Tel.: 11-3767-4361 | abge@abge.org.br
        	</div>
        	<div style="float: right;position: absolute; right: 45px; bottom: 10px;">
        		<a target="_blank" href="http://www.gallardodesigner.com.br/"><img src="/assets/frontend/img/logo-gd.png"></a>    </div>
        	</div>
      	</div>
    </div>


</body>
</html>