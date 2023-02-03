<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('coupon', 'member.level.mod');

if($_POST){
	$LId=(int)$_POST['LId'];
	$query_string=$_POST['query_string'];
	$Level=$_POST['Level'];
	$UpgradePrice=(float)$_POST['UpgradePrice'];
	$Discount=(float)$_POST['Discount'];
	
	$db->update('member_level', "LId='$LId'", array(
			'Level'				=>	$Level,
			'UpgradePrice'		=>	$UpgradePrice,
			'Discount'			=>	$Discount,
			'AccTime'			=>	$service_time
		)
	);
	
	save_manage_log('编辑会员级别:'.$Level);
	
	header("Location: level.php?$query_string");
	exit;
}

$LId=(int)$_GET['LId'];
$query_string=query_string('LId');

$level_row=$db->get_one('member_level', "LId='$LId'");

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="level.php"><?=get_lang('member.member_level_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.mod');?></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="level_mod.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<tr> 
		<td width="5%" nowrap><?=get_lang('member.level.level_name');?>:</td>
		<td width="95%">&nbsp;<input type="text" name="Level" value="<?=$level_row['Level'];?>" size="50" class="form_input" check="<?=get_lang('ly200.filled_out').get_lang('member.level.level_name');?>!~*" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="<?=get_lang('ly200.mod');?>" name="submit" class="form_button"><a href='level.php' class="return"><?=get_lang('ly200.return');?></a><input type="hidden" name="LId" value="<?=$LId?>" /></td>
	</tr>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>