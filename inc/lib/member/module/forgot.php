<?php
$query_string=query_string(array('forgot_success', 'forgot_fail'));

if($_POST['data']=='member_forgot'){
	$Password=password($_POST['Password']);
	
	$CheckCode=$_POST['CheckCode'];
	$Phone=$_POST['Phone'];
	//var_dump($_SESSION['__CheckNum']);
	//var_dump($CheckCode);
	if($CheckCode!=$_SESSION['__CheckNum'] || $_SESSION['__CheckNum']==''){	//验证码错误
		$_SESSION['__CheckNum'] ='';
		unset($_SESSION['__CheckNum']);
		js_back('验证码错误！');
	}
	
	$_SESSION['member_Password']=password($_POST['Password']);
	
	$db->update('member', "Phone = '$Phone'", array(
			'Password'	=>	$_SESSION['member_Password']
		)
	);
}

?>
<div class="layout-center">
			<h3 style="text-align:center;">通过手机号找回密码</h3>
            <div class="blank18"></div>
            <form action="<?=$member_url_cn.'?'.$query_string;?>" method="post" name="member_forgot_form" OnSubmit="return checkForm(this);">
                <div class="form-gp">
                    <label style="font-size:16px; margin-top:2px">手机号：</label>
                    <div class="input-msg">
                        <div class="okcoded">
                            <input name="Phone" type="text"  ccheck='请正确填写手机号码！~mobile|“{value}”不是一个有效的手机号码*' class="inp" autocomplete="off" maxlength="11" placeholder="请输入手机号作为登录账号" id="Phone">
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="blank18"></div>
                <div class="form-gp">
                    <label style="font-size:16px; margin-top:2px">图形码：</label>
                    <div class="input-msg">
                        <div class="yzm">
                            <input id="txt_valid" name="VCode" type="text" autocomplete="off" placeholder="请输入图形码" class="inp no-code fl" check="请输入图形码!~4m|*"  maxlength="4" id="txt_valid"><br /><br /><br />
                            <div style="margin-top:10px;">
                                <?=verification_code('create');?> <a href='javascript:void(0);' onclick='this.blur(); obj=$_("<?=md5('forgot');?>"); obj.src=obj.src+Math.random(); return false'>换一张</a></span>
                            </div>
                         </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="blank18"></div>
                <div class="form-gp">
                    <label style="font-size:16px; margin-top:2px">手机验证码：</label>
                    <div class="input-msg">                        	
                            <div class="yzm">
                                <input type="text" placeholder="请输入验证码" name="CheckCode" autocomplete="off" class="inp no-code fl">
                                <div class="blank18"></div>
                                <input type="button" class="btn-blue" id="getcodes" value="获取短信验证码" onclick="get_mobile_valid();">
                                <a id="getcodes2" style=" text-align:center;display:none;" class="btn-blue" href="javascript://">已发送(&nbsp;<span id="timeload">120</span>&nbsp;s)</a>
                                 <div class="blank18"></div>
                            </div> 
                    </div>
                </div>
				<div class="blank18"></div>
				<div class="form-gp">
                    <label style="font-size:16px; margin-top:2px">新密码：</label>
                    <div class="input-msg">
                        <div class="okcoded">
                            <input name="Password" type="password"   class="inp" autocomplete="off" maxlength="11" >
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
				<div class="blank18"></div>
				<div class="clear"></div>
				<div class="form-gp">
                    <label style="font-size:16px; margin-top:2px">确认密码：</label>
                    <div class="input-msg">
                        <div class="okcoded">
                            <input name="ConfirmPassword" type="password" check="请再次输入新密码!~=Password|两次输入的密码不相同!*" class="inp" autocomplete="off" maxlength="11" >
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
				<div class="clear"></div>
				<?php /*?><div class="rows">
					<label>再次输入新密码: <font class="fc_red">*</font></label>
					<span><input name="ConfirmPassword" value="<?=htmlspecialchars($_SESSION['password_post']['ConfirmPassword']);?>" type="password" class="form_input" check="请再次输入新密码!~=Password|两次输入的密码不相同!*" size="50" maxlength="20"></span>
					<div class="clear"></div>
				</div><?php */?>
                <input type="submit" class="btn-orig2 o-k" />
                <input type="hidden" name="data" value="member_forgot" />
            </form>	
</div>
<?php /*?><div id="lib_member_forgot">
	<?php if($_GET['forgot_fail']==1){?>
		<div class="lib_member_msgerror"><img src="/images/lib/member/msg_error.png" align="absmiddle" />&nbsp;&nbsp;对不起，不存在的Email。</div>
	<?php }?>
	<div class="lib_member_title">重设密码</div>
	<?php if($email=='' || $expiry==''){?>
		<?php if($_GET['forgot_success']==1){?>
			<div class="blank15"></div>
			<div class="send_tips lib_member_item_card">
				<div>
					我们已经发送一份邮件到您注册的Email邮箱中，请您根据指示重设密码
					<div class="no_email">没有收到邮件</div>
					请检查您的邮箱地址是否正确，或进入您的垃圾邮件箱查看，如有疑问可与我们联系，谢谢！
				</div>
				<div class="continue_shopping"><input type="button" name="continue_shopping" value="Continue Shopping" class="form_button form_button_130" onClick="window.location='/';"></div>
			</div>
		<?php }else{?>
			<div class="lib_member_info">可以重设密码之前，我们需要您输入您的手机。然后，您会收到短信验证码。</div>
			<div class="form lib_member_item_card">
				<form action="<?=$member_url_cn.'?'.$query_string;?>" method="post" name="member_forgot_form" OnSubmit="return checkForm(this);">
					<div class="lib_member_sub_title">输入您注册的手机</div>
					<div class="rows">
						<label>手机号:</label>
						<span><input name="Phone" value="<?=htmlspecialchars($_SESSION['forgot_post']['Email']);?>" type="text" class="form_input" size="50" maxlength="20" check="Phone地址不能为空!~email|这不是一个Email地址!*"></span>
						<div class="clear"></div>
					</div>
					<div class="blank6"></div>
                    <div class="rows">
						<label>验证码:</label>
						<span><input name="CheckNum" value="" type="text" class="form_input" size="50" maxlength="20" check="手机号!~*"></span><a style="background:#ccc;-moz-border-radius: 5px;  -webkit-border-radius: 5px; border-radius:5px; padding:5px; border: solid 1px #0FF;" href="">点击获取</a>
						<div class="clear"></div>
					</div>
					<div class="blank6"></div>
					<div class="rows">
						<label></label>
						<span><input name="Submit" type="submit" class="form_button" value="发送"></span>
						<div class="clear"></div>
					</div>
					<div class="blank15"></div>
					<div class="dline"></div>
					<div class="lib_member_info">如果您可以不记得您的手机号注册或登录到您的帐户仍然有问题，请联系我们的客户服务。。</div>
					<input type="hidden" name="data" value="member_forgot" />
				</form>
			</div>
		<?php }?>
	<?php
	}else{
	?>
		<?php if($_GET['reset_success']==1){?>
			<div class="blank15"></div>
			<div class="reset_success lib_member_item_card">
				<br />您已经成功重设密码。<br /><br /><br />
				<a href="<?=$member_url_cn;?>?module=login"><strong style="font-size:12px;">登陆您的账号</strong></a><br /><br />
			</div>
		<?php
		}else{
			!$db->get_row_count('member_forgot', "EmailEncode='$email' and Expiry='$expiry' and IsReset=0") && js_location('/');
		?>
			<div class="lib_member_info">请输入您的新密码。</div>
			<div class="form reset_form lib_member_item_card">
				<form action="<?=$member_url_cn.'?'.$query_string;?>" method="post" name="member_reset_password_form" OnSubmit="return checkForm(this);">
					<div class="rows">
						<label>新密码: <font class="fc_red">*</font></label>
						<span><input name="Password" value="<?=htmlspecialchars($_SESSION['create_post']['Password']);?>" type="password" class="form_input" check="新密码不能为空!~*" size="50" maxlength="20"></span>
						<div class="clear"></div>
					</div>
					<div class="blank6"></div>
					<div class="rows">
						<label>确认新密码: <font class="fc_red">*</font></label>
						<span><input name="ConfirmPassword" value="<?=htmlspecialchars($_SESSION['create_post']['ConfirmPassword']);?>" type="password" class="form_input" check="请再次输入新密码!~=Password|两次输入的密码值不相同!*" size="50" maxlength="20"></span>
						<div class="clear"></div>
					</div>
					<div class="blank6"></div>
					<div class="rows">
						<label></label>
						<span><input name="Submit" type="submit" class="form_button" value="提交"></span>
						<div class="clear"></div>
					</div>
					<input type="hidden" name="email" value="<?=htmlspecialchars($email);?>" />
					<input type="hidden" name="expiry" value="<?=htmlspecialchars($expiry);?>" />
					<input type="hidden" name="data" value="member_reset_password" />
				</form>
			</div>
		<?php }?>
	<?php }?>
</div><?php */?>
<script type="text/javascript">
	 
	$('#getcodes').click(
	function(){
		 phsta=1;;
		 txtsta =1;
		 CheckNum=1;
		 Phone = $('#Phone').val();
		 if(!Phone && $){phsta=0;}
		 
		 txt_valid = $('#txt_valid').val();
		 if(!txt_valid){txtsta=0;}
		 
					 
		 if(!phsta){ 
			alert('请填写手机号!');
			return false;
		 }
		 else if(!txtsta){
			 alert('请填写图形码!');
			 return false;
		 }
		 SendCheck(txt_valid,Phone,2);
	})
</script>
<?php
$_SESSION['forgot_post']='';
unset($_SESSION['forgot_post']);
?>