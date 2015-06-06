<html>
<head>
<title>| 15º CBGE | Congresso Brasilerio de Geologia de Engenharia e Ambiental | Bento Gonçalves | RS |</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" href="live.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="iframelive" class="" style="height: 235px;">
<div id="frameWrapper">
<iframe id="frame" frameborder="0" src="http://cbge2015.hospedagemdesites.ws/php/index.php">
</iframe>
</div>
</div>
<script src="compiled.js"></script>
<script type="text/javascript">
			$(function() {
				// IPad/IPhone
				var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
						ua = navigator.userAgent,
						gestureStart = function() {
					viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
				},
						scaleFix = function() {
					if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
						viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
						document.addEventListener("gesturestart", gestureStart, false);
					}
				};
				scaleFix();
			});

//		    function to fix height of iframe!
			var calcHeight = function() {
				var headerDimensions = $('#headerlivedemo').height();
				var selector = '#iframelive';
				if ($('#advanced').hasClass('closed')) {
					$(selector).height($(window).height());
				} else {
					$(selector).height($(window).height() - headerDimensions);
				}
			}
			$(document).ready(function() {
				calcHeight();
			});
			$(window).resize(function() {
				calcHeight();
			}).load(function() {
				calcHeight();
			});
			</script>
</body></html>