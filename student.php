<?php 
include('inc/site_config.php');
include('inc/set/ext_var.php');
include('inc/fun/mysql.php');
include('inc/function.php');
include('inc/category.php');//分类一起取出处理

$ad=$db->get_one('ad',"AId = 3");
include($site_root_path.'/inc/lib/student/detail_lang_0.php');

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
<link href="/css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="/js/checkform.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/marquee.js"></script>
<script type="text/javascript" src="/js/lang/cn.js"></script>
</head>

<body>
<div class="head_detail">
	<?php include($site_root_path.'/inc/head_detail.php');?>
</div>
<div id="Deproduct">
	<div class="warp">
    	<div class="blank30"></div>
		<div class="Product_detail">
        	<?=$product_detail_lang_0;?>
        </div>
	</div>
</div>
<?php include($site_root_path.'/inc/foot.php');?>
</body>
</html>