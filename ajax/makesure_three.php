<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理

if($_POST['act']=='Tmakesure_0'){
	if($_SESSION['member_IsTeacher']){
		$OId=$_POST['OId'];
		$where="OId = '$OId'";
		$PerTime=$_POST['PerTime'];
		$start_time_hls = $_POST['start_time_hls'];
		$end_time_hls =  $_POST['end_time_hls'];
		$Comments_two = $_POST['Comments_two'];
		$db->update('order_twos',$where, array(
			'Tmakesure_1'	=>	0,
			'PerTime'		=>	$PerTime,
			'StartTime'				=>	$start_time_hls,
			'EndTime'				=>	$end_time_hls,
			'Comments_two'			=>	$Comments_two
		));
		js_back('确认成功！');
	}else{
		js_back('无权操作！');
	}
}

//单节续课，课程规划表单提交
if($_POST['act'] == 'ctuplan'){
	if($_SESSION['member_IsTeacher']){
		$LId=$_POST['LId'];
		$PerTime=$_POST['PerTime'];
		$start_time_hls = $_POST['start_time_hls'];
		$end_time_hls =  $_POST['end_time_hls'];
		$Comment_T = $_POST['Comment_T'];
		$db->update('order_twos_product_list',"LId = '$LId'", array(
			'Tmakesure_0'	=>	1,
			'PerTime'				=>	$PerTime,
			'StartTime'				=>	$start_time_hls,
			'EndTime'				=>	$end_time_hls,
			'Comment_T'			=>	$Comment_T
		));
		js_back('确认成功！');
	}else{
		js_back('无权操作！');
	}
}
?>

