<?php 
include('inc/site_config.php');
include('inc/set/ext_var.php');
include('inc/fun/mysql.php');
include('inc/function.php');
include('inc/category.php');//分类一起取出处理
include('inc/fun/verification_code.php');
include('inc/lib/member/index.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200px" />
<?=seo_meta();?>
<link href="favicon.ico" rel="shortcut icon">
<link href="/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/lib.css" rel="stylesheet" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/lang/cn.js"></script>
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/jqform.js"></script>
<script type="text/javascript" src="/js/marquee.js"></script>
<script type="text/javascript" src="/js/checkform.js"></script>
<script type="text/javascript" src="/js/checknum.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.js"></script>
</head>

<body>
<div class="head_detail">
	<?php if($module!='login' || $module!='forgot' ){include($site_root_path.'/inc/head_detail.php');}?>
</div>
<!--头部-->
<div id="Member_Main" style=" background:url(<?=$module=='create'|| $module=='forgot'?$db->get_value('ad',"AId = 5",'PicPath_0'):''?>) no-repeat center center;" >
    <?php
    if((int)$_SESSION['member_MemberId']){	//已登录
        echo $member_page_contents;
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
<!--尾部-->

<div class="clear"></div>
<?php  if($module!='login' || $module!='forgot'){include($site_root_path.'/inc/foot.php');}?>
</body>
</html>