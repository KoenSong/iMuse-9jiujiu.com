<?php
include('../../../site_config.php');
include('../../../set/ext_var.php');
include('../../../fun/mysql.php');
include('../../../function.php');
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.2
 * 日期：2011-03-25
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 
 * WAIT_BUYER_PAY(表示买家已在支付宝交易管理中产生了交易记录，但没有付款);
 * WAIT_SELLER_SEND_GOODS(表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货);
 * WAIT_BUYER_CONFIRM_GOODS(表示卖家已经发了货，但买家还没有做确认收货的操作);
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
$verify_result = $alipayNotify->verifyNotify();
$OId			= $_POST['out_trade_no'];		//获取订单号
if($verify_result) {
	//验证成功
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    $OId			= $_POST['out_trade_no'];		//获取订单号
    $trade_no		= $_POST['trade_no'];	    	//获取支付宝交易号
    $total			= $_POST['price']?$_POST['price']:$_POST['total_fee'];				//获取总价格

	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
		//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款			
        echo "success";		//请不要修改或删除
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货			
        echo "success";		//请不要修改或删除
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
		//该判断表示卖家已经发了货，但买家还没有做确认收货的操作			
        echo "success";		//请不要修改或删除
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {
		//该判断表示买家已经确认收货，这笔交易完成\			
        echo "success";		//请不要修改或删除
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    else {
		//其他状态判断
        echo "success";
        //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
	
	$OId=$_POST['out_trade_no'];
	//更新充值记录

	$orderThrees = $db->get_one('order_threes',"OId='$OId'");
	$curStatus = $orderThrees['OrderStatus'];
	$recordStatus = $db->get_value('recharge_record', "OId='$OId'", 'Status');

	/**	如果页面跳转出现网络异常或客户手动中断等异常，没有更新数据，充值成功
	 *	异步返回操作，检查状态，完成充值
	 */
	if($curStatus == 1 && $recordStatus == 0){
		$db->update('order_threes', "OId='$OId'", array(
				'OrderStatus'	=>	2,
				'OrderTime'		=>	$service_time,
			)
		);
		$db->update('recharge_record', "OId='$OId'", array(
				'Status'	=>	1,
				'PostTime'		=>	$service_time,
			)
		);
		//增加个人账户金额
		$orderThrees = $db->get_one('order_threes',"OId='$OId'");
		$curStatus = $orderThrees['OrderStatus'];
		$recordStatus = $db->get_value('recharge_record', "OId='$OId'", 'Status', $order=1);
		if($curStatus == 2 && $recordStatus == 1){
			$MemberId = $orderThrees['MemberId'];
			$accountPrice = $db->get_value('member', "MemberId='$MemberId'", 'Account_Price');
			$finalPrice = (float)$accountPrice + (float)$orderThrees['TotalPrice'];
			$db->update('member', "MemberId='$MemberId'", array('Account_Price'	=> $finalPrice));
			$resultStr='充值成功！';
			echo "success";
		}else{
			$resultStr='出现充值异常，请联系管理员！';
			echo "fail";
		}
	}else if($curStatus == 2 && $recordStatus == 1){
		echo "success";
		$resultStr='已充值成功！';
	}
}else {
    //验证失败
	echo "fail";
	$resultStr='充值失败，出现验证失败错误！请与我们取得联系！';
}


ob_start();
print_r($_POST);
print_r($resultStr);
$log=ob_get_contents();
ob_end_clean();

write_file($save_dir='/log/recharge_log/'.date('Y_m_d/', $service_time).'notify/',
	$save_name="recharge-{$OId}.txt", $contents=$log);

?>