<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ABGE - Administration Panel</title>
<link rel="stylesheet" href="/assetsadmin/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="/assetsadmin/css/style.shinyblue.css" type="text/css" />

<script type="text/javascript" src="/assetsadmin/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/assetsadmin/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="/assetsadmin/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="/assetsadmin/js/modernizr.min.js"></script>
<script type="text/javascript" src="/assetsadmin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assetsadmin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/assetsadmin/js/custom.js"></script>
</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="/assetsadmin/images/logo.png" alt="" /></div>
        <form id="login" method="post">
            @if(isset($msg_error))
                <div class="inputwrapper">
                    <div class="alert alert-error">{{$msg_error}}</div>
                </div>
            @endif
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="login" id="login" placeholder="Digite aqui seu login" required/>
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Digite aqui seu senha" required/>
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Sign In</button>
            </div>
            <!-- <div class="inputwrapper animate4 bounceIn">
                <label><input type="checkbox" class="remember" name="signin" /> Keep me sign in</label>
            </div> -->
            
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2014. ABGE. All Rights Reserved. - Design by <a href="http://www.gallardodesigner.com.br" style="color: #FFF !important;">GallardoDesigner</a></p>
</div>

</body>
</html>
