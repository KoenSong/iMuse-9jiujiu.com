<?php
include('../../site_config.php');
include('../../set/ext_var.php');
include('../../fun/mysql.php');
include('../../function.php');

//城市
if($_GET['_City_name'] && $_GET['_CId']){
	$_SESSION['City_name']=	$_GET['_City_name']; //城市名称
	$_SESSION['CId']=$_GET['_CId']; //城市ID
	$_SESSION['ProductCircle']='';
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}elseif(!$_SESSION['City_name'] && !$_SESSION['CId']){
	$_SESSION['City_name']=	$_SESSION['Default_City_name']; //城市名称
	$_SESSION['CId']=$_SESSION['Default_CId']; //城市ID
}

//课程种类
if($_GET['ByCate']=='del'){
	$_SESSION['ProductByCate']=$_SESSION['ProductByName']=0;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}elseif($_GET['ByCate']!=''){
	$ByCate=(int)$_GET['ByCate'];
	$_SESSION['ProductByCate']=$ByCate;  //课程种类ID
	$_SESSION['ProductByName']=$_GET['CateName'];  //课程种类名称
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}

//if($_GET['toClass']=='del'){
//	$_SESSION['ProducttoClass']=0;
//	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
//	exit;
//}elseif($_GET['toClass']!=''){
//	$toClass=(int)$_GET['toClass'];
//	$_SESSION['ProducttoClass']=$toClass;
//	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
//	exit;
//}

//性别
if($_GET['Gender']=='del'){
	$_SESSION['ProductGender']=0;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}elseif($_GET['Gender']!=''){
	$Gender=(int)$_GET['Gender'];
	$_SESSION['ProductGender']=$Gender;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}

//商圈
if($_GET['Circle']=='del'){
	$_SESSION['ProductCircle']=0;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}elseif($_GET['Circle']!=''){
	$Circle=(int)$_GET['Circle'];
	$_SESSION['ProductCircle']=$Circle;
	//echo $_SESSION['ProductCircle'];
	//exit;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}

if($_GET['PriceOrder']=='del'){
	$_SESSION['ProductPriceOrder']=0;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}elseif($_GET['PriceOrder']!=''){
	$PriceOrder=(int)$_GET['PriceOrder'];
	$_SESSION['ProductPriceOrder']=$PriceOrder;
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
	exit;
}
if($_GET['currencies']!=''){
	$mCfg['ExchangeRate'][$_GET['currencies']]['Invocation']==1 && $_SESSION['Currency']=$_GET['currencies'];
	js_location($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/', '', '.top');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="save" content="history" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?=seo_meta();?>
<script language="javascript" src="/js/lang/en.js"></script>
<script language="javascript" src="/js/global.js"></script>
</head>

<body>
<div id="lib_member_info">
	<?php if((int)$_SESSION['member_MemberId']==0){?>
		<a href="<?=$member_url;?>?module=create" class="red">Sign up</a> or <a href="<?=$member_url;?>?module=login" class="red">Login</a>
	<?php }else{?>
		Welcome! <font class="fc_red"><?=htmlspecialchars($_SESSION['member_FirstName'].' '.$_SESSION['member_LastName']);?></font>&nbsp;&nbsp;&#8226; <a href="<?=$member_url;?>">My Account</a>&nbsp;&nbsp;&#8226; <a href="<?=$member_url;?>?module=logout">Sign Out</a>
	<?php }?>
</div>
<script language="javascript">
parent.$_('lib_member_info').innerHTML=$_('lib_member_info').innerHTML;
<?php if($currencies>1){?>
parent.$_('lib_currency').innerHTML=$_('lib_currency').innerHTML;
parent.$_('lib_currency').style.display='block';
<?php }?>
function add_css(str_css){
	try{
		var style=parent.document.createStyleSheet();
		style.cssText=str_css;
	}
	catch(e){
		var style=parent.document.createElement('style');
		style.type='text/css';
		style.textContent=str_css;
		parent.document.getElementsByTagName('head').item(0).appendChild(style);
	}
}
add_css('.price_item_<?=$_SESSION['Currency'];?>{display:inline;}');
</script>
</body>
</html>