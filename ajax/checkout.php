<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理
if($_POST['data']=='cart_checkout'){
	$AllTime=1;								//总时间
	$grade_site=$_POST['grade_site']; 		//请选择年级排名
	$class_site=$_POST['class_site']; 		//请选择班级排名
	$PerTime=$_POST['PerTime'];				//约课日期
	$start_time_hls=$_POST['start_time_hls'];	//时间开始
	$end_time_hls=$_POST['end_time_hls']; 		//时间结束
	$ProId=(int)$_POST['ProId'];			//产品Id
	$td_evaluate=$_POST['td_evaluate'];		//备注留言
	$Price = $_POST['price'];				//价格
	$product_row=$db->get_one('product',"ProId = '{$ProId}'");
	$product_ext=$db->get_one('product_ext',"ProId = '{$ProId}'");
	$TPhone=$db->get_value('member',"MemberId = '{$product_row['MemberId']}'",'Phone');
	//------生成订单号-----------
	while(1){
		$OId=date('YmdHis', $service_time).rand(10, 99);
		if(!$db->get_row_count('orders', "OId='$OId'")){
			break;
		}
	}
	//------生成订单号-----------
	$MemberId=$_POST['_MemberId'];
	if($db->get_row_count('orders',"MemberId='{$MemberId}' and {$service_time}-OrderTime<3600*24")>20){
		js_location("/",'一天内不能超过20次约课！');	
	}
	
	$db->insert('orders', array(
			'OId'					=>	$OId,
			'MemberId'				=>	$MemberId,
			'Email'					=>	(int)$_SESSION['member_MemberId']?addslashes($_SESSION['member_Email']):$_POST['Email'],
			//'TotalPrice'			=>	$product_row['Price_1'],
			'TotalPrice'			=>	$Price,
			'Shipping_Name'			=>	addslashes($_SESSION['member_UserName']),
			'ProName'				=>	addslashes($product_row['Name']),
			'Grade_Site'			=>	addslashes($grade_site),
			'Class_Site'			=>	addslashes($class_site),
			'Comments'				=>	$td_evaluate,
			'ProId'					=>	$ProId,
			'OrderTime'				=>	$service_time,
			'OrderStatus'			=>	1,
			//'AllTime'				=>	$AllTime,
			'StartTime'				=>	$start_time_hls,
			'EndTime'				=>	$end_time_hls,
			'CateId'				=>	$product_row['CateId'],
			'PerTime'				=>	$PerTime,
			'TeacherId'				=>	$product_row['MemberId'],
			'Phone'					=>	$_SESSION['member_Phone'],
			'Tmakesure_0'			=>	1
		)
	);
	$img_dir=mk_dir('/images/orders/'.date('Y_m/', $service_time).$OId.'/');
	$OrderId=$db->get_insert_id();
	$product_row['PicPath_0']=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg';
	$img_path=$img_dir.basename($product_row['PicPath_0']);
	@copy($site_root_path.$product_row['PicPath_0'], $site_root_path.$img_path);
	
	$db->insert('orders_product_list', array(
			'OrderId'	=>	$OrderId,
			'ProId'		=>	(int)$product_row['ProId'],
			'CateId'	=>	(int)$product_row['CateId'],
			'Name'		=>	addslashes($product_row['Name']),
			'PicPath'	=>	addslashes($img_path),
			//'Price'		=>	(float)$product_row['Price_1'],
			'Price'		=>	(float)$Price,
			'Qty'		=>	1,
		)
	);
	//$db->delete('shopping_cart', "MemberId='{$_SESSION['member_MemberId']}'");	//删除购物车的物品
	
	//include($site_root_path.'/inc/lib/mail/order_create.php');
	//include($site_root_path.'/inc/lib/mail/template.php');
	//sendmail((int)$_SESSION['member_MemberId']?$_SESSION['member_Email']:$_POST['Email'], $shipping_address['FirstName'].' '.$shipping_address['LastName'], "你的订单--{$OId}", $mail_contents);
	
	//js_location("/account.php?module=orders&act=prelist",'约课成功！');
	js_location("/cart.php?module=payment&OId=".$OId,'约课成功！');
}

?>

