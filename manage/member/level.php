<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('member_level');
if($_POST['list_form_action']=='level_del'){
	check_permit('', 'member.level.del');
	if(count($_POST['select_LId'])){
		$LId=implode(',', $_POST['select_LId']);
		$db->delete('member_level', "LId in($LId)");
	}
	save_manage_log('批量删除优惠券');
	
	$page=(int)$_POST['page'];
	$query_string=urldecode($_POST['query_string']);
	header("Location: level.php?$query_string&page=$page");
	exit;
}

if($_GET['query_string']){
	$page=(int)$_GET['page'];
	header("Location: level.php?{$_GET['query_string']}&page=$page");
	exit;
}

//分页查询
$where=1;
$row_count=$db->get_row_count('member_level', $where);
$total_pages=ceil($row_count/get_cfg('member.level.page_count'));
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*get_cfg('member.level.page_count');
$level_row=$db->get_limit('member_level', $where, '*', 'UpgradePrice desc', $start_row, get_cfg('member.level.page_count'));

//获取页面跳转url参数
$query_string=query_string('page');

include('../../inc/manage/header.php');
?>
<div class="header">
	<div class="float_left"><?=get_lang('ly200.current_location');?>:<a href="level.php"><?=get_lang('member.member_level_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.list');?></div>
	<?php if(get_cfg('member.level.add')){?><div class="float_right"><a href="level_add.php"><?=get_lang('ly200.add');?></a></div><?php }?>
</div>

<form method="get" class="turn_page_form" action="level.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "level.php?$query_string&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" class="form_input" type="text" size="2" maxlength="5">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="query_string" type="hidden" value="<?=$query_string;?>">
</form>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table" not_mouse_trBgcolor_tr='list_form_title'>
	<tr align="center" class="list_form_title" id="list_form_title">
		<td width="5%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
		<?php if(get_cfg('member.level.del')){?><td width="5%" nowrap><strong><?=get_lang('ly200.select');?></strong></td><?php }?>
		<td width="10%" nowrap><strong><?=get_lang('member.level.level_name');?></strong></td>
        <td width='13%' nowrap><strong><?=get_lang('ly200.time');?></strong></td>
		<?php if(get_cfg('member.level.mod')){?><td width="5%" nowrap><strong><?=get_lang('ly200.operation');?></strong></td><?php }?>
	</tr>
	<?php
	for($i=0; $i<count($level_row); $i++){
	?>
	<tr align="center">
		<td nowrap><?=$start_row+$i+1;?></td>
		<?php if(get_cfg('member.level.del')){?><td><input type="checkbox" name="select_LId[]" value="<?=$level_row[$i]['LId'];?>"<?=($i+1)==count($level_row)?' disabled="disabled"':'';?>></td><?php }?>
		<td class="break_all"><?=$level_row[$i]['Level'];?></td>
        <td nowrap><?=$level_row[$i]['AccTime']?date('Y-m-d',$level_row[$i]['AccTime']):"N/A";?></td>
		<td nowrap><a href="level_mod.php?<?=$query_string;?>&LId=<?=$level_row[$i]['LId']?>"><img src="../images/mod.gif" alt="<?=get_lang('ly200.mod');?>"></a></td>
	</tr>
	<?php }?>
	<?php if(get_cfg('member.level.del') && count($level_row)){?>
	<tr>
		<td colspan="20" class="bottom_act">
			<?php if(get_cfg('member.level.del')){?>
				<input name="button" type="button" class="form_button" onClick='change_all("select_LId[]");' value="<?=get_lang('ly200.anti_select');?>">
				<input name="level_del" id="level_del" type="button" class="form_button" onClick="if(!confirm('<?=get_lang('ly200.confirm_del');?>')){return false;}else{click_button(this, 'list_form', 'list_form_action');};" value="<?=get_lang('ly200.del');?>">
			<?php }?>
			<input type="hidden" name="query_string" value="<?=urlencode($query_string);?>">
			<input type="hidden" name="page" value="<?=$page;?>">
			<input name="list_form_action" id="list_form_action" type="hidden" value="">
		</td>
	</tr>
	<?php }?>
</table>
</form>
<form method="get" class="turn_page_form" action="level.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "level.php?$query_string&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="query_string" type="hidden" value="<?=$query_string;?>">
</form>
<?php include('../../inc/manage/footer.php');?>