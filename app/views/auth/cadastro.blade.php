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
            
		<div align="justify">
			@if($page)
				{{ $page->content }}
			@endif
		    

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

