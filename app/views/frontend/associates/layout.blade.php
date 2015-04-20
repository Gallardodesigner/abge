<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>ABGE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="/css/fonts.googleapis.com.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<!-- <link href="/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/> -->
	<link href="/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
	<!-- <link href="/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/> -->
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
	<!-- <link href="/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/> -->
	<!-- <link href="/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/> -->
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-select/bootstrap-select.min.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="/plugins/select2/select2.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/jquery-multi-select/css/multi-select.css"/> -->
	<!-- BEGIN THEME STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/morris/morris.css" rel="stylesheet" type="text/css">

	<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-datepicker/css/datepicker.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap-navbar-dropdowns/css/navbar.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/fancybox/source/jquery.fancybox.css"/>
	<!-- END PLUGINS USED BY X-EDITABLE -->
	<link rel="stylesheet" type="text/css" href="/plugins/DataTables-1.10.6/media/css/jquery.dataTables.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/DataTables-1.10.6/extensions/Responsive/css/dataTables.responsive.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/DataTables-1.10.6/extensions/Scroller/css/dataTables.scroller.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/DataTables-1.10.6/extensions/TableTools/css/dataTables.tableTools.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="/plugins/pace/themes/pace-theme-minimal.css"/> -->
	<link rel="stylesheet" type="text/css" href="/plugins/fancybox/source/jquery.fancybox.css"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<!-- <link href="/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/> -->
	<!-- END PAGE STYLES -->
	<!-- BEGIN THEME STYLES -->
	<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
	<!-- <link href="/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/> -->

	<link rel="stylesheet" type="text/css" href="/css/material-ui-color-palette.css"/>
	<link rel="stylesheet" type="text/css" href="/css/tile.css"/>
	<!-- END THEME STYLES -->
	<style type="text/css">
		.center{
			text-align: center;
		}
		.right{
			text-align: right;
		}
		.left{
			text-align: left;
		}
	</style>
	<link rel="shortcut icon" href="favicon.ico"/>

	@yield('css')
</head>
<body>

	<header class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<h3>ASSOCIAÇÃO BRASILEIRA DE GEOLOGIA DE ENGENHARIA E AMBIENTAL</h3>		
		</div>
		<div class="col-md-1"></div>
	</header>

	<div class="row">
		
		<div class="navbar navbar-default">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="#">ABGE</a>
	            </div>
	            <div class="collapse navbar-collapse">
	                <ul class="nav navbar-nav">
	                    <li class="{{ $module == 'associados_index' ? 'active' : '' }} "><a href="/associados">Principal</a></li>
	                    <li class="{{ $module == 'associados_anuidade' ? 'active' : '' }} "><a href="/associados/anuidades">Anuidade</a></li>
	                    <li class="{{ $module == 'associados_cadastro' ? 'active' : '' }} "><a href="/associados/cadastro">Meu Cadastro</a></li>
	                    <li class="{{ $module == 'associados_ajuda' ? 'active' : '' }} "><a href="/associados/ajuda">Ajuda</a></li>
	                    <li class="{{ $module == 'associados_logout' ? 'active' : '' }} "><a href="/associados/salir">Salir</a></li>
	                    <!-- 
	                    <li>
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 2 <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                            <li><a href="#">Action</a></li>
	                            <li><a href="#">Another action</a></li>
	                            <li><a href="#">Something else here</a></li>
	                            <li><a href="#">Separated link</a></li>
	                            <li class="divider"></li>
	                            <li><a href="#">One more separated link</a></li>
	                            <li>
	                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret caret-right"></b></a>
	                                <ul class="dropdown-menu">
	                                    <li><a href="#">Action</a></li>
	                                    <li><a href="#">Another action</a></li>
	                                    <li><a href="#">Something else here</a></li>
	                                    <li class="divider"></li>
	                                    <li><a href="#">Separated link</a></li>
	                                    <li class="divider"></li>
	                                    <li>
	                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret caret-right"></b></a>
	                                        <ul class="dropdown-menu">
	                                            <li>
	                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret caret-right"></b></a>
	                                                <ul class="dropdown-menu">
	                                                    <li><a href="#">Action</a></li>
	                                                    <li><a href="#">Another action</a></li>
	                                                    <li><a href="#">Something else here</a></li>
	                                                    <li class="divider"></li>
	                                                    <li><a href="#">Separated link</a></li>
	                                                    <li class="divider"></li>
	                                                    <li><a href="#">One more separated link</a></li>
	                                                </ul>
	                                            </li>
	                                        </ul>
	                                    </li>
	                                </ul>
	                            </li>
	                        </ul>
	                    </li> -->
	                </ul>
	            </div><!--/.nav-collapse -->
	        </div>
	    </div>
		
	</div>

	<div class="row">

			@yield('content')
		
	</div>

		
	

	<!--[if lt IE 9]>
	<script src="/plugins/respond.min.js"></script>
	<script src="/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	
	<script type="text/javascript" src="/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>

	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
	<script src="/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<script src="/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	<script src="/plugins/jquery.mockjax.js" type="text/javascript" ></script>
	<script src="/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js" type="text/javascript"></script>
	<script src="/plugins/bootstrap-editable/inputs-ext/address/address.js" type="text/javascript"></script>
	<script src="/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js" type="text/javascript"></script>
	<script src="/plugins/bootstrap-navbar-dropdowns/js/navbar.js" type="text/javascript"></script>

	<script type="text/javascript" charset="utf8" src="/plugins/DataTables-1.10.6/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="/plugins/DataTables-1.10.6/extensions/Responsive/js/dataTables.responsive.js"></script>
	<script type="text/javascript" charset="utf8" src="/plugins/DataTables-1.10.6/extensions/Scroller/js/dataTables.scroller.js"></script>
	<script type="text/javascript" charset="utf8" src="/plugins/DataTables-1.10.6/extensions/TableTools/js/dataTables.tableTools.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE DATATABLES SCRIPTS -->
	<!--- <script type="text/javascript" src="/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
	<script type="text/javascript" src="/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
	<script type="text/javascript" src="/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script> -->
	<script type="text/javascript" src="/plugins/moment/moment.js"></script>
	<script type="text/javascript" src="/plugins/fancybox/source/jquery.fancybox.js"></script>
	<!-- END PAGE DATATABLES SCRIPTS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<!-- END PAGE LEVEL SCRIPTS -->
	<script type="text/javascript" src="/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- END JAVASCRIPTS -->

	@yield('javascripts')
</body>
</html>