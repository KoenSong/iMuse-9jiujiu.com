<?php
$query_string=query_string('login_fail');
$get_forward = $_GET['forward'];
$get_ProId = $_GET['ProId'];
?>
<script type="text/javascript">
var childWindow;
function toQzoneLogin(){
	childWindow = window.open("inc/lib/oauth/qq/index.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
} 

function closeChildWindow(){
	childWindow.close();
}
</script>
<div id="lib_member_login" class="over">
	<?php if($_GET['login_fail']==1){?>
		<div class="lib_member_msgerror"><img src="/images/msg_error.png" align="absmiddle" />&nbsp;&nbsp;登陆失败，请重新尝试。</div>
	<?php }?>
    
    <div class="blank20"></div>
    
    <div class="member_crt margin0">
    	<div style="margin-left:23px;">
        	<img src="/images/login_logo.png" />
        </div>
        <div class="blank20"></div>
         <div class="blank20"></div>
        <form action="/weixin/web/member/action/mod.php" method="post" name="member_login_form" OnSubmit="return checkForm(this);">
            <div class="row">
            	<img class="fl" src="/images/login_u.png" /><input name="Phone"  autocomplete='off' value="手机号或者ID号" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" type="text" class="user login_item" size="41" maxlength="100" check="手机号!~*"/>
            </div>
            <div class="blank26"></div>
            <div class="blank26"></div>
            <?php /*?><span  class="t">密码：</span><?php */?>
            <div class="row">
            <img class="fl" src="/images/login_p.png" /><input name="Password" type="password" class="pwd login_item" autocomplete='off' placeholder="密码" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" size="41" maxlength="20" check="请输入密码!~*">
            </div>
             <div class="blank26"></div>
             <div class="login_tip">
             <span>自动登录<input type="checkbox" style="margin-left:5px;" name="AutoLogin" value="1" /></span>
             <div class="fr">
             <a href="<?=$member_url_cn;?>?module=forgot" class="m_color"> 忘记密码？</a>  &nbsp; | &nbsp; <a href="<?=$member_url_cn.'?'.query_string(array('login_fail', 'module'));?>&module=create">立即注册</a> </div>
             </div>
            <div class="blank26"></div>
            <a href="#" onclick='toQzoneLogin()'><img src="/images/qq_login.png"></a>
            <div class="blank26"></div>
            <input type="submit" name="Submit" value="立即登录" class="block login_sub">
            <input type="hidden" name="data" value="member_login" />
            <!-- 约课跳转 -->
            <input type="hidden" name="forward" value="<?=$get_forward?>" />
            <input type="hidden" name="ProId" value="<?=$get_ProId?>" />
            <div class="blank18"></div>
           
        </form>
    </div>
    
    <?php /*?><div class="rig_ad fr over"><img src="<?=$db->get_value('ad','AId = 4','PicPath_0');?>" /></div><?php */?> <!--广告位置-->
    
    <div class="blank33"></div>
</div>
<?php
$_SESSION['login_post']='';
unset($_SESSION['login_post']);
?>