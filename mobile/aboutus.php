<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/lib/article/detail_lang_0.php');

//当前视频类型
$result = $db->query('select distinct vedio_type from vedio');
while($row=mysql_fetch_assoc($result)){
  $vedioTypes[]=$row;
}

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
      /*关于*/
      .about-div{margin: 30px; //color: #2B2B2B; }
      .about-title,.about-tell,.about-business{color: #2B2B2B; font-size: 20px; font-weight: 700; margin-left: -30px; }
      .about-info{margin: 0 0 10px; line-height: 30px; }
    </style>
  </head>
  <body>
  <!--引入头部-->
  <?php include('mobilehead.php');?>


  <!-- 关于 -->
  <div class="container about-div">
    <h4 class="about-title">关于九啾啾</h4>
    <p class="about-info">
    九啾啾音乐家教网（9jiujiu.com）通过严格的教师认证体系，专注于为家长提供最为客观的优质师资信息，
    平台真实记录和展现教师教学及用户评价信息，并采用基于地理位置寻找师生、线上担保支付等模式，
    致力于打造成为中国最专业的音乐家教约课平台。
    </p>
    <h4 class="about-tell">联系我们</h4>
    <div class="line">
      <p>在线客服人工服务</p>
      <p>电话：158 2022 6863 (微信同号)</p>
      <p>违法和不良信息举报邮箱：songf@9jiujiu.com</p>
      <p>需要帮助的用户如果较多，客服可能无法迅速答复，请耐心等待哦</p>
    </div>
    <h4 class="about-business">如有合作意向请联系</h4>
    <div class="line">
      <p>QQ：420604452</p>
      <p>电话：020-32086670</p>
      <p>邮箱：songf@9jiujiu.com</p>
    </div>
  </div>

  <!--引入尾部-->
  <?php include('mobilefoot.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  </body>
</html>