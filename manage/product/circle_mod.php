<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('product_circle', 'product.circle.mod');

if($_GET['action']=='delimg'){
	$CId=(int)$_POST['CId'];
	$PicPath=$_GET['PicPath'];
	
	del_file($PicPath);
	del_file(str_replace('s_', '', $PicPath));
	
	$db->update('product_circle', "CId='$CId'", array(
			'PicPath'	=>	''
		)
	);
	
	$str=js_contents_code(get_lang('ly200.del_success'));
	echo "<script language=javascript>parent.document.getElementById('img_list').innerHTML='$str'; parent.document.getElementById('img_list_a').innerHTML='';</script>";
	exit;
}

if($_POST){
	$CId=(int)$_POST['CId'];	
	$Circle=$_POST['Circle'];
	$ColorId=(int)$_POST['ColorId'];
	if(get_cfg('product.circle.upload_pic')){
		$save_dir=get_cfg('ly200.up_file_base_dir').'product/circle/'.date('y_m_d/', $service_time);
		$S_PicPath=$_POST['S_PicPath'];
		
		if($BigPicPath=up_file($_FILES['PicPath'], $save_dir)){
			include('../../inc/fun/img_resize.php');
			$SmallPicPath=img_resize($BigPicPath, '', get_cfg('product.circle.pic_width'), get_cfg('product.circle.pic_height'));
			del_file($S_PicPath);
			del_file(str_replace('s_', '', $S_PicPath));
		}else{
			$SmallPicPath=$S_PicPath;
		}
	}
	$db->update('product_circle', "CId='$CId'", array(
			'Circle'	=>	$Circle,
			'ColorId'	=>	$ColorId,
			'PicPath'	=>	$SmallPicPath
		)
	);
	
	//保存另外的语言版本的数据
	if(count(get_cfg('ly200.lang_array'))>1){
		add_lang_field('product_circle', 'Circle');
		
		for($i=1; $i<count(get_cfg('ly200.lang_array')); $i++){
			$field_ext='_'.get_cfg('ly200.lang_array.'.$i);
			$CircleExt=$_POST['Circle'.$field_ext];
			$db->update('product_circle', "CId='$CId'", array(
					'Circle'.$field_ext	=>	$CircleExt
				)
			);
		}
	}
	
	save_manage_log('更新产品颜色:'.$Circle);
	
	header('Location: circle.php');
	exit;
}

$CId=(int)$_GET['CId'];
$circle_row=$db->get_one('product_circle', "CId='$CId'");

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="circle.php"><?=get_lang('product.circle_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.mod');?></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="circle_mod.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcircle_table">
	<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
		<tr>
			<td width="5%" nowrap><?=get_lang('product.circle').lang_name($i, 0);?>:</td>
			<td width="95%"><input name="Circle<?=lang_name($i, 1);?>" value="<?=htmlspecialchars($circle_row['Circle'.lang_name($i, 1)]);?>" class="form_input" type="text" size="30" maxlength="40" check="<?=get_lang('ly200.filled_out').get_lang('product.circle');?>!~*"></td>
		</tr>
	<?php }?>
    <tr>
        <td width="5%" nowrap>所属地区:</td>
        <td width="95%">
            <select name="ColorId">
                <?php $color_row=$db->get_all('product_color','1');
                    for($i=0;$i<count($color_row);$i++){
                ?>
                <option value="<?=$color_row[$i]['CId']?>" <?=$circle_row['ColorId']==$color_row[$i]['CId']?'selected':''?>><?=$color_row[$i]['Color']?></option>
                <?php }?>
            </select>
        </td>
    </tr>
	<?php if(get_cfg('product.circle.upload_pic')){?>
		<tr>
			<td nowrap><?=get_lang('ly200.photo');?>:</td>
			<td>
				<input name="PicPath" type="file" size="50" class="form_input" contenteditable="false"><br>
				<?php if(is_file($site_root_path.$circle_row['PicPath'])){?>
				<iframe src="about:blank" name="del_img_iframe" style="display:none;"></iframe>
				<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr>
						<td width="70" height="70" style="border:1px solid #ddd; background:#fff;" align="center" id="img_list"><a href="<?=str_replace('s_', '', $circle_row['PicPath']);?>" target="_blank"><img src="<?=$circle_row['PicPath'];?>" <?=img_width_height(70, 70, $circle_row['PicPath']);?> /></a><input type='hidden' name='S_PicPath' value='<?=$circle_row['PicPath'];?>'></td>
					</tr>
					<tr>
						<td align="center" style="padding-top:4px;"><?=get_lang('ly200.photo');?><span id="img_list_a">&nbsp;<a href="circle_mod.php?action=delimg&CId=<?=$CId;?>&PicPath=<?=$circle_row['PicPath'];?>" target="del_img_iframe" class="blue">(<?=get_lang('ly200.del');?>)</a></span></td>
					</tr>
				</table>
				<?php }?>
			</td>
		</tr>
	<?php }?>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><a href='circle.php' class="return"><?=get_lang('ly200.return');?></a><input type="hidden" name="CId" value="<?=$CId;?>"></td>
	</tr>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>