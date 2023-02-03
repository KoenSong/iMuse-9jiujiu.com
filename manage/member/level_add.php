<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('member_level', 'member.level.add');

if($_POST){
	$Level=$_POST['Level'];
	$UpgradePrice=(float)$_POST['UpgradePrice'];
	$Discount=(float)$_POST['Discount'];
	
		
	$db->insert('member_level', array(
		'Level'				=>	$Level,
		'UpgradePrice'		=>	$UpgradePrice,
		'Discount'			=>	$Discount,
		'AccTime'			=>	$service_time
	)
	);

	save_manage_log('添加会员级别:'.$Level);
	
	header('Location: level.php');
	exit;
}

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="level.php"><?=get_lang('member.member_level_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.add');?></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="level_add.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<tr> 
		<td width="5%" nowrap><?=get_lang('member.level.level_name');?>:</td>
		<td width="95%">&nbsp;<input type="text" name="Level" value="" size="50" class="form_input" check="<?=get_lang('ly200.filled_out').get_lang('member.level.level_name');?>!~*" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="<?=get_lang('ly200.add');?>" name="submit" class="form_button"><a href='level.php' class="return"><?=get_lang('ly200.return');?></a></td>
	</tr>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>