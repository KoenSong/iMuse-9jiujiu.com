<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理

if($_GET['act']=='remove'){
	$OId =$_GET['OId'];
	$db->delete('order_twos', "OId='$OId'");
	js_back('删除成功！');
}

if($_GET['act']=='remove_perlist'){
	$OId =$_GET['OId'];
	$db->delete('orders', "OId='$OId'");
	js_back('删除成功！');
}

?>

