<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?=Ly200::seo_tkd();?>
<link href="/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/lib.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="/js/lang/zh-cn.js"></script>
<script language="javascript" src="/js/global.js"></script>
<style type="text/css">
html, body{background:#fff;}
</style>
</head>

<body>
<?php
$par=@explode('/', $_GET['par']);

if($par[0]=='alipay'){
	if($par[1]=='return'){
		include(RP.'/inc/lib/payment/alipay/return_url.php');
	}else{
		include(RP.'/inc/lib/payment/alipay/notify_url.php');
	}
}elseif($par[0]=='unionpay'){
	include(RP.'/inc/lib/payment/unionpay/return_url.php');
}
?>
</body>
</html>