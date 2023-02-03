<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理
include('../SDK/sendSMS.php');

if($_GET['act']=='Tmakesure_0' || $_GET['act']=='Tmakesure_1'){
	if($_SESSION['member_IsTeacher']){
		$OId=$_GET['OId'];
		$where="OId = '$OId'";
		$act=$_GET['act'];
		$PerTime=$_GET['PerTime'];
		$TotalPrice=$_GET['TotalPrice'];
		
		if($act=='Tmakesure_0'){//确定约课
			$db->update('orders',$where, array(
				'Tmakesure_1'	=>	0,
				'PerTime'		=>	$PerTime,
				'TotalPrice'	=>	$TotalPrice,
			));
		}elseif($act=='Tmakesure_1'){

			$db->update('orders',$where, array(
				'Tmakesure_1'	=>	1,
				'Tmakesure_Time'=> time(),
			));	
			
			$order_row=$db->get_one('orders',$where);
			//---------------------------------------------------------------------------------------发送手机信息------------------------------------------------------------------------
	
			include("../SDK/CCPRestSDK.php");
			
			//主帐号
			$accountSid= '8a48b5514e3e5862014e429645e2033a';
			
			//主帐号Token
			$accountToken= '355072b6aeaa4893ae0f623b2ae57650';
			
			//应用Id
			$appId='aaf98f894e52805a014e566534d7034a';
			
			//请求地址，格式如下，不需要写https://
			$serverIP='app.cloopen.com';
			
			//请求端口 
			$serverPort='8883';
			
			//REST版本号
			$softVersion='2013-12-26';
			
			
			/**
			  * 发送模板短信
			  * @param to 手机号码集合,用英文逗号分开
			  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
			  * @param $tempId 模板Id
			  */       
			function sendTemplateSMS($to,$datas,$tempId)
			{
				 // 初始化REST SDK
				 global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
				 $rest = new REST($serverIP,$serverPort,$softVersion);
				 $rest->setAccount($accountSid,$accountToken);
				 $rest->setAppId($appId);
				
				 // 发送模板短信
				// echo "Sending TemplateSMS to $to <br/>";
				 $result = $rest->sendTemplateSMS($to,$datas,$tempId);
				 if($result == NULL ) {
					// echo "result error!";
					 break;
				 }
				 if($result->statusCode!=0) {
					// echo "error code :" . $result->statusCode . "<br>";
					// echo "error msg :" . $result->statusMsg . "<br>";
					 //TODO 添加错误处理逻辑
				 }else{
					// echo "Sendind TemplateSMS success!<br/>";
					 // 获取返回信息
					 $smsmessage = $result->TemplateSMS;
					// echo "dateCreated:".$smsmessage->dateCreated."<br/>";
					//echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
					 //TODO 添加成功处理逻辑
				 }
			}
			$date[]=$order_row['ProName'];
			$date[]=$db->get_value('product_category',"CateId = '{$order_row['CateId']}'",'Category');
			$date[]=$order_row['OId'];
			$date[]=date('Y-m-d',$service_time);
			//$SPhone='15013059002';
			//var_dump($date);
			$SPhone=$db->get_value('member',"MemberId = '{$order_row['MemberId']}'",'Phone');
			sendTemplateSMS($SPhone,$date,'24777');
			//---------------------------------------------------------------------------------------发送手机信息------------------------------------------------------------------------
		}
		
		js_back('确认成功！');
	}else{
		js_back('无权操作！');
	}
}elseif($_GET['act']=='Smakesure_0'){
	if(!$_SESSION['member_IsTeacher']){
		$OId=$_GET['OId'];
		$where="OId = '$OId'";
		$db->update('orders',$where, array(
			'Smakesure_0'	=>	1,
			'Smakesure'		=>	1,
			'OrderStatus'	=>	3,
		));
		$TeacherId= $db->get_value('orders',$where,'TeacherId');
		$Price = $db->get_value('orders',$where,'TotalPrice');
		$Account_Price=$db->get_value('member',"MemberId = '$TeacherId'",'Account_Price');
		$db->update('member',"MemberId = '$TeacherId'",array('Account_Price'=>(float)$Account_Price+(float)$Price));
		js_back('确认成功！');
	}else{
		js_back('无权操作！');
	}
}

if($_POST['act']=='ContinueClass'){
	$OId=$_POST['OId'];
	$Qty=(int)$_POST['Qty'];
	$singlePrice = $_POST['singlePrice'];
	$PerTime = $_POST['PerTime'];
	$start_time_hls = $_POST['start_time_hls'];
	$end_time_hls =  $_POST['end_time_hls'];
	$td_evaluate = $_POST['td_evaluate'];//学生留言
	$tea_evaluate = $_POST['tea_evaluate'];//老师留言		
	$TotalPrice =  sprintf("%.2f", $Qty * $singlePrice);

	
	$where="OId = '$OId'";
	$order_row=$db->get_one('orders',$where);
	
	while(1){
		$OId=date('YmdHis', $service_time).rand(10, 99);
		if(!$db->get_row_count('order_twos', "OId='$OId'")){
			break;
		}
	}
	$db->insert('order_twos', array(
		'OId'					=>	$OId,
		'MemberId'				=>	addslashes($order_row['MemberId']),
		'Phone'					=>	$order_row['Phone'],
		'TotalPrice'			=>	$TotalPrice,
		'Shipping_Name'			=>	$order_row['Shipping_Name'],
		'ProName'				=>	addslashes($order_row['ProName']),
		'Grade_Site'			=>	addslashes($order_row['Grade_Site']),
		'Class_Site'			=>	addslashes($order_row['Class_Site']),
		'Comments'				=>	addslashes($td_evaluate),
		'Comments_two'			=>	addslashes($tea_evaluate),
		'ProId'					=>	addslashes($order_row['ProId']),
		'OrderTime'				=>	$service_time,
		'OrderStatus'			=>	1,
		'PerTime'				=>	$PerTime,
		'StartTime'				=>	$start_time_hls,
		'EndTime'				=>	$end_time_hls,
		'CateId'				=>	addslashes($order_row['CateId']),
		'TeacherId'				=>	addslashes($order_row['TeacherId']),
		'Phone'					=>	addslashes($order_row['Phone']),
		'Tmakesure_0'			=>	1,
		'qty'					=>	$Qty
	));
	$product_row=$db->get_one('product',"ProId = '{$order_row['ProId']}'",'PicPath_0');
	$img_dir=mk_dir('/images/orders_two/'.date('Y_m/', $service_time).$OId.'/');
	$OrderId=$db->get_insert_id();
	
	$img_path=$img_dir.basename($product_row['PicPath_0']);
	@copy($site_root_path.$product_row['PicPath_0'], $site_root_path.$img_path);
	for($i=1;$i<$Qty+1;$i++){
		$db->insert('order_twos_product_list', array(
				'Class_num'		=>	$i,
				'OrderId'		=>	$OrderId,
				'ProId'			=>	addslashes($order_row['ProId']),
				'Name'			=>	addslashes($order_row['ProName']),
				'TeacherId'		=>	$order_row['TeacherId'],
				'MemberId'		=>	$order_row['MemberId'],
				'Price'			=>	$singlePrice,
				'Qty'			=>	1,//默认一节课时
			)
		);
	}
	//js_location('/account.php?module=orders&act=list','续课成功！');
	//js_location('/cart.php?module=payment_two&OId='.$OId,'续课成功！');
	//js_back('无权操作！');
	if(!$_SESSION['member_IsTeacher']){
		js_location('/cart.php?module=payment_two&OId='.$OId,'续课成功！');
	}else{
		//TODO发送续课短信
		$TPhone=$db->get_value('member',"MemberId = '{$order_row['MemberId']}'",'Phone');
		$date[]=$order_row['ProName'];
		$date[]=$Qty;
		$date[]=$PerTime."日".$start_time_hls."-".$end_time_hls;
		$date[]=$_SESSION['member_Phone'];
		//发送短信
		$sms = new sendSMS();
		$sms->sendCurSMS($TPhone, $date, '57977');
		js_location('/account.php?module=orders&act=list','发起续课成功！');
	}
}

?>

