<?php
include('site_config.php');
include('set/ext_var.php');
include('fun/mysql.php');
include('function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="save" content="history" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script language="javascript" src="/js/lang/cn.js"></script>
<script language="javascript" src="/js/global.js"></script>
<script language="javascript">
onload=function(){
	parent.$_('select_city').innerHTML=$_('select_city').innerHTML;
	parent.$_('member_lr').innerHTML=$_('member_lr').innerHTML;
}
</script>
</head>

<body>
<div id="select_city">
    <img class="city_img" src="/images/city_tip.png" alt="城市" />
    <span id="Cityname"><?=$_SESSION['City_name']?$_SESSION['City_name']:'选择'?></span>&nbsp;&nbsp;<strong id="city_hand" onclick="city_hand()">[ 城市切换 ]</strong>
    <div class="showcy" id="showCity" style="z-index: 99; opacity: 1;">
        <!--<ul>
        <?php 
            $alter_city=$db->get_all('product_color','1');
                foreach((array) $alter_city as $item){
                ?>
        <li><span><a href="/inc/lib/global/info.php?_City_name=<?=$item['Color']?>&_CId=<?=$item['CId']?>"><?=$item['Color']?></a></span></li>
        <?php }?>
        </ul>-->
        <!--暂时只开放广州区-->
        <ul>
            <li><span><a onclick="select_item()" href="/inc/lib/global/info.php?_City_name=广州市&_CId=1">广州市</a></span></li>
        </ul>
        <div class="clear"></div>
        <p>更多城市即将开放，敬请期待！<?=$_SESSION['Default_City_name'].$_SESSION['Default_CId']?></p>
    </div>
</div>
<div id="member_lr">
	<?php if($_SESSION['member_MemberId']){?>
        <font class="fl">欢迎&nbsp;&nbsp;</font><a style="color:#bbb; width:80px;" href="/account.php?module=orders&act=prelist#contents"><?=$_SESSION['member_UserName']?$_SESSION['member_UserName']:$_SESSION['member_Phone']?>&nbsp;&nbsp;</a>
        <a class="head_reg" href="/account.php?module=logout">退&nbsp;出</a>
    <?php }else{?>
        <a class="head_login" href="/account.php?module=login">登&nbsp;录</a>
        <a class="head_reg" href="/account.php?module=create">注&nbsp;册</a>
    <?php }?>
</div>
</body>
</html>