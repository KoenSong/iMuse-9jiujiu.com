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
	require_once($site_root_path."/inc/lib/payment/alipay/alipayapi.php");
}elseif($payment_method=='银联在线'){
	header("Content-type:text/html;charset=utf-8");
	include($site_root_path.'/inc/lib/payment/unionpay/alipayapi.php');
}
?>