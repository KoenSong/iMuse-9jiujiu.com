<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('product_color', 'product.color.add');

if($_POST){
	$Color=$_POST['Color'];
	
	if(get_cfg('product.color.upload_pic')){
		$save_dir=get_cfg('ly200.up_file_base_dir').'product/color/'.date('y_m_d/', $service_time);
		
		if($BigPicPath=up_file($_FILES['PicPath'], $save_dir)){
			include('../../inc/fun/img_resize.php');
			$SmallPicPath=img_resize($BigPicPath, '', get_cfg('product.color.pic_width'), get_cfg('product.color.pic_height'));
		}
	}
	
	$db->insert('product_color', array(
			'Color'		=>	$Color,
			'PicPath'	=>	$SmallPicPath
		)
	);
	
	$CId=$db->get_insert_id();
	
	//保存另外的语言版本的数据
	if(count(get_cfg('ly200.lang_array'))>1){
		add_lang_field('product_color', 'Color');
		
		for($i=1; $i<count(get_cfg('ly200.lang_array')); $i++){
			$field_ext='_'.get_cfg('ly200.lang_array.'.$i);
			$ColorExt=$_POST['Color'.$field_ext];
			$db->update('product_color', "CId='$CId'", array(
					'Color'.$field_ext	=>	$ColorExt
				)
			);
		}
	}
	
	save_manage_log('添加产品颜色:'.$Color);
	
	header('Location: color.php');
	exit;
}

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="color.php"><?=get_lang('product.color_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.add');?></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="color_add.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
		<tr>
			<td width="5%" nowrap><?=get_lang('product.color').lang_name($i, 0);?>:</td>
			<td width="95%"><input name="Color<?=lang_name($i, 1);?>" type="text" value="" class="form_input" size="30" maxlength="40" check="<?=get_lang('ly200.filled_out').get_lang('product.color');?>!~*"></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.color.upload_pic')){?>
		<tr>
			<td nowrap><?=get_lang('ly200.photo');?>:</td>
			<td><input name="PicPath" type="file" size="50" class="form_input" contenteditable="false"></td>
		</tr>
	<?php }?>
	<tr>
		<td>&nbsp;</td>
		<td><input type="Submit" name="submit" value="<?=get_lang('ly200.add');?>" class="form_button"><a href='color.php' class="return"><?=get_lang('ly200.return');?></a></td>
	</tr>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>