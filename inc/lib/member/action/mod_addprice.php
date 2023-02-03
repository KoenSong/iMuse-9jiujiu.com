<?php
include('../../../../inc/site_config.php');
include('../../../../inc/set/ext_var.php');
include('../../../../inc/fun/mysql.php');
include('../../../../inc/function.php');

require_once($site_root_path."/inc/lib/payment/alipay/alipay.config.php");
require_once($site_root_path."/inc/lib/payment/alipay/lib/alipay_submit.class.php");



/**************************请求参数**************************/
$aliapy_config['return_url'] = get_domain(1).'/inc/lib/payment/alipay/return_url3.php';;
$aliapy_config['notify_url'] = get_domain(1).'/inc/lib/payment/alipay/notify_url3.php';


$MemberId = $_POST['MemberId'];
$member_info=$db->get_one('member',"MemberId = '$MemberId'");

$Price = (float)$_POST['Price'];
!$member_info && js_back('充值失败!!');
while(1){
	$OId=date('YmdHis', $service_time).rand(10, 99);
	if(!$db->get_row_count('order_threes', "OId='$OId'")){
		break;
	}
}
$db->insert('order_threes', array(
		'OId'					=>	$OId,
		'MemberId'				=>	$member_info['MemberId'],
		//'Email'					=>	(int)$_SESSION['member_MemberId']?addslashes($_SESSION['member_Email']):$_POST['Email'],
		'TotalPrice'			=>	(float)$Price,
		'Shipping_Name'			=>	addslashes($member_info['UserName']),
		'ProName'				=>	'充值',
		//'Comments'				=>	$td_evaluate,
		//'ProId'					=>	$ProId,
		'OrderTime'				=>	$service_time,
		'OrderStatus'			=>	1,
		//'AllTime'				=>	$AllTime,
		//'StartTime'				=>	$start_time_hls,
		//'EndTime'				=>	$end_time_hls,
		//'CateId'				=>	$product_row['CateId'],
		//'PerTime'				=>	$PerTime,
		//'TeacherId'				=>	$product_row['MemberId'],
		'Phone'					=>	$member_info['Phone'],
	)
);
$db->insert('recharge_record',array(
		'FullName'	=>  addslashes($member_info['UserName']),
		'Price'		=>  (float)$Price,
		'Status'	=>  0,
		'Phone'		=>  $member_info['Phone'],
		'PostTime'	=>  $service_time,
		'MemberId'	=>  $member_info['MemberId'],
		'OId'		=>  $OId
	)
);

        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
		
		
		$return_url =$aliapy_config['return_url']=get_domain(1).'/inc/lib/payment/alipay/return_url3.php';
		$notify_url =$aliapy_config['notify_url']=get_domain(1).'/inc/lib/payment/alipay/notify_url3.php';
	
        //$notify_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        //$return_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        $out_trade_no = $OId;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = $OId;
        //必填

        //付款金额
        $total_fee = (float)$Price;
        //必填

        //订单描述

        $body = $_POST['WIDbody'];
        //默认支付方式
        $paymethod = "bankPay";
        //必填
        //默认网银
        $defaultbank = $_POST['WIDdefaultbank'];
        //必填，银行简码请参考接口技术文档

        //商品展示地址
        $show_url = $_POST['WIDshow_url'];
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" => trim($aliapy_config['partner']),
		"seller_email" => trim($aliapy_config['seller_email']),
		"payment_type"	=> $payment_type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"paymethod"	=> $paymethod,
		"defaultbank"	=> $defaultbank,
		"show_url"	=> $show_url,
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset']))
);

//建立请求
$alipaySubmit = new AlipaySubmit($aliapy_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;
?>