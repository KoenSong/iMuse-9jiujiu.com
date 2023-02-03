<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('order_twos');

include('../../inc/fun/ip_to_area.php');

$OrderId=(int)$_GET['OrderId'];
!$OrderId && $OrderId=(int)$_POST['OrderId'];
$tmpOrderStatus=(int)$_GET['tmpOrderStatus'];
$module=$_GET['module']?$_GET['module']:$_POST['module'];
$where="OrderId='$OrderId'";

//-----------------------------------------------------------------------------------提交数据(Start Here)-----------------------------------------------------------------------
$act_ary=array('mod_express', 'mod_total_weight', 'mod_order_price', 'mod_order_status', 'mod_shipping_address', 'mod_billing_address', 'mod_product', 'del_product', 'add_product');
$act=$_GET['act']?$_GET['act']:$_POST['act'];
if($act && in_array($act, $act_ary)){
	check_permit('', 'order_twos.mod');
	$act=='mod_order_status' && $_OrderStatus=$db->get_value('order_twos', $where, 'OrderStatus');
	include("action/$act.php");
	
	//--------------------------------------------------------------------------------发邮件(Start Here)-----------------------------------------------------
	$send_mail=0;
	$order_row=$db->get_one('order_twos', $where);
	if($act=='mod_order_status' && $order_row['OrderStatus']!=$_OrderStatus){	//改变订单状态
		if($OrderStatus==4){	//确认付款
			$send_mail=1;
			$mail_subject='We have received from your payment';
			include('../../inc/lib/mail/order_payment.php');
		}elseif(($OrderStatus==5 || $OrderStatus==6) && $_OrderStatus!=5 && $_OrderStatus!=6){	//已发货
			$send_mail=1;
			$mail_subject="Your order#{$order_row['OId']} has shipped";
			include('../../inc/lib/mail/order_shipped.php');
		}elseif($OrderStatus==7){	//取消订单
			$send_mail=1;
			$mail_subject="Your order#{$order_row['OId']} successfully Cancelled";
			include('../../inc/lib/mail/order_cancel.php');
		}
	}else{	//修改订单
		/*
		$send_mail=1;
		$mail_subject="Your order#{$order_row['OId']} has changed";
		include('../../inc/lib/mail/order_change.php');
		*/
	}
	if($send_mail==1){
		include('../../inc/lib/mail/template.php');
		sendmail($order_row['Email'], $order_row['FirstName'].' '.$order_row['LastName'], $mail_subject, $mail_contents);
	}
	//--------------------------------------------------------------------------------发邮件(End Here)------------------------------------------------------
	
	js_location("view.php?OrderId=$OrderId&module=$module&tmpOrderStatus=$tmpOrderStatus");
}
//-----------------------------------------------------------------------------------提交数据(End Here)-------------------------------------------------------------------------

$module_ary=array('base', 'status', 'product_list','memberinfo');	//模块列表
!in_array($module, $module_ary) && $module=$module_ary[0];

$order_row=$db->get_one('order_twos', $where);
!$order_row && js_location('index.php');

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

ob_start();
if($module=='base' || $module=='status'){	//加载“基本信息”和“订单状态”共用的模块
	include('include/payment_info_detail.php');
	include('include/mod_express_link.php');
	include('include/mod_weight_link.php');
}
include("module/$module.php");
$html_contents=ob_get_contents();
ob_end_clean();

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('order_twos.order_twos_manage');?></a>&nbsp;-&gt;&nbsp;<a href="view.php?OrderId=<?=$OrderId;?>"><?=$order_row['OId'];?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.view');?></div>
<?php include('include/menu.php');?>
<?=$html_contents;?>
<?php include('../../inc/manage/footer.php');?>