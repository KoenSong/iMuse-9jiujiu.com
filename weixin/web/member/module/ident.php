<?php
$cur='账号设置';
$member_ident_row=$db->get_one('member_ident',"MemberId = '{$member_info['MemberId']}'");
$model_row=$db->get_one('ad',"AId = 6");
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
			<br />教师认证。<br /><br /><br />
			<a href="<?=$member_url_cn;?>?module=index"><strong>我的账号</strong></a><br /><br />
		</div>
	<?php }else{?>
		<?php /*?><div class="lib_member_info">如果您要更改您的教师认证资料，请填写下面的表格，点击"保存"按钮。</div><?php */?>
		<div class="form lib_member_item_card">
			<form action="/inc/lib/member/action/mod.php" method="post"  name="member_profile_form" enctype="multipart/form-data" OnSubmit="return checkForm(this);">
				<div class="lib_member_sub_title">上传认证资料</div>
				<div class="rows">
                	<label>教龄:<font class="fc_red" style="font-size:18px;">*</font></label>
                    <span>
						<?php if(!$member_info['IsTeacher']){?>
							<input type="text" name="T_age" class="form_input" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);" value="<?=$member_ident_row['T_age']?>" />&nbsp;年
						<?php }else{?>
							<?=$member_ident_row['T_age']+date('y',$service_time)-date('y',$member_info['RegTime'])?>&nbsp;年
						<?php }?>
                    </span>
                    <div class="clear"></div>
                </div>
                <div class="rows">
                	<label>身份证:<font class="fc_red" style="font-size:18px;">*</font></label>
                    <span>
						<input type="file" class="form_input" name="Pic_Cer" />:(大小2M以下)
                        <?php /*?><div><span class="fl">&nbsp;&nbsp;&nbsp;图例:</span><img width="100" class="fl" src="<?=$model_row['PicPath_0']?>" /></div><?php */?>
                        <br /><br />
                        <img width="100" style="border:1px solid #ccc" src="<?=$member_ident_row['Pic_Cer']?>" />
                        <input type="hidden" name="S_Pic_Cer" value="<?=$member_ident_row['Pic_Cer']?>" />
                    </span>
                    <div class="clear"></div>
                </div>
                
                <div class="rows">
                	<label>教师资格证: </label>
                    <span>
						<input type="file" class="form_input" name="Pic_Teach" />:(大小2M以下)
                        <?php /*?><div><span class="fl">&nbsp;&nbsp;&nbsp;图例:</span><img width="100" class="fl" src="<?=$model_row['PicPath_1']?>" /></div><?php */?>
                        <br /><br />
                        <img width="100" style="border:1px solid #ccc" src="<?=$member_ident_row['Pic_Teach']?>" />
                        <input type="hidden" name="S_Pic_Teach" value="<?=$member_ident_row['Pic_Teach']?>" />
                    </span>
                    <div class="clear"></div>
                </div>
                
                <div class="rows">
                	<label>相关证书: </label>
                    <span>
						<input type="file" class="form_input" name="Pic_Other" />:(大小2M以下)
                        <?php /*?><div><span class="fl">&nbsp;&nbsp;&nbsp;图例:</span><img width="100" class="fl" src="<?=$model_row['PicPath_2']?>" /></div><?php */?>
                        <br /><br />
                        <img width="100" style="border:1px solid #ccc"  src="<?=$member_ident_row['Pic_Other']?>" />
                        <input type="hidden" name="S_Pic_Other" value="<?=$member_ident_row['Pic_Other']?>" />
                    </span>
                    <div class="clear"></div>
                </div>
                
                
				<div class="clear"></div>
				<div class="rows">
					<label></label>
					<span><input name="Submit" type="submit" class="form_button form_button_130" value="保 存"></span>
					<div class="clear"></div>
				</div>
                <input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
				<input type="hidden" name="data" value="member_ident" />
			</form>
		</div>
	<?php }?>
</div>