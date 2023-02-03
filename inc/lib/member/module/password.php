<?php
$query_string=query_string(array('forgot_success', 'forgot_fail'));

if($_POST['data']=='member_password'){
	$CheckCode=$_POST['CheckCode'];
	//var_dump($_SESSION['__CheckNum']);
	//var_dump($CheckCode);
	if($CheckCode!=$_SESSION['__CheckNum'] || $_SESSION['__CheckNum']==''){	//验证码错误
		$_SESSION['__CheckNum'] ='';
		unset($_SESSION['__CheckNum'] );
		js_back('验证码错误！');
	}
	
	if(password($_POST['OldPassword'])!=$_SESSION['member_Password']){
		$_SESSION['password_post']=$_POST;
		js_location("$member_url_cn?password_fail=1&$query_string");
	}
	
	$_SESSION['member_Password']=password($_POST['Password']);
	
	$db->update('member', $where, array(
			'Password'	=>	$_SESSION['member_Password']
		)
	);
	
	js_location("$member_url_cn?password_success=1&$query_string");
}
$cur='密码修改';
?>
<div id="lib_member_password">
	<?php if($_GET['password_fail']==1){?>
		<div class="lib_member_msgerror"><img src="/images/lib/member/msg_error.png" align="absmiddle" />&nbsp;&nbsp;对不起，旧密码不正确。</div>
	<?php }?>
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
	<?php if($_GET['password_success']==1){?>
		<div class="blank15"></div>
		<div class="change_success lib_member_item_card">
			<br />您已成功更改密码。<br /><br /><br />
			<a href="<?=$member_url_cn;?>?module=index"><strong>我的账号</strong></a><br /><br />
		</div>
	<?php }else{?>
		<?php /*?><div class="lib_member_info">如果您想更改帐户密码，请填写下面的表格，并单击"更改密码"按钮。</div><?php */?>
		<div class="form lib_member_item_card">
			<form action="<?=$member_url_cn.'?'.$query_string;?>" method="post" name="member_password_form" OnSubmit="return checkForm(this);">
				<div class="lib_member_sub_title">更改您的密码</div>
				<div class="rows">
					<label>旧密码: <font class="fc_red">*</font></label>
					<span><input name="OldPassword" value="<?=htmlspecialchars($_SESSION['password_post']['OldPassword']);?>" type="password" class="input_txt" check="请输入旧密码!~*" size="50" maxlength="20"></span>
					<div class="clear"></div>
				</div>
				<div class="rows">
					<label>新密码: <font class="fc_red">*</font></label>
					<span><input name="Password" value="<?=htmlspecialchars($_SESSION['password_post']['Password']);?>" type="password" class="input_txt" check="请输入新密码!~*" size="50" maxlength="20"></span>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<div class="rows">
					<label>再次输入新密码: <font class="fc_red">*</font></label>
					<span><input name="ConfirmPassword" value="<?=htmlspecialchars($_SESSION['password_post']['ConfirmPassword']);?>" type="password" class="input_txt" check="请再次输入新密码!~=Password|两次输入的密码不相同!*" size="50" maxlength="20"></span>
					<div class="clear"></div>
				</div>
                
                <div class="rows">
                    <label style="font-size:16px; margin-top:2px">图形码：</label>
                    <span>
                            <input id="txt_valid" name="VCode" type="text" style="width:83%;" autocomplete="off" placeholder="请输入图形码" class=" no-code fl input_txt" check="请输入图形码!~4m|*"  maxlength="4">
                            <?=verification_code('create');?> <a href='javascript:void(0);' onclick='this.blur(); obj=$_("<?=md5('create');?>"); obj.src=obj.src+Math.random(); return false'>换一张</a>
                    </span>
                  <div class="clear"></div>
                </div>
                <div class="rows">
                    <label style="font-size:16px; margin-top:2px">验证码：</label>
                    <span>
                    <input type="text" name="CheckCode" id="txt_valid" style="width:83%;" placeholder="请输入验证码" autocomplete="off" class=" no-code fl input_txt">
                    <input type="button" class="btn-blue fl" id="getcodes" value="获取短信验证码"><a id="getcodes2" style=" text-align:center;display:none;" class="btn-blue" href="javascript://">已发送(&nbsp;<span id="timeload">120</span>&nbsp;s)</a>
                  	</span>
                    <div class="blank8"></div>   
                </div> 
                
				<div class="rows" style="border-bottom:0;">
					<label></label>
					<span style="margin-left:122px;"><input name="Submit" type="submit" class="sub_rad" value="更改密码"></span>
					<div class="clear"></div>
				</div>
				<input type="hidden" name="data" value="member_password" />
			</form>
		</div>
	<?php }?>
</div>
<?php
$_SESSION['password_post']='';
unset($_SESSION['password_post']);
?>
<script>
	 $('#getcodes').click(
		function(){
			 phsta=1;;
			 txtsta =1;
			 CheckNum=1;
			 Phone = <?=$_SESSION['member_Phone']?>;
			 if(!Phone && $){phsta=0;}
			 
			 txt_valid = $('#txt_valid').val();
			 if(!txt_valid){txtsta=0;}
			 
			 			 
			 if(!phsta){ 
			 	alert('请重新登录或换一种浏览器!');
				return false;
			 }
			 else if(!txtsta){
				 alert('请填写图形码!');
				 return false;
			 }
			 SendCheck(txt_valid,Phone,2);
	});
</script>