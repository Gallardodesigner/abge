

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ABGE - Admin Painel</title>
{{HTML::style("assetsadmin/css/style.default.css")}}
{{HTML::style("assetsadmin/css/responsive-tables.css")}}
{{HTML::style("assets/fancybox/jquery.fancybox.css")}}
@yield("css")

{{HTML::script("assetsadmin/js/jquery-1.9.1.min.js")}}
{{HTML::script("assetsadmin/js/jquery-migrate-1.1.1.min.js")}}
{{HTML::script("assetsadmin/js/jquery-ui-1.9.2.min.js")}}
{{HTML::script("assetsadmin/js/modernizr.min.js")}}
{{HTML::script("assetsadmin/js/bootstrap.min.js")}}
{{HTML::script("assetsadmin/js/jquery.cookie.js")}}
{{HTML::script("assetsadmin/js/jquery.uniform.min.js")}}
<!-- {{HTML::script("assetsadmin/js/flot/jquery.flot.min.js")}} -->
<!-- {{HTML::script("assetsadmin/js/flot/jquery.flot.resize.min.js")}} -->
{{HTML::script("assetsadmin/js/responsive-tables.js")}}
{{HTML::script("assetsadmin/js/custom.js")}}
{{HTML::script("assets/fancybox/jquery.fancybox.js")}}
@yield("js")
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="assetsadmin/js/excanvas.min.js"></script><![endif]-->
</head>

<body>

                <style type="text/css">
                    table{
                        border-collapse:collapse;
                        width: 100%;
                        table-layout: fixed;
                    }

                    td{
                        padding: 10px;  
                        word-wrap:break-word !important;
                        overflow: none !important;
                        white-space: normal !important;
                    }

                    .description{
                        text-align: justify !important;
                    }
/*
                    .fixed{
                        background-color: #ddd;
                        width: 60px;
                    }

                    .fluid{
                        background-color: #aaa;
                    }

                    .visible{

                    }

                    .hidden{
                        overflow:hidden;
                    }
                    */
                </style>
<div class="mainwrapper">
    
    <div class="header">
        <div class="logo">
            <a href="{{{ URL::to('dashboard') }}}">{{HTML::image("assetsadmin/images/logo.png")}}</a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <!-- <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="count">4</span>
                        <span class="head-icon head-message"></span>
                        <span class="headmenu-label">Messages</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Messages</li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jane</strong> <small class="muted"> - 3 days ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Tanya</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Lee</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li class="viewmore"><a href="messages.html">View More Messages</a></li>
                    </ul>
                </li> -->
                <style type="text/css">
                    .dropdown-toggle {
                        text-align: center;
                    }
                    .dropdown-toggle .iconfa-book{
                        font-size: 24pt;
                        text-align: center;
                    }
                    .dropdown-active{
                        color: #FFF !important;
                    }
                </style>
                <li>
                    <a href="/dashboard/courses" class="dropdown-toggle dropdown-active">
                    <!--<span class="count">{{ Route::getCurrentRoute()->getUri() }}</span>-->
                    <span class="iconfa-book"></span>
                    <span class="headmenu-label">{{ Lang::get('titles.courses')}}</span>
                    </a>
                   <!--  <ul class="dropdown-menu newusers">
                        <li class="nav-header">New Users</li>
                        <li>
                            <a href="">
                                {{HTML::image("assetsadmin/images/photos/thumb1.png","",array("class"=>"userthumb"))}}
                                <strong>Draniem Daamul</strong>
                                <small>April 20, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                {{HTML::image("assetsadmin/images/photos/thumb2.png","",array("class"=>"userthumb"))}}
                                <strong>Shamcey Sindilmaca</strong>
                                <small>April 19, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                {{HTML::image("assetsadmin/images/photos/thumb3.png","",array("class"=>"userthumb"))}}
                                <strong>Nusja Paul Nawancali</strong>
                                <small>April 19, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                {{HTML::image("assetsadmin/images/photos/thumb4.png","",array("class"=>"userthumb"))}}
                                <strong>Rose Cerona</strong>
                                <small>April 18, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                {{HTML::image("assetsadmin/images/photos/thumb5.png","",array("class"=>"userthumb"))}}
                                <strong>John Doe</strong>
                                <small>April 16, 2013</small>
                            </a>
                        </li>
                    </ul> -->
                </li>
                <!-- <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                    <span class="count">1</span>
                    <span class="head-icon head-bar"></span>
                    <span class="headmenu-label">Statistics</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Statistics</li>
                        <li><a href=""><span class="icon-align-left"></span> New Reports from <strong>Products</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="icon-align-left"></span> New Statistics from <strong>Users</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="icon-align-left"></span> New Statistics from <strong>Comments</strong> <small class="muted"> - 3 days ago</small></a></li>
                        <li><a href=""><span class="icon-align-left"></span> Most Popular in <strong>Products</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li><a href=""><span class="icon-align-left"></span> Most Viewed in <strong>Blog</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li class="viewmore"><a href="charts.html">View More Statistics</a></li>
                    </ul>
                </li> -->
                <li class="right">
                    <div class="userloggedinfo">
                        {{HTML::image("assetsadmin/images/photos/thumb1.png")}}
                        <div class="userinfo">
                            <h5>{{ Lang::get('nav.username')}} <small>- username@gallardodesigner.com.br</small></h5>
                            <ul>
                                <li><a href="editprofile.html">{{ Lang::get('nav.edit_profile') }}</a></li>
                                <li><a href="">{{ Lang::get('nav.account_settings')}}</a></li>
                                <li><a href="/logout">{{ Lang::get('nav.sign_out')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>
    
    <div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">{{ Lang::get('nav.navigation') }}</li>
                <li class="{{ (Request::is('dashboard') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard') }}"><span class="iconfa-laptop"></span> {{ Lang::get('nav.dashboard') }}</a></li>
                <li class="{{ (Request::is('dashboard/annuities') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard/annuities') }}"><span class="iconfa-money"></span> Anuidade</a></li>
                <li class="{{ (Request::is('dashboard/instructions') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard/instructions') }}"><span class="iconfa-qrcode"></span> Instruções dos Boletos</a></li>
                <li class="dropdown {{ (Request::is('dashboard/clients') ? 'active' : '') }}{{ (Request::is('dashboard/clients/*') ? 'active' : '') }}"><a href=""><span class="iconfa-group"></span>Clientes</a>
                    <ul {{ (Request::is('dashboard/clients') ? 'style="display: block"' : '') }}{{ (Request::is('dashboard/clients/*') ? 'style="display: block"' : '') }}>
                        <li class="dropdown"><a href="">Associados</a>
                        <ul>
                            <li><a href="{{{ URL::to('/dashboard/clients/associates') }}}">Tudo</a></li>
                            <li><a href="{{{ URL::to('/dashboard/clients/associates/create') }}}">Adicionar</a></li>
                        </ul>
                        <li class="dropdown"><a href="">Participantes</a>
                        <ul>
                             <li><a href="{{{ URL::to('/dashboard/clients/participants') }}}">Tudo</a></li>
                            <li><a href="{{{ URL::to('/dashboard/clients/participants/create') }}}">Adicionar</a></li>
                        </ul>
                     </li>
                    </ul>
                </li>
                <li class="dropdown {{ (Request::is('dashboard/courses') ? 'active' : '') }}{{ (Request::is('dashboard/courses/*') ? 'active' : '') }}"><a href=""><span class="iconfa-book"></span>{{ Lang::get('nav.courses') }}</a>
                    <ul {{ (Request::is('dashboard/courses') ? 'style="display: block"' : '') }}{{ (Request::is('dashboard/courses/*') ? 'style="display: block"' : '') }}>
                        <li class="dropdown"><a href="">{{ Lang::get('nav.course') }}</a>
                        <ul>
                            <li><a href="{{{ URL::to('/dashboard/courses') }}}">{{ Lang::get('nav.all') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/courses/create') }}}">{{ Lang::get('nav.add') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/courses/trash') }}}">{{ Lang::get('nav.trashed') }}</a></li>
                        </ul>
                        <li class="dropdown"><a href="">{{ Lang::get('nav.teacher') }}</a>
                        <ul>
                             <li><a href="{{{ URL::to('/dashboard/teachers') }}}">{{ Lang::get('nav.all') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/teachers/create') }}}">{{ Lang::get('nav.add') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/teachers/trash') }}}">{{ Lang::get('nav.trashed') }}</a></li>
                        </ul>
                        <li class="dropdown"><a href="">{{ Lang::get('nav.company') }}</a>
                        <ul>
                           <li><a href="{{{ URL::to('/dashboard/companies') }}}">{{ Lang::get('nav.all') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/companies/create') }}}">{{ Lang::get('nav.add') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/companies/trash') }}}">{{ Lang::get('nav.trashed') }}</a></li>
                        </ul>
                        <li class="dropdown"><a href="">{{ Lang::get('nav.category') }}</a>
                        <ul>
                            <li><a href="{{{ URL::to('/dashboard/categories') }}}">{{ Lang::get('nav.all') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/categories/create') }}}">{{ Lang::get('nav.add') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/categories/trash') }}}">{{ Lang::get('nav.trashed') }}</a></li>
                        </ul>
                        <li class="dropdown"><a href="">{{ Lang::get('nav.event') }}</a>
                        <ul>
                            <li><a href="{{{ URL::to('/dashboard/events') }}}">{{ Lang::get('nav.all') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/events/create') }}}">{{ Lang::get('nav.add') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/events/trash') }}}">{{ Lang::get('nav.trashed') }}</a></li>
                        </ul>
                        <li class="dropdown"><a href="">{{ Lang::get('nav.section') }}</a>
                        <ul>
                            <li><a href="{{{ URL::to('/dashboard/sections') }}}">{{ Lang::get('nav.all') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/sections/create') }}}">{{ Lang::get('nav.add') }}</a></li>
                            <li><a href="{{{ URL::to('/dashboard/sections/trash') }}}">{{ Lang::get('nav.trashed') }}</a></li>
                        </ul>
                     </li>
                    </ul>
                </li>
                <li class="{{ (Request::is('dashboard/news') ? 'active' : '') }}{{ (Request::is('dashboard/news/*') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard/news/') }}"><span class="iconfa-comments-alt"></span> {{ Lang::get('nav.news') }}</a></li>
                <li class="{{ (Request::is('dashboard/arquivos') ? 'active' : '') }}{{ (Request::is('dashboard/arquivos/*') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard/arquivos/') }}"><span class="iconfa-file"></span> {{ Lang::get('nav.arquivos') }}</a></li>
                <li class="{{ (Request::is('dashboard/videos') ? 'active' : '') }}{{ (Request::is('dashboard/videos/*') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard/videos/') }}"><span class="iconfa-facetime-video"></span> {{ Lang::get('nav.videos') }}</a></li>
                <li class="{{ (Request::is('dashboard/pages') ? 'active' : '') }}{{ (Request::is('dashboard/pages/*') ? 'active' : '') }}"><a href="{{ URL::to('/dashboard/pages/') }}"><span class="iconfa-list"></span> {{ Lang::get('Paginas') }}</a></li>
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->
    
    <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="/dashboard"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>@yield("title")</li>
            <li class="right">
                    <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tint"></i>{{ Lang::get('nav.color_skin')}}</a>
                    <ul class="dropdown-menu pull-right skin-color">
                        <li><a href="default">{{ Lang::get('nav.default') }}</a></li>
                        <li><a href="navyblue">{{ Lang::get('nav.navy_blue') }}</a></li>
                        <li><a href="palegreen">{{ Lang::get('nav.pale_green') }}</a></li>
                        <li><a href="red">{{ Lang::get('nav.red') }}</a></li>
                        <li><a href="green">{{ Lang::get('nav.green') }}</a></li>
                        <li><a href="brown">{{ Lang::get('nav.brown') }}</a></li>
                    </ul>
            </li>
        </ul>
        
        <div class="pageheader">
            <form action="results.html" method="post" class="searchbar">
                <input type="text" name="keyword" placeholder="{{ Lang::get('display.to_search_type')}}" />
            </form>
            <div class="pageicon">@yield("iconpage",'<span class="iconfa-laptop"></span>')</div>
            <div class="pagetitle">
                <h5>@yield("maintitle","Dashboard")</h5>
                <h1>@yield("nameview","Dashboard")</h1>
            </div>
        </div><!--pageheader-->
        
        @yield("MainContent")
        <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2014. ABGE.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://www.gallardodesigner.com.br/">Gallardo Designer</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->
<script type="text/javascript">
   /* jQuery(document).ready(function() {
        
      // simple chart
		var flash = [[0, 11], [1, 9], [2,12], [3, 8], [4, 7], [5, 3], [6, 1]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
      var css3 = [[0, 6], [1, 1], [2,9], [3, 12], [4, 10], [5, 12], [6, 11]];
			
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
	
			
		var plot = jQuery.plot(jQuery("#chartplace"),
			   [ { data: flash, label: "Flash(x)", color: "#6fad04"},
              { data: html5, label: "HTML5(x)", color: "#06c"},
              { data: css3, label: "CSS3", color: "#666"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#666', borderWidth: 2, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#chartplace").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});
    
        
        //datepicker
        jQuery('#datepicker').datepicker();
        
        // tabbed widget
        jQuery('.tabbedwidget').tabs();
        
        
    
    });*/
</script>
</body>
</html>
