<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1  maximum-scale=1 user-scalable=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="HandheldFriendly" content="True">

	<link rel="stylesheet" href="/mstore/css/materialize.css">
	<link rel="stylesheet" href="/mstore/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/mstore/css/normalize.css">
	<link rel="stylesheet" href="/mstore/css/owl.carousel.css">
	<link rel="stylesheet" href="/mstore/css/owl.theme.css">
	<link rel="stylesheet" href="/mstore/css/owl.transitions.css">
	<link rel="stylesheet" href="/mstore/css/fakeLoader.css">
	<link rel="stylesheet" href="/mstore/css/animate.css">
	<link rel="stylesheet" href="/mstore/css/style.css">
	
	<link rel="shortcut icon" href="/mstore/img/favicon.png">

</head>
<body>

<!-- navbar top -->
<div class="navbar-top">
    <!-- site brand	 -->
    <div class="site-brand">
        <!-- <a href="index.html"><h1>Mstore</h1></a> -->
        <a href="index.html"><h1>不管怎样，都要尽力去做</h1></a>
    </div>
    <!-- end site brand	 -->
    <div class="side-nav-panel-right">
        <a href="#" data-activates="slide-out-right" class="side-nav-left"><i class="fa fa-user"></i></a>
    </div>
</div>
@yield('content')
<!-- 主页头部 -->




<!-- 主页底部 -->
<div class="footer">
    <div class="container">
        <div class="about-us-foot">
            <h6>Mstore</h6>
            <p>is a lorem ipsum dolor sit amet, consectetur adipisicing elit consectetur adipisicing elit.</p>
        </div>
        <div class="social-media">
            <a href=""><i class="fa fa-facebook"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-google"></i></a>
            <a href=""><i class="fa fa-linkedin"></i></a>
            <a href=""><i class="fa fa-instagram"></i></a>
        </div>
        <div class="copyright">
            <span>© 2017 All Right Reserved</span>
        </div>
    </div>
</div>
<!-- end footer -->
	
<!-- scripts -->
<script src="/mstore/js/jquery.min.js"></script>
<script src="/mstore/js/materialize.min.js"></script>
<script src="/mstore/js/owl.carousel.min.js"></script>
<script src="/mstore/js/fakeLoader.min.js"></script>
<script src="/mstore/js/animatedModal.min.js"></script>
<script src="/mstore/js/main.js"></script>
@yield('bottom')