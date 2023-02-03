<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/lib/article/detail_lang_0.php');

session_start();
$openid = $_SESSION['openid'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!--去除ios号码样式-->
    <meta name="format-detection" content="telephone=no" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>九啾啾|最好的音乐老师都在这里</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/mobile/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mobile/css/main.css">
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>   
      body{padding-top: 0px;} 
      /*关注*/
      .about-div{margin: 0px 30px;}
      .about-title,.about-tell,.about-business{color: #2B2B2B; font-size: 20px; font-weight: 700; margin-left: -30px; }
      .about-info{margin: 0 0 10px; line-height: 30px; }
      .ad img{width: 100%}
      .long-p{color: #3e3e3e;text-align: center;margin-bottom: 0px; border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;line-height: 30px;}
      .long-p .star{color: #f60;}
      .wx{text-align: center;}
      .wx img{width: 45%;}
    </style>
  </head>
  <body>
  <!-- 关注 -->
  <div class="container about-div">
    <h4 class="about-title">关注九啾啾</h4>
    <p class="long-p"><span class="star">★</span>长按识别下面的二维码<span class="star">★</span><br/>关注九啾啾|最好的音乐老师都在这里</p>
    <div class="ad">
      <img src="/mobile/img/wx-logo.jpg"/>
    </div>
    <div class="wx">
      <img src="/mobile/img/logo.png" alt="九啾啾注册商标">
    </div>
  </div>
  

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  </body>
</html>