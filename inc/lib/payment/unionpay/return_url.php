<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];


    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		$db->update('orders', "OId='$out_trade_no'", array(
				'OrderStatus'	=>	2,
				'ClassTime'		=>	$service_time,
			)
		);
	
		$errstr='付款成功，请耐心等待发货！';
		$jump_url="/account.php?module=orders&act=prelist";
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
		
	echo "验证成功<br />";
	
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
		sendTemplateSMS($TPhone,$date,'24776');
}
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝纯网关接口</title>
	</head>
    <body>
    </body>
</html>