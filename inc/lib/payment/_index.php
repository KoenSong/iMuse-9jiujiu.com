<?php 
include('../../site_config.php');
include('../../set/ext_var.php');
include('../../fun/mysql.php');
include('../../function.php');

$OId=$_GET['OId'];
$payment_method=$_GET['payment_method'];

$where="OId='$OId'";
$order_row=$db->get_one('orders', $where);
$is_meet=1;
if(!$order_row){
$order_row=$db->get_one('order_twos', $where);
$is_meet=2;
}

!$order_row && js_location('/');

if($payment_method=='支付宝'){
	/*include(RP.'/inc/lib/payment/alipay/alipay_service.php');
	include(RP.'/inc/lib/payment/alipay/alipay_config.php');
	//构造要请求的参数数组，无需改动
	$parameter=array(
		'service'			=> $alipay_service_type,//'trade_create_by_buyer',	//接口名称，不需要修改
		'payment_type'		=> '1',	//交易类型，不需要修改
		
		//获取配置文件(alipay_config.php)中的值
		'partner'			=> $alipay_partner,
		'seller_email'		=> $alipay_seller_email,
		'return_url'		=> $return_url,
		'notify_url'		=> $notify_url,
		'_input_charset'	=> $_input_charset,
		'show_url'			=> $show_url,
		
		//从订单数据中动态获取到的必填参数
		'out_trade_no'		=> $OId,
		'subject'			=> '订单号：'.$OId,
		'body'				=> '订单号：'.$OId,
		'total_fee'			=> Orders::orders_price($order_row),
				
		//扩展功能参数——网银提前
		'paymethod'			=> 'directPay',	//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
		'defaultbank'		=> '',	//默认网银代号，代号列表见http://club.alipay.com/read.php?tid=8681379
		
		//扩展功能参数——防钓鱼
		'anti_phishing_key'	=> '',
		'exter_invoke_ip'	=> '',
		
		//扩展功能参数——自定义参数
		'buyer_email'		=> '',
		'extra_common_param'=> '',
		
		//扩展功能参数——分润
		'royalty_type'		=> '',
		'royalty_parameters'=> '',
		
		//扩展功能参数——自定义超时
		'it_b_pay'			=> ''
	);
	
	//构造请求函数
	$alipay=new alipay_service($parameter, $alipay_security_code, $sign_type);
	echo $alipay->build_form();*/
	
	require_once($site_root_path."/inc/lib/payment/alipay/alipay.config.php");
	require_once($site_root_path."/inc/lib/payment/alipay/lib/alipay_service.class.php");

	$logistics_fee		= "0.00";				//物流费用，即运费。
	$logistics_type		= "EXPRESS";			//物流类型，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
	$logistics_payment	= "SELLER_PAY";			//物流支付方式，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）

	$receive_name		= $order_row['Shipping_Name'];			//收货人姓名，如：张三
	$receive_address	='啾啾网络';			//收货人地址，如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号
	$receive_zip		= '123456';				//收货人邮编，如：123456
	$receive_phone		= "";		//收货人电话号码，如：0571-81234567
	$receive_mobile		= $order_row['Phone'];		//收货人手机号码，如：13312341234
	if($is_meet==2){
		$aliapy_config['return_url']=get_domain(1).'/inc/lib/payment/alipay/return_url2.php';
		$aliapy_config['notify_url']=get_domain(1).'/inc/lib/payment/alipay/return_url2.php';
	}
	$parameter = array(
			//"service"			=> 'create_partner_trade_by_buyer',
//			"service"			=> 'create_direct_pay_by_user',
//			"payment_type"		=> "1",
//			
//			'partner'			=> $aliapy_config['partner'],
//			'seller_email'		=> $aliapy_config['seller_email'],
//			'return_url'		=> $aliapy_config['return_url'],
//			'notify_url'		=> $aliapy_config['notify_url'],
//			'_input_charset'	=> $_input_charset,
//	
//			'out_trade_no'		=> $OId,
//			'subject'			=> $OId,
//			'body'				=> $OId,
//			'price'				=> $order_row['TotalPrice'],
//			"quantity"			=> 1,
//			
//			"logistics_fee"		=> $logistics_fee,
//			"logistics_type"	=> $logistics_type,
//			"logistics_payment"	=> $logistics_payment,
//			
//			//可以为空
//			"receive_name"		=> $receive_name,
//			//"receive_address"	=> $receive_address,
//			"receive_zip"		=> $receive_zip,
//			"receive_phone"		=> $receive_phone,
//			"receive_mobile"	=> $receive_mobile,
//			
//			"show_url"			=> $show_url,
			
			
			
			
			"service"			=> "create_direct_pay_by_user",
			"payment_type"		=> "1",
			
			"partner"			=> trim($aliapy_config['partner']),
			"seller_email"		=> trim($aliapy_config['seller_email']),
			"return_url"		=> trim($aliapy_config['return_url']),
			"notify_url"		=> trim($aliapy_config['notify_url']),
			"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
			
			"out_trade_no"		=> $OId,
			"subject"			=> $OId,
			"body"				=> $OId,
			"total_fee"			=> $order_row['TotalPrice'],
			
			"paymethod"			=> $paymethod,
			"defaultbank"		=> $defaultbank,
			
			"anti_phishing_key"	=> $anti_phishing_key,
			"exter_invoke_ip"	=> $exter_invoke_ip,
			
			"show_url"			=> $show_url,
			"extra_common_param"=> $extra_common_param,
			
			"royalty_type"		=> $royalty_type,
			"royalty_parameters"=> $royalty_parameters
			
			
	);
	//构造标准双接口
	//$alipayService = new AlipayService($aliapy_config);
	//$html_text = $alipayService->create_partner_trade_by_buyer($parameter); //担保交易
	//$html_text = $alipayService->create_direct_pay_by_user($parameter);	//即时到账
	//var_dump($parameter);
	//exit;
	//echo $html_text;
	
	//构造即时到帐接口
	$alipayService = new AlipayService($aliapy_config);
	$html_text = $alipayService->create_direct_pay_by_user($parameter);
	echo $html_text;

	
	
}elseif($payment_method=='银联在线'){
	header("Content-type:text/html;charset=utf-8");
	include($site_root_path.'/inc/lib/payment/unionpay/alipayapi.php');
}elseif($payment_method=='支付宝2'){
	
	require_once($site_root_path."/inc/lib/payment/test/alipayapi.php");
}
?>