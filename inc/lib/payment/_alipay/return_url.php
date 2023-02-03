<?php
include('../../../site_config.php');
include('../../../set/ext_var.php');
include('../../../fun/mysql.php');
include('../../../function.php');
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.2
 * 日期：2011-03-25
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn

 * WAIT_SELLER_SEND_GOODS(表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货);
 * TRADE_FINISHED(表示买家已经确认收货，这笔交易完成);
 
 * 如何判断该笔交易是通过即时到帐方式付款还是通过担保交易方式付款？
 * 
 * 担保交易的交易状态变化顺序是：等待买家付款→买家已付款，等待卖家发货→卖家已发货，等待买家收货→买家已收货，交易完成
 * 即时到帐的交易状态变化顺序是：等待买家付款→交易完成
 * 
 * 每当收到支付宝发来通知时，就可以获取到这笔交易的交易状态，并且商户需要利用商户订单号查询商户网站的订单数据，
 * 得到这笔订单在商户网站中的状态是什么，把商户网站中的订单状态与从支付宝通知中获取到的状态来做对比。
 * 如果商户网站中目前的状态是等待买家付款，而从支付宝通知获取来的状态是买家已付款，等待卖家发货，那么这笔交易买家是用担保交易方式付款的
 * 如果商户网站中目前的状态是等待买家付款，而从支付宝通知获取来的状态是交易完成，那么这笔交易买家是用即时到帐方式付款的
 */
 
//require_once("alipay.config.php");
//require_once("lib/alipay_notify.class.php");
require_once($site_root_path."/inc/lib/payment/alipay/alipay.config.php");
require_once($site_root_path."/inc/lib/payment/alipay/lib/alipay_notify.class.php");


//计算得出通知验证结果
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
$OId			= $_GET['out_trade_no'];	//获取订单号

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
    $OId			= $_GET['out_trade_no'];	//获取订单号
    $trade_no		= $_GET['trade_no'];		//获取支付宝交易号
    $total_fee		= $_GET['price']?$_GET['price']:$_GET['total_fee'];			//获取总价格

    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
	else if($_GET['trade_status'] == 'TRADE_FINISHED') {
		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
	

	$db->update('orders', "OId='$OId'", array(
			'OrderStatus'	=>	2,
			'ClassTime'		=>	$service_time,
			'Tmakesure_1'	=>	2
		)
	);

	$errstr='付款成功，请耐心等待发货！';
	$jump_url="/account.php?module=orders&act=prelist";

//---------------------------------------------------------------------------------------发送手机信息------------------------------------------------------------------------
	
include("../../../../SDK/CCPRestSDK.php");

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
		 echo "result error!";
		 break;
	 }
	 if($result->statusCode!=0) {
		//echo "error code :" . $result->statusCode . "<br>";
		//echo "error msg :" . $result->statusMsg . "<br>";
		//TODO 添加错误处理逻辑
	 }else{
		//echo "Sendind TemplateSMS success!<br/>";
		 // 获取返回信息
		 $smsmessage = $result->TemplateSMS;
		 //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
		// echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
		 //TODO 添加成功处理逻辑
	 }
}
$where="OId = '$OId'";
$order_row=$db->get_one('orders',$where); 
$TPhone=$db->get_value('member',"MemberId = '{$order_row['TeacherId']}'",'Phone');
$date[]=addslashes($_SESSION['member_UserName']);
$date[]=$order_row['Grade_Site'];
$date[]=$order_row['PerTime'].'  '.$order_row['StartTime'].'-'.$order_row['EndTime'];
$date[]=$order_row['Comments'];
$date[]=$_SESSION['member_Phone'];
//var_dump($TPhone);
//exit;
//sendTemplateSMS($TPhone,$date,'24776');
//sendTemplateSMS($TPhone,$date,'45358');
//exit;

		
//	echo "验证成功<br />";
//	echo "trade_no=".$trade_no;
	
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数，比对sign和mysign的值是否相等，或者检查$responseTxt有没有返回true
	$errstr='付款失败，出现未知的错误！请与我们取得联系！';
	$jump_url="/member.html?module=orders&do_action=detail&OId=$OId&Status=0";

//    echo "验证失败";
}


ob_start();
print_r($_GET);
print_r($_POST);
echo "\r\n\r\n$verify_result";
echo "\r\n\r\n$errstr";
$log=ob_get_contents();
ob_end_clean();
write_file($save_dir='/_alipay_log/'.date('Y_m/d/', $service_time), $save_name="return-{$OId}.txt", $contents=$log);

echo $errstr;
js_location($jump_url);

?>
