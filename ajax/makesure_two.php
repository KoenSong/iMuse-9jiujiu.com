<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理
include('../SDK/sendSMS.php');

if($_GET['act'] == 'ctuOrder_T'){
	//老师确认续课小节
	$OId=$_GET['OId'];
	$class_num=$_GET['class_num'];
	$where="OrderId = '$OId' and Class_num='$class_num'";
	$db->update('order_twos_product_list',$where, array(
		'Smakesure'			=>	1,//老师确定上课，但钱没转给老师
		'finish_time'		=>	$service_time
	));
	$order_row=$db->get_one('order_twos',"OrderId = '$OId'");
	//短信内容
	$TPhone=$db->get_value('member',"MemberId = '{$order_row['MemberId']}'",'Phone');
	$date[]=$order_row['ProName'];
			$date[]=$db->get_value('product_category',"CateId = '{$order_row['CateId']}'",'Category');
			$date[]=$order_row['OId'];
			$date[]=date('Y-m-d',$service_time);
	//发送短信
	$sms = new sendSMS();
	$sms->sendCurSMS($TPhone, $date, '24777');
	js_back('确认成功！');
}else if($_GET['act'] =='ctuOrder_S'){
	//学生确认续课小节
	$OId=$_GET['OId'];
	$class_num=$_GET['class_num'];
	
	$where="OrderId = '$OId' and Class_num = '$class_num'";
	$order_row = $db->get_one('order_twos', "OrderId = '$OId'");
	$class_row = $db->get_one('order_twos_product_list',$where);
	//如果续课小节订单，不是48小时系统默认完结订单
	if($class_row['Smakesure'] != 2){
		$db->update('order_twos_product_list',$where, array(
			'Smakesure'		=>	2,
		));
		$TeacherId= $db->get_value('order_twos',"OrderId = '$OId'",'TeacherId');
		$Price = $class_row['Price'];
		$Account_Price=$db->get_value('member',"MemberId = '$TeacherId'",'Account_Price');
		$db->update('member',"MemberId = '$TeacherId'",array('Account_Price'=>(float)$Account_Price+(float)$Price));
	}
	$FinishQty = $db->get_row_count('order_twos_product_list', "OrderId = '$OId' and Smakesure = 2");
	if($FinishQty == $order_row['qty']){
		//续课小节全部完结，更新续课总订单
		$db->update('order_twos',"OrderId = '$OId'", array(
			'OrderStatus'	=>	3,
		));
	}
	js_back('确认成功！');
}
?>

