<?php
$query_string=query_string(array('forgot_success', 'forgot_fail'));
if($_POST['data']=='member_profile'){
	$MHead = '';
	if($_FILES['HeadPic']){
		include($site_root_path.'/inc/fun/img_resize.php');
		del_file($member_info['Face']);
		$save_dir='/u_file/face/'.date('y_m/d/', $now_time);
		$MHead=up_file($_FILES['HeadPic'], $save_dir);
		//$dirname=dirname($MHead);
		//$filename=basename($MHead);
		$pic_size=array('240X240','235X235','default'=>'150X150','105X105','72X72');
		foreach( $pic_size as $key => $value){
			$w_h=@explode('X', $value);
					$filename="$key"=='default'?'':dirname($MHead).'/'.$value.'_'.basename($MHead);
					$path=img_resize($MHead, $filename, (int)$w_h[0], (int)$w_h[1]);
					"$key"=='default' && $SmallPicPath=$path;
		}
		$MHead=@is_file($site_root_path.$SmallPicPath)?$SmallPicPath:$member_info['Face'];
	}
	$db->update('member', $where, array(
			'Face'		=>	$MHead,
		)
	);
	//print_r($_POST);
	//exit;
	js_location("$member_url_cn?profile_success=1&$query_string");
}
$cur='头像设置';
?>
<div id="lib_member_profile">
	<div class="webpath">
    	<span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span>
    </div>
	<?php if($_GET['profile_success']==1){?>
		<div class="blank15"></div>
		<div class="change_success lib_member_item_card">
			<br />您已经成功更改个人头像。<br /><br /><br />
			<a href="<?=$member_url_cn;?>?module=index"><strong>我的账号</strong></a><br /><br />
		</div>
	<?php }else{?>
		<div class="lib_member_info">如果您要更改您的个人资料，请填写下面的表格，点击"保存"按钮。</div>
		<div class="form lib_member_item_card">
			<form action="<?=$member_url_cn.'?'.$query_string;?>" method="post" enctype="multipart/form-data"  name="member_profile_form" OnSubmit="return checkForm(this);">
				<div class="lib_member_sub_title">更改您的个人头像</div>
				<div class="rows">
					<label>头像:(建议240X240像素) <font class="fc_red">*</font></label>
					<span><input type="file" name="HeadPic" /><br /> 
                    <img src="<?=is_file($site_root_path.$member_info['Face'])?$member_info['Face']:'/images/face.jpg';?>" width="130" height="130"/></span>
                     	  
					<div class="clear"></div>
				</div>
                
				<div class="clear"></div>
				<div class="rows">
					<label></label>
					<span><input name="Submit" type="submit" class="form_button form_button_130" value="保 存"></span>
					<div class="clear"></div>
				</div>
				<input type="hidden" name="data" value="member_profile" />
			</form>
		</div>
	<?php }?>
</div>