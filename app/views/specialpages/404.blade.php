<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="eng" lang="eng">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>AGBE - 404 Not Found</title>
	{{HTML::style("http://fonts.googleapis.com/css?family=Bangers&amp;v2")}}
	{{HTML::style("assets/404/styles/reset.css")}}
	{{HTML::style("assets/404/styles/main.css")}}

	{{HTML::script("assets/404/scripts/jquery-1.6.2.js")}}
	{{HTML::script("assets/404/scripts/jquery.spritely-0.5.js")}}


	<!-- <link href='http://fonts.googleapis.com/css?family=Bangers&amp;v2' rel='stylesheet' type='text/css' />	 -->
	<!-- <link rel="stylesheet" type="text/css" href="styles/reset.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="styles/main.css" />	 -->
	<!--<script src="scripts/jquery-1.6.2.js" type="text/javascript"></script>
	<script src="scripts/jquery.spritely-0.5.js" type="text/javascript"></script>-->
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {			
				$('#astronaut')
					.sprite({fps: 30, no_of_frames: 1})
					.spRandom({top: 30, bottom: 200, left: 30, right: 200})
				$('#space').pan({fps: 40, speed: 3, dir: 'right', depth: 50});
			});
		})(jQuery);	
	</script>
<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
<body>
<div id="container">
	<div id="stage" class="stage">
		<div id="space" class="stage"></div>
		<div id="astronaut" class="stage">
			<div id="text_1">Houston,<br />we have a<br />problem!</div>
			<div id="text_2">{{ Lang::get('display.error') }} 404!</div>
			<div id="text_3">The universe<br />you are looking for<br />doesn't exist</div>
			<!-- <div id="text_4">Try to visit another dimension</div>
			<div id="text_5">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Portfolio</a></li>
				</ul>
			</div>
			<div class="search_box">
				<form id="searchform" action="" method="get">
					<input id="s" class="inputField" type="text" name="s" onblur="if (this.value == '') {this.value = 'Or search for new one...';}" onfocus="if (this.value == 'Or search for new one...') {this.value = '';}" value="Or search for new one..." />
					<input id="searchsubmit" class="btn-search" type="submit" value="" />
				</form>
			</div> -->
		</div>
	</div>
</div>
</body>
</html>
