<?php
$module=$_GET['module']?$_GET['module']:$_POST['module'];
$login_module_ary=array('index', 'profile', 'password', 'orders','order_twos', 'wishlists', 'logout','face_mod','addprice','price','review','withdraw');	//需要登录的模块列表
$un_login_module_ary=array('login', 'forgot', 'create');	//不需要登录的模块列表
//教师和普通会员加载
if((int)$_SESSION['member_MemberId']){
	$where="MemberId='{$_SESSION['member_MemberId']}'";
	$member_info=$db->get_one('member', "MemberId='{$_SESSION['member_MemberId']}'");
	$module_ary=$login_module_ary;
}else{	//未登录
	in_array($module, $login_module_ary) && js_location("{$_SERVER['PHP_SELF']}?module=login&jump_url=".urlencode($_SERVER['PHP_SELF'].'?'.query_string()));	//访问需要登录的模块但用户并未登录
	$module_ary=$un_login_module_ary;	//重置模块列表
}

!in_array($module, $module_ary) && $module=$module_ary[0];

ob_start();
if((int)$_SESSION['member_MemberId']){	//已登录的，架构会员中心页面内容排版
	//$teacher_info=$db->get_one('product', "MemberId='{$_SESSION['member_MemberId']}'");
	$member_address=$db->get_one('member_address_book',"MemberId='{$_SESSION['member_MemberId']}'");
	$member_ext=$db->get_one('member_ext',"MemberId='{$_SESSION['member_MemberId']}'");
	if($member_info['Apply']){
		$member_ident=$db->get_one('member_ident',"MemberId='{$_SESSION['member_MemberId']}'");
		$member_apply=$db->get_one('member_apply',"MemberId='{$_SESSION['member_MemberId']}'");
	}
	if($member_info['Apply']){
	$account_url='/products-detail.php?ProId='.$db->get_value('product',"MemberId = '{$member_info['MemberId']}'",'ProId');
	}else{
		$account_url="/student.php?MemberId={$member_info['MemberId']}";
	}
}else{
	//echo($site_root_path."/inc/lib/member/module/$file_base_dir/$module.php");
	//include($site_root_path."/inc/lib/member/module/$file_base_dir/$module.php");
	include($site_root_path."/weixin/wx_login.php");
}
$member_page_contents=ob_get_contents();
ob_end_clean();
?>