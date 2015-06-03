<html>
<head>
<title>| 15º CBGE | Congresso Brasilerio de Geologia de Engenharia e Ambiental | Bento Gonçalves | RS |</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<!-- <link rel="stylesheet" href="live.css">
<link rel="stylesheet" href="style.css"> -->
</head>
<body>
<style type="text/css">
	/* $Rev: 13164 $ */
	* {
	  margin: 0px;
	  padding: 0px;
	}
	.clear {clear: both;}
	a {text-decoration: underline;}
	a:hover {text-decoration: none;}
	a img {border: 0px;}
	#mainlivedemo {
	    background: url('/img/livedemo/livedemo-bg.jpg') left top repeat-y #181818;
	    border-bottom: 4px solid #535353;
	    color: #898989;
	    padding:0px 20px 0px 20px;
	    height: 51px;
	}
	#mainlivedemo .main {
		/*width: 1220px;
		margin: 0 auto;*/
		font-family: Tahoma;
		position: relative;
	}
	.liveclose {
		float: right;
		width: 147px;
		padding: 8px 0 0px 5px;
	        position:relative;
	}
	.liveclosei {
	    margin: 0 0 10px 0px;
	    overflow: hidden;
	}
	.liveclose img {
		display:block;
		cursor: pointer;
		float: right;
	}
	.prodinfo {
		float: left;
		margin: 0px -507px 0px -210px;
		padding: 5px 0px;
		/*max-width: 508px;*/
		/*min-width: 419px;*/
		width: 100%;
	}
	.ie7 .prodinfo {
	    margin: 0px -507px 0px 0px;
	}
	.prodinfo .border {
		border-left: 1px solid #575757;
		padding: 10px 0px 10px 19px;
		margin: 0px 487px 0px 230px;
	}
	.ie7 .prodinfo .border {
	    margin: 0px 487px 0px 210px;
	}
	.prodinfo span {
	    padding: 0 18px 0 0px;
	}
	.prodinfo a {
	    color:#BCBCBC;
	    text-decoration:underline;
	}
	.prodinfo a:hover {
	    text-decoration:none;
	}
	.prodinfo strong a {
	    color:#BCBCBC;
	    text-decoration:none;
	}
	.prodinfo strong a:hover {
	    text-decoration:underline;
	}
	.price_choice {
	    float: right;
	    background: #2F2F2F;
	    padding: 7px 10px;
	    width: 335px;
	    height: 37px;
	    position: relative;
	}
	/*.ie9 .price_choice {
	    width: 315px;
	}*/
	#price_choice_form {
	    margin:-5px 0 0px 0;
	    float: left;
	}
	.price_choice a {
	    /*float: right;*/
	    display: inline-block;
	    margin: 0 0 0 10px;
	    position: absolute;
	    top: 7px;
	    right: 10px;
	}
	.price_choice p {
	    float: right;
	    font-size: 10px !important;
	    line-height: 12px;
	    padding-left: 5px;
	}
	.price_choice img {
	    vertical-align: bottom;
	}
	.price_choice .price_choice_wrapper {
	    overflow:hidden;
	    clear:both;
	    position:relative;
	    padding-left:20px;
	    line-height: 21px;
	}
	.price_choice input {
	    position:absolute;
	    top:5px;
	    left:0px;
	}
	.mobile .price_choice input {
	    top: 0px;
	}

	.gecko.win .price_choice input {
	    top:4px;
	}

	.ie7 .price_choice input {
	    top:0px;
	    left:0px;
	}

	.price_choice label {
	    font-size:13px;
	    color:#b5b5b5;
	}
	#mainlivedemo .main .price_choice label span {
	    font-size:13px;
	}
	.price_choice .recommended label {
	    color:#ffffff;
	}

	.price_choice .price-value {
	    font-weight:bold;
	}
	.price{
		font-weight: bold;
	}

	.discount{
	    position: relative;
	    white-space: nowrap;
	    font-weight: normal;
	}

	.discount:after{
	    border-top: 1px solid;
	    position: absolute;
	    content: "";
	    right: 0;
	    top:50%;
	    left: 0;
	}

	.livedemo-logo {float: left; width: 190px;}
	.ie7 .livedemo-logo {
	    position: absolute;
	    left: 0px;
	    top: 0px;
	    height: 42px;
	}
	#mainlivedemo .main h3 {
		font-size: 12px;
		padding: 0 0 8px 0;
	}
	#mainlivedemo .main p, #mainlivedemo .main span {
		font-size: 11px;
	}
	#livedemo #facebook_like_button_wrapper {
	    /*width:100%;
	    clear:both;
	    text-align:center;
	    padding:10px 0;*/
	    float: left;
	    margin-right: 12px;
	}
	#livedemo #facebook_like_button {
	    border: medium none;
	    height: 21px;
	    margin: 0px;
	    overflow: hidden;
	    width: 45px;
	}
	#livedemo .socialproofit-button {
	    display: none !important;
	    float: left;
	}
	#livedemo a#socialproofit-openclose.trigger {
	    outline: none;
	}
	#livedemo #socialproofit-addList {
	    display: none;
	}
	form {margin: 0; padding: 0;}
	html {height:100%;/*width:100%;overflow: hidden; background-color: white;*/}
	body {height:100%;width:100%;overflow: hidden; background-color: #fff;}
	html {-webkit-text-size-adjust: none;}
	iframe, #iframelive {width:100%; background-color: #fff;}
	#iframelive.stretched {overflow:auto;}
	*+html #iframelive.stretched {height: 100%;}
	*+html #iframelive.stretched iframe {height: 100%;}
	.opera #iframelive.stretched iframe {height: 100%;}
	/*#iframelive.stretched iframe {overflow-y:scroll;}*/
	/*
	div.iframeltable {height:100%;width:100%; overflow:hidden;}
	div.iframeltable.stretched {height:auto; overflow: auto;}
	div.iframeltable.stretched #iframelive {overflow:hidden;}
	*/
	.price-value ins {
	    color: red;
	    text-decoration: none;
	}
	.popupAltTitleDiscountPrice  {
	    background-color: #FFFFFF;
	    border: 1px solid #6A91B4;
	    color: #000000;
	    cursor: pointer;
	    display: none;
	    font-family: "Tahoma";
	    font-size: 11px;
	    font-weight: normal;
	    position: absolute;
	    white-space: nowrap;
	    z-index: 1001;
	}

	#altDiv, .altDiv {
	    background-color: #EEF6FF;
	    border: 1px solid #6A91B4;
	    font-family: tahoma;
	    font-size: 11px;
	    position: absolute;
	    visibility: hidden;
	    width:200px;
	    z-index: 1;
	    padding:2px 4px 3px 4px;
	}
	#altDiv.popupAltTitleDiscountPrice {
	    width:auto;
	}

	#gui-ga-joomla-1_7-conversion {
		position:absolute;
	}

	@media only screen and (min-width: 1100px) and (max-width: 1189px) {
	    .prodinfo span {
		padding: 0 10px 0 0px;
	    }
	    .prodinfo span.last-child {
		display: none;
	    }
	}
	@media only screen and (min-width: 900px) and (max-width: 1099px) {
	    .prodinfo span {
		display: none;
	    }
	    .prodinfo span.first-child {
		display: inline-block;
		padding: 0 10px 0 0px;
	    }
	}
	@media only screen and (min-width: 768px) and (max-width: 899px) {
	    .liveclose {
		width: 10px;
	    }
	    #livedemo .socialproofit-button {
		display: none !important;
	    }
	    #livedemo #facebook_like_button_wrapper {
		display: none;
	    }
	    .prodinfo .border {
		margin: 0 340px 0 230px;
	    }
	    .ie7 .prodinfo .border {
		margin: 0 340px 0 210px;
	    }
	    .prodinfo span {
		display: none;
	    }
	    .prodinfo span.first-child {
		display: inline-block;
		padding: 0 10px 0 0px;
	    }
	}
	@media only screen and (min-width: 600px) and (max-width: 767px) {
	    .liveclose {
		width: 10px;
	    }
	    #livedemo .socialproofit-button {
		display: none !important;
	    }
	    #livedemo #facebook_like_button_wrapper {
		display: none;
	    }
	    .prodinfo {
		display: none;
	    }
	}
	@media only screen and (min-width: 410px) and (max-width: 599px) {
	    .liveclose {
		width: 10px;
	    }
	    #livedemo .socialproofit-button {
		display: none !important;
	    }
	    #livedemo #facebook_like_button_wrapper {
		display: none;
	    }
	    .prodinfo {
		display: none;
	    }
	    .livedemo-logo {display: none;}
	    .price_choice {
		float: left;
		background: none;
	    }
	}
	@media only screen and (max-width : 409px) {
	    .liveclose {
		width: 10px;
	    }
	    #livedemo .socialproofit-button {
		display: none !important;
	    }
	    #livedemo #facebook_like_button_wrapper {
		display: none;
	    }
	    .prodinfo {
		display: none;
	    }
	    .livedemo-logo {display: none;}
	    .price_choice {
		float: left;
		background: none;
		padding: 7px 0px;
		width: auto;
		height: auto;
	    }
	    #price_choice_form {
		display: none;
	    }
	    .price_choice a {
		left: 0px;
	    }
	    .opera .price_choice a {
		position: inherit;
		top: 0px;
		right: 0px;
		left: 0px;
	    }
	    .price_choice p {
		float: left;
		padding-left: 0px;
	    }
	    /*#mainlivedemo .main .price_choice label span {
		font-size:11px;
	    }*/
	    /*#mainlivedemo {
		padding: 0px;
	    }
	    #mainlivedemo .main {
		margin: 0 auto;
		width: 300px;
	    }*/
	}

</style>
<style type="text/css">
	.clearfix {
	*zoom:1
	}
	.clearfix:before, .clearfix:after {
		display:table;
		content:"";
		line-height:0
	}
	.clearfix:after {
		clear:both
	}
	.hide-text {
		font:0/0 a;
		color:transparent;
		text-shadow:none;
		background-color:transparent;
		border:0
	}
	.input-block-level {
		display:block;
		width:100%;
		min-height:26px;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box
	}
	ul {
		list-style-type:none
	}
	*, a:focus {
		outline:none!important
	}
	body {
		min-width:320px;
		color:#666

	}
	body, html {
		height:100%
	}
	h1, h2, h3, h4, h5, h6 {
		font-family:inherit;
		font-weight:bold;
		line-height:1em;
		color:inherit;
		text-rendering:optimizelegibility
	}
	h1 small, h2 small, h3 small, h4 small, h5 small, h6 small {
		font-weight:normal;
		line-height:1;
		color:#999
	}
	.btn {
		background:#fafafa;
		display:inline-block;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 0 1px #fff;
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 0 1px #fff;
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 0 1px #fff;
		font-size:13px;
		line-height:1em;
		color:#333;
		font-weight:bold;
		text-decoration:none;
		padding:9px 16px 10px 16px;
		margin:0;
		-webkit-transition:none;
		-moz-transition:none;
		-o-transition:none;
		transition:none
	}
	.top-indent {
		margin-top:20px
	}
	.btn-primary {
		background:#2d81d7;
		color:#fff;
		border-color:#2b79cc
	}
	.btn:hover {
		background:0;
		background-color:#f8f8f8;
		background-image:-moz-linear-gradient(top, #fcfcfc, #f3f3f3);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#fcfcfc), to(#f3f3f3));
		background-image:-webkit-linear-gradient(top, #fcfcfc, #f3f3f3);
		background-image:-o-linear-gradient(top, #fcfcfc, #f3f3f3);
		background-image:linear-gradient(to bottom, #fcfcfc, #f3f3f3);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffcfcfc', endColorstr='#fff3f3f3', GradientType=0);
		border-color:#b4b4b4;
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
		color:#333;
		-webkit-transition:none;
		-moz-transition:none;
		-o-transition:none;
		transition:none;
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff;
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff;
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff
	}
	.btn:active {
		background:0;
		background-color:#eaeaea;
		background-image:-moz-linear-gradient(top, #f0f0f0, #e2e2e2);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#f0f0f0), to(#e2e2e2));
		background-image:-webkit-linear-gradient(top, #f0f0f0, #e2e2e2);
		background-image:-o-linear-gradient(top, #f0f0f0, #e2e2e2);
		background-image:linear-gradient(to bottom, #f0f0f0, #e2e2e2);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff0f0f0', endColorstr='#ffe2e2e2', GradientType=0);
		border-color:#b8b8b8;
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1);
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1);
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1)
	}
	.btn:focus {
		background:#fafafa
	}
	.btn-primary:hover {
		background:0;
		background-color:#277acf;
		background-image:-moz-linear-gradient(top, #2e83de, #1d6db9);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#2e83de), to(#1d6db9));
		background-image:-webkit-linear-gradient(top, #2e83de, #1d6db9);
		background-image:-o-linear-gradient(top, #2e83de, #1d6db9);
		background-image:linear-gradient(to bottom, #2e83de, #1d6db9);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff2e83de', endColorstr='#ff1d6db9', GradientType=0);
		text-shadow:-1px -1px 1px rgba(0, 0, 0, 0.2);
		border-color:#0f539b;
		color:#fff;
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff;
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff;
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff
	}
	.btn-primary:active {
		background:0;
		background-color:#2478cd;
		background-image:-moz-linear-gradient(top, #257ad3, #2375c4);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#257ad3), to(#2375c4));
		background-image:-webkit-linear-gradient(top, #257ad3, #2375c4);
		background-image:-o-linear-gradient(top, #257ad3, #2375c4);
		background-image:linear-gradient(to bottom, #257ad3, #2375c4);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff257ad3', endColorstr='#ff2375c4', GradientType=0);
		border-color:#165ca6;
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1);
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1);
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1)
	}
	.btn-primary:focus {
		background:0;
		background-color:#2478cd;
		background-image:-moz-linear-gradient(top, #257ad3, #2375c4);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#257ad3), to(#2375c4));
		background-image:-webkit-linear-gradient(top, #257ad3, #2375c4);
		background-image:-o-linear-gradient(top, #257ad3, #2375c4);
		background-image:linear-gradient(to bottom, #257ad3, #2375c4);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff257ad3', endColorstr='#ff2375c4', GradientType=0);
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false)
	}
	.btn-primary {
		font-size:16px;
		line-height:18px;
		padding:10px 16px 8px
	}
	.img-cart {
		margin:8px 0 16px
	}
	.btn-save {
		color:#999;
		font-weight:bold;
		padding-left:19px;
		background:url(/../themes/default/images/livedemo/marker-btn-save.png) no-repeat 0 2px
	}
	.btn-save:hover {
		color:#2673b4;
		background-position:0 -36px
	}
	#frameWrapper {
		background:none repeat scroll 0 0 transparent;
		height:100%;
		margin:0
	}
	#frame {
		position:relative;
		height:100%
	}
	a.brand_livedemo {
		float:left;
		background:url(/img/livedemo/logo_livedemo.png) no-repeat 0 0;
		display:block;
		font-size:0;
		height:31px;
		line-height:0;
		margin:9px 0 0;
		overflow:hidden;
		padding:0;
		position:relative;
		text-indent:-9999px;
		width:166px;
		z-index:99;
		margin-left: 25px;
	}
	#advanced {
		position:relative;
		z-index:998;
		height:50px;
		top:0;
		left:0
	}
	#advanced .bg {
		height:50px;
		border-bottom:1px solid #cbc999;
		background:#ffffe6;
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.2)
	}
	#advanced span.trigger {
		display:block;
		position:absolute;
		background:#ffffe6;
		width:81px;
		height:26px;
		left:17px;
		bottom:-27px;
		cursor:pointer;
		border:1px solid #cbc999;
		border-top:0;
		-webkit-border-bottom-right-radius:6px;
		-moz-border-radius-bottomright:6px;
		border-bottom-right-radius:6px;
		-webkit-border-bottom-left-radius:6px;
		-moz-border-radius-bottomleft:6px;
		border-bottom-left-radius:6px;
		-webkit-box-shadow:0 2px 2px rgba(0, 0, 0, 0.1);
		-moz-box-shadow:0 2px 2px rgba(0, 0, 0, 0.1);
		box-shadow:0 2px 2px rgba(0, 0, 0, 0.1)
	}
	#advanced span.trigger em {
		background:url(/img/livedemo/trigger-arrow.png) no-repeat 0 0;
		background-repeat:no-repeat;
		display:block;
		width:17px;
		height:10px;
		position:absolute;
		left:32px;
		bottom:8px
	}
	#advanced.closed span.trigger em {
		background-position:0 bottom
	}
	.topbar_info {
		float:right;
		position:relative
	}
	.topbar_info .buy_now {
		margin:4px 25px 0 26px
	}
	.topbar_info .buy_now .dropdown-toggle {
		padding:14px 8px 13px;
		border-bottom-right-radius:6px!important;
		border-top-right-radius:6px!important
	}
	.topbar_info .buy_now>a {
		color:#fff;
		text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);
		position:relative;
		padding:4px 20px;
		text-align:center;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
		font-size:16px;
		line-height:18px;
		border-bottom-left-radius:6px!important;
		border-top-left-radius:6px!important
	}
	.topbar_info .buy_now>a span {
		font-size:11px;
		line-height:14px;
		color:#d3e4f5;
		font-weight:normal;
		text-shadow:none
	}
	.topbar_info .buy_now>a> span{display: block;}

	.topbar_info .buy_now>a span.price { font-weight: bold;}

	.topbar_info .buy_now>a:hover {
		color:#d3e4f5
	}
	.topbar_info .buy_now.btn-group.open button.btn-primary.dropdown-toggle {
		background:0;
		background-color:#2478cd;
		background-image:-moz-linear-gradient(top, #257ad3, #2375c4);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#257ad3), to(#2375c4));
		background-image:-webkit-linear-gradient(top, #257ad3, #2375c4);
		background-image:-o-linear-gradient(top, #257ad3, #2375c4);
		background-image:linear-gradient(to bottom, #257ad3, #2375c4);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff257ad3', endColorstr='#ff2375c4', GradientType=0);
		border-color:#165ca6;
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1);
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1);
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.1), inset 0 5px 5px rgba(0, 0, 0, 0.1)
	}
	.topbar_info .buy_now.btn-group button.btn-primary:hover {
		background:0;
		background-color:#277acf;
		background-image:-moz-linear-gradient(top, #2e83de, #1d6db9);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#2e83de), to(#1d6db9));
		background-image:-webkit-linear-gradient(top, #2e83de, #1d6db9);
		background-image:-o-linear-gradient(top, #2e83de, #1d6db9);
		background-image:linear-gradient(to bottom, #2e83de, #1d6db9);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff2e83de', endColorstr='#ff1d6db9', GradientType=0);
		text-shadow:-1px -1px 1px rgba(0, 0, 0, 0.2);
		border-color:#0f539b;
		color:#fff;
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);
		-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff;
		-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff;
		box-shadow:0 1px 2px rgba(0, 0, 0, 0.2), inset 0 0 1px #fff
	}
	.topbar_info .buy_now.btn-group button.dropdown-toggle:focus {
		background:0;
		background-color:#2478cd;
		background-image:-moz-linear-gradient(top, #257ad3, #2375c4);
		background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#257ad3), to(#2375c4));
		background-image:-webkit-linear-gradient(top, #257ad3, #2375c4);
		background-image:-o-linear-gradient(top, #257ad3, #2375c4);
		background-image:linear-gradient(to bottom, #257ad3, #2375c4);
		background-repeat:repeat-x;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff257ad3', endColorstr='#ff2375c4', GradientType=0);
	filter:progid:DXImageTransform.Microsoft.gradient(enabled = false)
	}
	.topbar_info .buy_now.btn-group button.dropdown-toggle em {
		background:url("/img/sprite.png") no-repeat scroll -193px -78px transparent;
		display:block;
		width:7px;
		height:13px;
		cursor:pointer;
		z-index:1000
	}
	.topbar_info .buy_now, .topbar_info .view_options {
		float:right
	}
	.box-drop {
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
		background:#fff;
		border:1px solid #cdcdcd;
		-webkit-box-shadow:inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .3);
		-moz-box-shadow:inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .3);
		box-shadow:inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .3);
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		margin-top:1px;
	/*	width:363px;*/
		padding:8px 0 15px 18px;
		float:none;
		right:0;
		left:auto
	}
	.list-drop {
		margin:0;
		padding:0
	}
	.list-drop li {
		font-size:13px;
		padding:8px 120px 7px 0;
		position:relative;
		line-height:19px
	}
	.list-drop li>a {
		color:#4f4f4f;
		position:relative
	}
	.list-drop li>a:hover {
		color:#2673b4
	}
	.list-drop li .recommended {
		background:url(/img/livedemo/bg-recom.png) no-repeat 0 0;
		color:#fff;
		font-size:12px;
		padding:5px 10px 5px 18px;
		display:block;
		position:absolute;
		top:1px;
		right:-1px;
		font-weight:normal
	}
	.list-drop li a:hover .popover {
		opacity:1;
		filter:alpha(opacity=100);
	-webkit-transition:all .3s ease;
	-moz-transition:all .3s ease;
	-o-transition:all .3s ease;
	transition:all .3s ease
	}
	.list-drop li .popover {
		right:84%;
		top:36px;
		padding-top:11px;
		margin-right:-20px;
		background:#ffe;
		color:#4d4d4d;
		line-height:15px;
		font-size:12px;
		padding-right:5px
	}
	.ie .list-drop li a .popover {
		right:105px;
	}
	.list-drop li a .popover h6 {
		padding-bottom:0;
		margin-bottom:4px
	}
	.name_template {
		float:right;
		font-size:13px;
		line-height:16px;
		color:#4f4f4f;
		padding:18px 0 0;
		position:relative
	}
	.name_template .link-1 {
		position:relative;
		overflow:hidden;
		border-bottom: 1px dotted #0179C6;
	}
	.name_template .link-1:hover .popover {
		opacity:1;
		filter:alpha(opacity=100);
	-webkit-transition:all .3s ease;
	-moz-transition:all .3s ease;
	-o-transition:all .3s ease;
	transition:all .3s ease
	}
	.popover {
		position:absolute;
		cursor:default;
		pointer-events:none;
	-webkit-transition:all .3s ease;
	-moz-transition:all .3s ease;
	-o-transition:all .3s ease;
	transition:all .3s ease;
		box-shadow:0 3px 5px rgba(0, 0, 0, 0.3);
		top:24px;
		display:block;
		right:-203px;
		left:auto;
		opacity:0;
		filter:alpha(opacity=0);
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
	/*	background:#ffe;*/
		border:1px solid #cecece;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		width:260px;
		padding:1px 13px 11px
	}
	.popover:before {
		background:url(/img/livedemo/angle_popover.png) no-repeat 0 0;
		width:22px;
		height:11px;
		position:absolute;
		right:223px;
		top:-11px;
		content:"";
		display:block
	}
	.list-drop .popover {
		position:absolute;
		cursor:default;
		pointer-events:none;
	-webkit-transition:all .3s ease;
	-moz-transition:all .3s ease;
	-o-transition:all .3s ease;
	transition:all .3s ease;
		box-shadow:0 3px 5px rgba(0, 0, 0, 0.3);
		top:36px;
		display:block;
		right:200px;
		left:auto;
		opacity:0;
		filter:alpha(opacity=0);
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
	/*	background:#ffe;*/
		border:1px solid #cecece;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		width:260px;
		padding:1px 13px 11px;
	}
	.list-drop  .popover:before {
		background:url(/img/livedemo/angle_popover.png) no-repeat 0 0;
		width:22px;
		height:11px;
		position:absolute;
		right:27px !important;
		top:-11px;
		content:"";
		display:block;
	}
	.popover h6 {
		font-weight:bold;
		font-size:12px;
		color:#4d4d4d;
		padding-bottom:2px;
			padding-top: 5px;
	}
	.popover .template_details {
		margin:0
	}
	.popover .template_details li {
		font-size:11px;
		color:#4d4d4d;
		line-height:13px;
		padding-bottom:5px
	}
	.view_options {
		position:relative;
	}
	.view_options dt {
		border:1px solid #ffffe6;
		position:relative;
		padding:11px 10px 5px;
		width:47px;
		margin:1px 0 1px!important;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
		-webkit-border-radius:4px;
		-moz-border-radius:4px;
		border-radius:4px;
		cursor:pointer;
			height: 37px;
	}
	.view_options dt:before {

		width:5px;
		height:16px;
		position:absolute;
		right:7px;
		top:11px;
		display:block;
		content:""
	}
	.view_options dt:hover, .view_options dt.active {
		border:1px solid #e1e1d4;
	}
	.view_options dt img {
		width:21px;
		height:21px;
		display:inline-block;
		position: relative;
		top: -4px;
		left: -3px;
		float: left;
	}
	.view_options dd {
		border:1px solid #cecece;
		-webkit-border-radius:4px;
		-moz-border-radius:4px;
		border-radius:4px;
		background:#fff;
		margin:0;
		position:absolute;
		left:auto;
		right:-8px;
		top: 50px;
		padding: 16px 24px 14px;
		width: 180px;
	}
	.view_options dd iframe {
		width: 228px;
		height: 228px !important;
		overflow: hidden;
		padding: 0 16px 7px 0;

	}
	.view_options ul {
		margin:0;
		overflow:hidden;
		padding:0
	}
	.view_options ul li {
		padding-bottom:13px;
		float:left;
		padding:0 5px
	}
	.view_options ul li a {
		opacity:1;
		filter:alpha(opacity=100)
	}
	.view_options ul li.active a, .view_options ul li a:hover {
		opacity:.5;
		filter:alpha(opacity=50)
	}
	@media(min-width:1200px) {
	.top_container {
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
	width: 1170px !important;
	}
	}
	@media only screen and (min-width:980px) and (max-width:1050px) {

	}
	@media only screen and (max-width:979px) {
	.view_options {
	display:none
	}

	}
	@media only screen and (min-width:768px) and (max-width:865px) {

	}
	@media only screen and (min-width:768px) and (max-width:979px) {
	.top_container {
	width:724px
	}

	}
	@media only screen and (max-width:767px) {
	.top_container {
	width:100%;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
	}

	.topbar_info .buy_now {
		margin-left: 10px;
	}
	}
	@media(max-width:670px) {
	a.brand_livedemo {
	float:left;
	background:url(/img/livedemo/logo_livedemo_small.png) no-repeat 0 0;
	height:30px;
	margin:9px 0 0 25px;
	width:34px
	}

	}
	@media(max-width:538px) {
	.name_template {
	display:none
	}
	}
	@media(max-width:480px) {
	.popover {
	display:none;}
	.topbar_info .buy_now>a {
		padding:5px 14px;}

	}


	.already-get {			/*class for buy button when template already in the shopping cart */
		font-size: 14px !important;
		letter-spacing: -1px;
		margin-top: 7px;
		border-radius: 6px !important;
		padding: 5px 10px !important;
	}
	a.brand_livedemo {
		width: 36px;
	}
	.name_template {
		float: left;
		margin-left: 8px;
	}
	#responsivator {
		float: left;
		margin: 16px 0 0 0;
	}
	#responsivator li {
		float: left;

		margin: 0 17px 0 0;
	}
	#responsivator li.active {
		float: left;

	}
	#responsivator li.qr {
		opacity: 1 !important;
	}
	.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
		width: 100%;
	}
	.responsive-block {
		width: 260px;
		float:left;
		height: 50px;
		position: absolute;
		top: -5px;
		display: none;
		left: 50%;
		margin-left: -130px;
	}
	@media(max-width:670px) {
		.responsive-block {
			display: none !important;
		}
	}
	#qr-text {
		float:left;
		background:url("/img/livedemo/qr-text.png") no-repeat scroll 3px -20px;
		background-color: #282828;
		height:21px;
		width:180px;
		position: relative;
		right:0px;
		top: -10px;
	}
	#desktop {
		position: relative;
		top: 0px;
		left: 0px;
		background:url("/img/sprite.png") no-repeat scroll 3px 0 transparent;
		width:34px;
		height:26px;
		display: block;
		float: right;
		margiN: 1px 0 0 1px;
		cursor: pointer;
	}
	#desktop:hover,
	#desktop.active {

		background:url("/img/sprite.png") no-repeat scroll 3px -34px transparent;

	}
	#tablet-landscape {
		position: relative;
		top: 0px;
		left: 0px;
		background:url("/img/sprite.png") no-repeat scroll -49px 0 transparent;
		width:22px;
		height:22px;
		display: block;
		float: right;
		margiN: 1px 0 0 1px;
		cursor: pointer;
	}
	#tablet-landscape:hover,
	#tablet-landscape.active {

		background:url("/img/sprite.png") no-repeat scroll -49px -34px transparent;

	}
	#tablet-portrait {
		position: relative;
		top: 0px;
		left: 0px;
		background:url("/img/sprite.png") no-repeat scroll -90px 0 transparent;
		width:18px;
		height:24px;
		display: block;
		float: right;
		margiN: 1px 0 0 1px;
		cursor: pointer;
	}
	#tablet-portrait:hover,
	#tablet-portrait.active {

		background:url("/img/sprite.png") no-repeat scroll -91px -33px transparent;

	}
	#iphone-landscape {
		position: relative;
		top: 0px;
		left: 0px;
		background:url("/img/sprite.png") no-repeat scroll -129px 0 transparent;
		width:20px;
		height:20px;
		display: block;
		float: right;
		margiN: 1px 0 0 1px;
		cursor: pointer;
	}
	#iphone-landscape:hover,
	#iphone-landscape.active {

		background:url("/img/sprite.png") no-repeat scroll -128px -33px transparent;

	}
	#iphone-portrait {
		position: relative;
		top: 0px;
		left: 0px;
		background:url("/img/sprite.png") no-repeat scroll -166px 0 transparent;
		width:12px;
		height:26px;
		display: block;
		float: right;
		margiN: 1px 0 0 1px;
		cursor: pointer;
	}
	#iphone-portrait:hover,
	#iphone-portrait.active {

		background:url("/img/sprite.png") no-repeat scroll -166px -33px transparent;

	}
	#qr {
		position: relative;
		top: -6px;
		left: -3px;
	}
	#qr-arr {
		background:url(/img/livedemo/qr-arr.png) no-repeat 0 0;
	height:26px;
	width:15px;
		position: relative;
		left: 181px;
		top: 0px;
	}
	@media(max-width:350px) {
		#livedemo #advanced a.brand {
			margin-left: 5px;
		}
		#livedemo #advanced div.topbar_info div.btn-group {
			margin-right: 5px;
		}
	}
	#livedemo #qr dl._slide-down1 dd.clearfix img {
		max-width: none;
	}
	.view_options dd:before {
		background:url(/img/livedemo/angle_popover.png) no-repeat 0 0;
		width:22px;
		height:11px;
		position:absolute;
		right:6px;
		top:-11px;
		content:"";
		display:block
	}
	#arr,#arr2 {
		background:url(/img/sprite.png) no-repeat -193px -8px;
		width:10px;
		height:10px;
		display: block;
		float: right;
		margin: 1px 0 0 4px;
	}
	#arr2 {
		margin: 0px -8px 0 0px;
	}
	#arr {
		background:url(/img/sprite.png) no-repeat -188px -6px;
		margin: 0;
		padding: 5px 3px 2px 4px;
		width: 7px;
	}
	#popover2 {
		opacity: 1;
		display: none;
		top: 52px;
		position: absolute;
		top: 0;
		left: 0;
		z-index: 9999999;
		border:1px solid #cecece;
		-webkit-border-radius:4px;
		-moz-border-radius:4px;
		border-radius:4px;
		background:#fff;
		margin:0;
		position:absolute;
		left:auto;
		right:-129px;
		top: 55px;
		padding: 18px 2px 8px 16px;
		width: 180px;
	}
	#popover2:before {
			background:url(/img/livedemo/angle_popover.png) no-repeat 0 0;
		width:22px;
		height:11px;
		position:absolute;
		right:155px;
		top:-11px;
		content:"";
		display:block
	}
	#popover2 a{
		color: inherit;
	}
	#popover2 a:hover{
		color:#2673b4
	}

	#popover2 span {
		float: left;
		width: 13px;
		height: 15px;
		display: block;
		margin: 0 7px 14px 0;
	}
	#popover2 #pop_link1 {
		background:url("/img/sprite.png") no-repeat scroll -50px -77px transparent;
	}
	#popover2 #pop_link2 {
		background:url("/img/sprite.png") no-repeat scroll -9px -77px transparent;
	}
	#popover2 #pop_link3 {
		background:url("/img/sprite.png") no-repeat scroll -94px -77px transparent;
	}
	.ie9 #popover2 #pop_link1 {
		background:url("/img/sprite.png") no-repeat scroll -50px -78px transparent;
	}
	.ie9 #popover2 #pop_link2 {
		background:url("/img/sprite.png") no-repeat scroll -9px -78px transparent;
	}
	.ie9 #popover2 #pop_link3 {
		background:url("/img/sprite.png") no-repeat scroll -94px -78px transparent;
	}
	.mac.safari #livedemo #headerlivedemo #buy-button.btn {
		padding: 14px 8px 14px;
	}
	.js-none {
		display: none;
	}
</style>
<div id="iframelive" class="" style="height: 235px;">
<div id="frameWrapper">
<iframe id="frame" frameborder="0" src="http://cbge2015.hospedagemdesites.ws/php/index.php">
</iframe>
</div>
</div>
<script src="/cbge20150/compiled.js">
	
</script>
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