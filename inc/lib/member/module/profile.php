<?php
$cur='账号设置';
?>
<div id="lib_member_profile">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
	<?php if($_GET['profile_success']==1){?>
		<div class="blank15"></div>
		<div class="change_success lib_member_item_card">
			<br />您已经成功更改个人信息。<br /><br /><br />
			<a href="<?=$member_url_cn;?>?module=index"><strong>我的账号</strong></a><br /><br />
		</div>
	<?php }else{?>
		<?php /*?><div class="lib_member_info">如果您要更改您的个人资料，请填写下面的表格，点击"保存"按钮。</div><?php */?>
		<div class="form lib_member_item_card">
			<form action="/inc/lib/member/action/mod.php" method="post"  name="member_profile_form" OnSubmit="return checkForm(this);">
				<div class="lib_member_sub_title">更改您的个人信息</div>
                <div class="rows">
                	<label>会员类型: </label>
                    <span>
						<?=$member_info['IsTeacher'] || $member_info['Apply']?'教师会员':'学生会员'?>
                    </span>
                    <div class="clear"></div>
                </div>
                
				<?php /*?><div class="rows">
					<label>出生年月: </label>
					<span>
                    <input type="text" name="Brithday" class="form_input" value="<?=$member_info['Brithday']?>" />
                    </span>
					<div class="clear"></div>
				</div><?php */?>
				<?php /*?><div class="rows">
					<label>年龄: </label>
					<span>
                    <select name="Age">
                    	<?php for($i=18; $i<70;$i++){?>
                    	<option value="<?=$i?>" <?=$i==$member_ext['Age']?>><?=$i?></option>
                        <?php }?>
                    </select>
                    </span>
					<div class="clear"></div>
				</div><?php */?>
                
                <div class="rows">
					<label>手机号: </label>
					<span><input name="Phone" value="<?=htmlspecialchars($member_info['Phone']);?>" type="text" class="input_txt" size="40" maxlength="20" check='请正确填写手机号码！~mobile|“{value}”不是一个有效的手机号码！'></span>
					<div class="clear"></div>
				</div>
                
                <div class="rows">
					<label>邮箱: </label>
					<span><input name="Email" value="<?=htmlspecialchars($member_info['Email']);?>" type="text" class="input_txt" size="40" check='请正确填写邮箱地址！~email|“{value}”不是一个有效的邮箱地址！'></span>
					<div class="clear"></div>
				</div>
                
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
					<span style="margin-left:381px;"><input name="Submit" type="submit" class="sub_rad" value="保 存"><div class="clear"></div></span>
					<div class="clear"></div>
				</div>
                <input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
				<input type="hidden" name="data" value="member_profile" />
			</form>
		</div>
	<?php }?>
</div>

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
			 SendCheck(txt_valid,Phone,3);
	});
</script>