<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理

if($_POST['act']=='mod_afterclass'){
	$OId =$_POST['OId'];
	$PerTime = $_POST['PerTime'];
	$start_time_hls = $_POST['start_time_hls'];
	$end_time_hls =  $_POST['end_time_hls'];
	$Comments_two = $_POST['Comments_two'];
	$db->update('orders',"OId = '$OId'",array(
			'Tmakesure_1'			=>	0,
			'PerTime'				=>	$PerTime,
			'StartTime'				=>	$start_time_hls,
			'EndTime'				=>	$end_time_hls,
			'Comments_two'			=>	$Comments_two
		));
	js_back('提交成功！');
	//js_location('/account.php?module=orders&OId='.$OId.'&act=detail','提交成功！');
}

?>

