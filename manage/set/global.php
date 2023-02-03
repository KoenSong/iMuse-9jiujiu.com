<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('global_set');

if($_POST){
	$SeoTitle=format_post_value($_POST['SeoTitle']);
	$SeoKeywords=format_post_value($_POST['SeoKeywords']);
	$SeoDescription=format_post_value($_POST['SeoDescription']);
	$php_contents="\$mCfg['SeoTitle']='$SeoTitle';\r\n\$mCfg['SeoKeywords']='$SeoKeywords';\r\n\$mCfg['SeoDescription']='$SeoDescription';\r\n\r\n";
	
	//保存另外的语言版本的数据
	if(count(get_cfg('ly200.lang_array'))>1){
		for($i=1; $i<count(get_cfg('ly200.lang_array')); $i++){
			$field_ext='_'.get_cfg('ly200.lang_array.'.$i);
			$SeoTitleExt=format_post_value($_POST['SeoTitle'.$field_ext]);
			$SeoKeywordsExt=format_post_value($_POST['SeoKeywords'.$field_ext]);
			$SeoDescriptionExt=format_post_value($_POST['SeoDescription'.$field_ext]);
			$php_contents.="\$mCfg['SeoTitle{$field_ext}']='$SeoTitleExt';\r\n\$mCfg['SeoKeywords{$field_ext}']='$SeoKeywordsExt';\r\n\$mCfg['SeoDescription{$field_ext}']='$SeoDescriptionExt';\r\n\r\n";
		}
	}
	
	
//----------------------------------------------------------------------------------------------------------------------------------------------------------
	
	$_Tel=format_post_value($_POST['_Tel'], 0);
	//var_dump($_POST['_Tel']);
	$php_contents.="\$mCfg['_Tel']='$_Tel';\r\n\r\n";	
	
	$Level=format_post_value($_POST['Level'], 0);
	$php_contents.="\$mCfg['Level']='$Level';\r\n\r\n";	//----------------------------------------------------------------------------------------------------------------------------------------------------------
	
	$JsCode=format_post_value($_POST['JsCode'], 0);
	$php_contents.="\$mCfg['JsCode']='$JsCode';\r\n\r\n";
	
	//----------------------------------------------------------------------------------------------------------------------------------------------------------
	
	write_file('/inc/set/', 'global.php', "<?php\r\n$php_contents?>");
	
	save_manage_log('系统全局设置');
	
	header('Location: global.php');
	exit;
}

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="global.php"><?=get_lang('set.global.set');?></a></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="global.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
		<tr>
			<td width="5%" nowrap><?=get_lang('ly200.seo.seo').lang_name($i, 0);?>:</td>
			<td width="95%">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="5%" nowrap="nowrap"><?=get_lang('ly200.seo.title');?>:</td>
					<td width="95%"><input name="SeoTitle<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($mCfg['SeoTitle'.lang_name($i, 1)]);?>" class="form_input" size="70" maxlength="200" check="<?=get_lang('ly200.filled_out').get_lang('ly200.seo.title');?>!~*"></td>
				  </tr>
				  <tr>
					<td nowrap="nowrap"><?=get_lang('ly200.seo.keywords');?>:</td>
					<td><input name="SeoKeywords<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($mCfg['SeoKeywords'.lang_name($i, 1)]);?>" class="form_input" size="70" maxlength="200" check="<?=get_lang('ly200.filled_out').get_lang('ly200.seo.keywords');?>!~*"></td>
				  </tr>
				  <tr>
					<td nowrap="nowrap"><?=get_lang('ly200.seo.description');?>:</td>
					<td><input name="SeoDescription<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($mCfg['SeoDescription'.lang_name($i, 1)]);?>" class="form_input" size="70" maxlength="200" check="<?=get_lang('ly200.filled_out').get_lang('ly200.seo.description');?>!~*"></td>
				  </tr>
				</table>
			</td>
		</tr>
	<?php }?>
    <tr>
        <td nowrap>注册默认级别:</td>
        <td><select name="Level">
        	<?php
			$level_row=$db->get_all('member_level', 1, '*', 'UpgradePrice asc');
			for($i=0,$count=count($level_row); $i<$count; $i++){
			?>
        	<option value="<?=$level_row[$i]['LId'];?>" <?=$mCfg['Level']==$level_row[$i]['LId']?"selected":"";?>><?=$level_row[$i]['Level'];?></option>
            <?php }?>
        </select></td>
    </tr>
    <tr>
		<td nowrap>电话:</td>
		<td><input name="_Tel" class="form_input" value="<?=htmlspecialchars($mCfg['_Tel']);?>"  /></td>
	</tr>
    <tr>
		<td nowrap>立即关注:</td>
		<td><input name="Tel" class="form_input" value="<?=htmlspecialchars($mCfg['NOW1']);?>"  /></td>
	</tr>
    <tr>
		<td nowrap>立即订阅:</td>
		<td><input name="Tel" class="form_input" value="<?=htmlspecialchars($mCfg['NOW2']);?>"  /></td>
	</tr>
	<tr>
		<td nowrap><?=get_lang('set.global.js_code');?>:</td>
		<td><textarea name="JsCode" rows="8" cols="100" class="form_area"><?=htmlspecialchars($mCfg['JsCode']);?></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="<?=get_lang('ly200.submit');?>" name="submit" class="form_button"></td>
	</tr>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>