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
  <title>Eventos - ABGE</title>
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
.course_title{
  margin-bottom: 40px;
}
.thumb{
  display: inline-block;
}
.data-adress, .data-adress p
{
  display: inline-block;
}
.footer_container{
  margin-top: 30px;
}
.content{
  width:720px;/*
  margin-left: -10px;
  padding-right: 10px;*/
  float: right;
}
.content p{
  text-align: justify;
}
table{
  border:1px solid;
}
  .menu_lat ul{
    list-style: none
  }
  .menu_lat ul li a{
    font-size: 13px;
    padding-top: 12px;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    height: 22px;
    text-decoration: none;
    color: #C0D3E7;
    border-bottom: 2px solid #1c4976;
    display: block;
    width: 100%;
    background: #00366c;
  }
.updateform{
  position: relative;
}
.updateform .control-box{
  display: block;
  width: 100%;
  clear: both;
  text-align: left;
}
.updateform .control-box a{
  text-decoration: none;
  margin-top: 10px;
  margin-bottom: 10px;
  display: inline-block;
  text-align: right;
}
.updateform .control-box a .right{
  float: right;
}
.updateform label {
  float: left;
  vertical-align: middle;
  display: inline-block;
  margin-top: 15px;
}
.titulo_empresa{
  display: block;
  text-align: center;
  margin: 15px auto;
  padding-bottom: 5px;
  border-bottom: 1px solid #0066CC;
}
.titulo_empresa h3{
  color: #0066CC;
  text-transform: uppercase;
  margin-bottom: 0px;
}
.updateform input[type="text"],.updateform input[type="email"],.updateform input[type="password"], .updateform input[type="number"], .updateform select{
  display: inline-block;
  padding: 5px 20px;
  width: 80%;
  float:right;
}

.updateform input[type="submit"]{
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance:none;
  padding: 15px 10px;
  color: white;
  background: #00366c;
  border: none;
  text-transform: uppercase;
  display: block;
  float: right;
  cursor: pointer;
}

.submitwork input[type="text"]{
  padding:5px 20px !important;
  display: block;
  width: 100%;
  margin-bottom:20px;
}
  .file {
  position: relative;
  display: inline-block;
}
.file label {
  background: #39D2B4;
  padding: 10px 20px;
  color: #fff;
  font-weight: bold;
  font-size: .9em;
  transition: all .4s;
}
.file input {
  position: absolute;
  display: inline-block;
  left: 0;
  top: 0;
  opacity: 0.01;
  cursor: pointer;
}
.file input:hover + label,
.file input:focus + label {
  background: #34495E;
  color: #39D2B4;
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
      <div style="width:100%; margin-bottom:20px;">
        @if ($course->header!="")
        <div style="overflow:hidden;height: 190px;">
          <img src="/uploads/headers/{{$course->header}}" alt="">
        </div>
        @endif
      </div>
      <div class="columna_lateral_home">
        <div class="menu_lat">
          <ul>
            @foreach($contents as $link)
              <li><a href="{{URL::to('/'.$course->route.'/conteudo/'.$link->id)}}">{{$link->section->title}}</a></li>
            @endforeach
            <!--
            @if(count($course->usertypes) > 0)
              <li><a href="{{URL::to('/'.$course->route.'/inscricoes/')}}">INSCRIÇÕES</a></li>
            @endif
            @if($course->event->upload)
              <li><a href="{{URL::to('/'.$course->route.'/trabalhos/')}}">SUBMETA SEU TRABALHO</a></li>
            @endif
            -->
          </ul>
        </div>
      </div>




        @yield("maincontent")




        
    <div class="div_float footer_container">
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