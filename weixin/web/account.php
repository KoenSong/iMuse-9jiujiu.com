<?php 
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/category.php');//分类一起取出处理
include('../../inc/fun/verification_code.php');
include('member/index.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=800px" />
<?=seo_meta();?>
<link href="favicon.ico" rel="shortcut icon">
<link href="/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/lib.css" rel="stylesheet" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<link href="/weixin/web/css/public.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/lang/cn.js"></script>
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/jqform.js"></script>
<script type="text/javascript" src="/js/marquee.js"></script>
<script type="text/javascript" src="/js/checkform.js"></script>
<script type="text/javascript" src="/js/checknum.js"></script>
<style>
/**底部导航栏*/   
.post-div {
    height: 60px;
    width: 100%;
    text-align: center;
    position: fixed;
    line-height: 60px;
    background-color: #fff;
    border-top: 1px solid #DDD;
    bottom: 0;
    z-index:99999;
}
.ul-div{
    width:80%;
    height:60px;
    margin:0px auto;
}
.post-ul{
    
}
.post-ul li{
    float:left;
    width:20%;
}
.post-ul li img{
    padding-top:10px;
}
.search_btn, .search_btn:visited {
    background: #F99E1A url(overlay.png) repeat-x;
    display: inline-block;
    //padding: 5px 10px 6px;
    color: #fff;
    text-decoration: none;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
    text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
    border: 1px solid rgba(0,0,0,0.25);
    position: relative;
    width:90%;height:35px;font-size:18px;font-weight:bold;

}
</style>
</head>
<body>
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
<?php include($site_root_path.'/weixin/web/public/nvg-bottom.php');?>
</body>
</html>