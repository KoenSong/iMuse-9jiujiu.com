<?php
$module=$_GET['module']?$_GET['module']:$_POST['module'];
$login_module_ary=array('checkout', 'place', 'payment', 'complete', 'get_shipping_methods', 'set_payment_method');	//需要登录的模块列表
$un_login_module_ary=array('list', 'upcate_cart', 'add', 'add_success');	//不需要登录的模块列表
$member_info=$db->get_one('member', "MemberId='{$_SESSION['member_MemberId']}'");

if((int)$_SESSION['member_MemberId']){	//已登录
	$module_ary=array_merge($un_login_module_ary, $login_module_ary);
	$where="MemberId='{$_SESSION['member_MemberId']}'";
}else{	//未登录
	if($order_checkout_mode==0){	//必须登录方可下订单
		in_array($module, $login_module_ary) && js_location("{$member_url_cn}?module=login&jump_url=".urlencode($_SERVER['PHP_SELF'].'?'.query_string()));	//访问需要登录的模块但用户并未登录
		$module_ary=$un_login_module_ary;
	}else{	//未登录也可以下订单
		$module_ary=array_merge($un_login_module_ary, $login_module_ary);
	}
	$where="SessionId='$cart_SessionId'";
}

!in_array($module, $module_ary) && $module=$module_ary[0];

ob_start();
echo '<script language="javascript" src="/js/cart.js"></script>';
include($site_root_path."/inc/lib/cart_cn/module/$module.php");
$cart_page_contents=ob_get_contents();
ob_end_clean();
?>