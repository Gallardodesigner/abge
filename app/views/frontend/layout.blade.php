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
            <a href="http://abge.org.br/index.php/"><img src="/assets/frontend/img/logo_header.png"></a>  </div>
            <div style="float:left; margin-left: 430px;margin-top: 20px;">
              <a href="https://www.facebook.com/abge.abge" target="_blank"><img src="/assets/frontend/img/face-abge.jpg" border="0"></a></div>
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


        </div> 
      </div>
    </div>
    <div id="page" class="container" style="padding-top: 15px;">
        @yield("maincontent")
    </div>
    <div class="div_float footer_container" style="position: fixed;bottom:0px;">
      <div id="page" class="container" style="position: relative; height: 100%">
        <div style="position: absolute; left: 10px; bottom: 10px; width: 814px;">
          Secretaria Executiva ABGE <br> Av. Profº Almeida Prado, 532 - IPT (Prédio 11) - Cidade Universitária- SP 05508-901
          Tel.: 11-3767-4361 | abge@abge.org.br
        </div>
        <div style="float: right;position: absolute; right: 45px; bottom: 10px;">
          <a target="_blank" href="http://www.gallardodesigner.com.br/"><img src="/assets/frontend/img/logo-gd.png"></a>    </div>
        </div>
      </div>


</body>
</html>