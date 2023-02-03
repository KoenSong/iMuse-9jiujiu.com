<?php
/* *
 * 功能：纯网关接口接入页
 * 版本：3.3
 * 修改日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*************************
 * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 * 1、商户服务中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申请集成协助，我们会有专业的技术工程师主动联系您协助解决
 * 2、商户帮助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
 * 3、支付宝论坛（http://club.alipay.com/read-htm-tid-8681712.html）
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */

require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");
//支付类型
$payment_type = "1";
if($is_meet==2){
    $return_url =$aliapy_config['return_url']=get_domain(1).'/inc/lib/payment/alipay/return_url2.php';
	$notify_url =$aliapy_config['notify_url']=get_domain(1).'/inc/lib/payment/alipay/notify_url2.php';
}
//商户订单号
$out_trade_no = $OId;
//订单名称
$subject = $OId;
//付款金额
$total_fee = $order_row['TotalPrice'];

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
//客户端的IP地址
$exter_invoke_ip = "";

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