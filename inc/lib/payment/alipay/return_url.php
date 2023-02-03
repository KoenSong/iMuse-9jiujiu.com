<?php
include('../../../site_config.php');
include('../../../set/ext_var.php');
include('../../../fun/mysql.php');
include('../../../function.php');
include('../../../../SDK/sendSMS.php');
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
require_once($site_root_path."/inc/lib/payment/alipay/alipay.config.php");
require_once($site_root_path."/inc/lib/payment/alipay/lib/alipay_notify.class.php");


//计算得出通知验证结果
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
$OId			= $_GET['out_trade_no'];	//获取订单号

if($verify_result) {//验证成功
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
    $OId			= $_GET['out_trade_no'];	//获取订单号
    $trade_no		= $_GET['trade_no'];		//获取支付宝交易号
    $total_fee		= $_GET['price']?$_GET['price']:$_GET['total_fee'];			//获取总价格

    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
    }else if($_GET['trade_status'] == 'TRADE_FINISHED') {
		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
    }else {
      //echo "trade_status=".$_GET['trade_status'];
    }
	
	
	$orders = $db->get_one('orders',"OId='$OId'");
	$OrderStatus = $orders['OrderStatus'];
	$Tmakesure_0 = $orders['Tmakesure_0'];
	$Tmakesure_1 = $orders['Tmakesure_1'];
	if($OrderStatus == 1 && $Tmakesure_0 == 1){
		//更新订单
		$db->update('orders', "OId='$OId'", array(
				'OrderStatus'	=>	2,
				'ClassTime'		=>	$service_time,
				'Tmakesure_1'	=>	2
			)
		);
		$order_row=$db->get_one('orders',"OId = '$OId'"); 
		$TPhone=$db->get_value('member',"MemberId = '{$order_row['TeacherId']}'",'Phone');
		$date[]=addslashes($_SESSION['member_UserName']);
		$date[]=$order_row['Grade_Site'];
		$date[]=$order_row['PerTime'].'  '.$order_row['StartTime'].'-'.$order_row['EndTime'];
		$date[]=$order_row['Comments'];
		$date[]=$_SESSION['member_Phone'];
		//发送短信
		$sms = new sendSMS();
		$sms->sendCurSMS($TPhone, $date, '24776');
		$resultStr='付款成功！';
		$jump_url="/account.php?module=orders&act=prelist";
	}else if($OrderStatus == 2 && $Tmakesure_1 == 2){
		$resultStr='已付款成功！';
		$jump_url="/account.php?module=orders&act=prelist";
	}else{
		$resultStr='订单出现异常，请与我们取得联系！';
		$jump_url="/account.php?module=orders&act=prelist";
	}
}else{
    //验证失败
    $resultStr='付款失败，出现验证失败的错误！请与我们取得联系！';
	$jump_url="/member.html?module=orders&do_action=detail&OId=$OId&Status=0";
}
ob_start();
print_r($_GET);
print_r($resultStr);
$log=ob_get_contents();
ob_end_clean();
write_file($save_dir='/log/about_alipay_log/'.date('Y_m_d/', $service_time).'return/', 
	$save_name="return-{$OId}.txt", $contents=$log);

js_location($jump_url,$resultStr);
?>
