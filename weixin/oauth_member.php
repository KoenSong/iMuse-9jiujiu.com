<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理
include('../inc/fun/verification_code.php');
include('model_url.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200px" />
<?=seo_meta();?>
<link href="favicon.ico" rel="shortcut icon">
<link href="../css/global.css" rel="stylesheet" type="text/css" />
<link href="../css/lib.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lang/cn.js"></script>
<script type="text/javascript" src="../js/global.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/jqform.js"></script>
<script type="text/javascript" src="../js/marquee.js"></script>
<script type="text/javascript" src="../js/checkform.js"></script>
<script type="text/javascript" src="../js/checknum.js"></script>
</head>

<body>
<!--头部-->
<div id="Member_Main">
    <?php
    if((int)$_SESSION['member_MemberId']){	//已登录
        //var_dump($_SESSION['member_MemberId']);
        //echo $member_page_contents;
        //echo($_SESSION['member_MemberId']);
        //TODO OAuth2.0网页授权
        if($_SESSION['member_IsTeacher'] == 1){
            $jump_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2bd74751985d977&redirect_uri=http://9jiujiu.com/weixin/oauth2.php?memberid={$_SESSION['member_MemberId']}&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
            js_location($jump_url); 
        }else{
            echo "只有教师才能参与本次活动，请期待更多活动！";
        }
    }else{
    ?>
    <div class="over">
        <div class="blank35"></div>
        <div class="over w1200">
		   <?=$member_page_contents;?>
        </div>
    </div>
    <?php }?>
    <div class="blank50"></div>
</div>
</body>
</html>