<?php 
include('inc/site_config.php');
include('inc/set/ext_var.php');
include('inc/fun/mysql.php');
include('inc/function.php');
include('inc/category.php');//分类一起取出处理

$ad=$db->get_one('ad',"AId = 1");
?>

<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>啾啾</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="MyMobile/assets/i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="MyMobile/assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="MyMobile/assets/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="MyMobile/assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="MyMobile/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="MyMobile/assets/css/app.css">
  
  
  <?=seo_meta();?>
	<link href="/css/global.css" rel="stylesheet" type="text/css" />
	<link href="/css/lib.css" rel="stylesheet" type="text/css" />
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/checkform.js"></script>
	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/js/marquee.js"></script>
  
  
</head>
<body>
	
	<div data-am-widget="gotop" class="am-gotop am-gotop-fixed">
	  <a href="#top" title="回到顶部">
	    <span class="am-gotop-title">回到顶部</span>
	    <i class="am-gotop-icon am-icon-chevron-up"></i>
	  </a>
	</div>

	
	<div class="am-dropdown" data-am-dropdown style="width:100%">
		 <button class="am-btn am-btn-primary am-dropdown-toggle" data-am-dropdown-toggle style="margin-left:10px">
		  <?=$_SESSION['City_name']?$_SESSION['City_name']:'城市'?><span class="am-icon-caret-down"></span>
		 </button>
		 <ul class="am-dropdown-content">
			 <?php 
		      $alter_city=$db->get_all('product_color','1');
		      foreach((array) $alter_city as $item){?>
		      <li><a href="/inc/lib/global/info.php?_City_name=<?=$item['Color']?>&_CId=<?=$item['CId']?>"><?=$item['Color']?></a></li>
		   <?php }?>
		 </ul>
		 
         <div style="float:right" style="margin-right:10px">
		 	<button type="button" class="am-btn am-btn-success">登陆</button>
		 	<button type="button" class="am-btn am-btn-danger">注册</button>
		 </div>
	</div>
	
	
		
	
	<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
	  <ul class="am-slides">
	    <li><img src="http://s.amazeui.org/media/i/demos/bing-1.jpg" /></li>
	    <li><img src="http://s.amazeui.org/media/i/demos/bing-2.jpg" /></li>
	  </ul>
	</div>

		
		
	<div class="am-u-lg-6">
		<div class="am-input-group am-input-group-primary">
		   <span class="am-input-group-btn">
		      <button class="am-btn am-btn-primary" type="button"><span class="am-icon-search"></span></button>
		   </span>
		   <input type="text" class="am-form-field">
		</div>
	</div>
	
	<hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
		

	
	
	
	
	

<!--在这里编写你的代码-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="MyMobile/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="MyMobile/assets/js/amazeui.min.js"></script>
</body>
</html>