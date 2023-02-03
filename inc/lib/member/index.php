<?php
$module=$_GET['module']?$_GET['module']:$_POST['module'];
//教师和普通会员加载
if((int)$_SESSION['member_MemberId']){
	$where="MemberId='{$_SESSION['member_MemberId']}'";
	$member_info=$db->get_one('member', "MemberId='{$_SESSION['member_MemberId']}'");
}
if($member_info['IsTeacher']){
	$login_module_ary=array('index', 'profile', 'password', 'orders','order_twos', 'wishlists', 'logout','face_mod','addprice','apply','issue_mod','price','ident','issue_mod','review','withdraw','qrcode','dealer','ctuorder','ctulist','ctuplan');	//需要登录的模块列表
}elseif($member_info['Apply']){	
	$login_module_ary=array('index', 'profile', 'password', 'orders','order_twos', 'wishlists', 'logout','face_mod','addprice','price','review','ident','issue_mod','withdraw','qrcode','ctuorder','ctulist','ctuplan');	//需要登录的模块列表
}else{
	$login_module_ary=array('index', 'profile', 'password', 'orders','order_twos', 'wishlists', 'logout','face_mod','addprice','price','review','withdraw','qrcode','dealer','ctuorder','ctulist','ctuplan');	//需要登录的模块列表
}
//$login_module_ary=array('index', 'profile', 'password', 'orders', 'wishlists', 'logout','face_mod','apply');	//需要登录的模块列表
$un_login_module_ary=array('login', 'forgot', 'create');	//不需要登录的模块列表
if((int)$_SESSION['member_MemberId']){	//已登录
	$module_ary=$login_module_ary;
}else{	//未登录
	in_array($module, $login_module_ary) && js_location("{$_SERVER['PHP_SELF']}?module=login&jump_url=".urlencode($_SERVER['PHP_SELF'].'?'.query_string()));	//访问需要登录的模块但用户并未登录
	$module_ary=$un_login_module_ary;	//重置模块列表
}
!in_array($module, $module_ary) && $module=$module_ary[0];

ob_start();
if((int)$_SESSION['member_MemberId']){	//已登录的，架构会员中心页面内容排版
	
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
	//var_dump($member_ident);
	//$teacher_info=$db->get_one('product', "MemberId='{$_SESSION['member_MemberId']}'");
?>
<div class="blank30"></div>
<div id="contents" class="w1200 over">
    <div class="lft fl">
       <?php include($site_root_path."/inc/lib/member/module/menu.php");?>
    </div> <!-- 左侧 -->
    
    <div class="rig fr over">
        <div class="member_module"><?php include($site_root_path."/inc/lib/member/module/$module.php");?></div>
    </div> <!-- 右边 -->
</div>
<!-- 学生主页 隐藏 js -->
<?php 
if(!1 && !$member_info['IsTeacher'] && !$member_info['Apply']){
//if(!$member_info['IsTeacher'] && !$member_info['Apply']){?>
<script>
	$('.account_web').hide();
</script>
<?php }?>

<?php
}else{
	include($site_root_path."/inc/lib/member/module/$file_base_dir/$module.php");
}
$member_page_contents=ob_get_contents();
ob_end_clean();
?>