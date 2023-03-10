<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('member');

if($_POST['list_form_action']=='member_del'){
	check_permit('', 'member.del');
	if(count($_POST['select_MemberId'])){
		$MemberId=implode(',', $_POST['select_MemberId']);
		$db->delete('member_apply', "MemberId in($MemberId)");
	}
	save_manage_log('批量删除会员');
	
	$page=(int)$_POST['page'];
	$query_string=urldecode($_POST['query_string']);
	header("Location: index.php?$query_string&page=$page");
	exit;
}

if($_POST['list_form_action']=='member_send_mail'){
	include('../../inc/manage/header.php');
	echo '<script language=javascript>';
	echo 'parent.openWindows("win_send_mail", "'.get_lang('send_mail.send_mail_system').'", "send_mail/index.php?MemberId='.implode(',', $_POST['select_MemberId']).'")';
	echo '</script>';
	js_back();
}

if($_GET['query_string']){
	$page=(int)$_GET['page'];
	header("Location: index.php?{$_GET['query_string']}&page=$page");
	exit;
}

//分页查询
$where='1';
$row_count=$db->get_row_count('member_apply', $where);
$total_pages=ceil($row_count/get_cfg('member_two.page_count'));
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*get_cfg('member_two.page_count');
$apply_row=$db->get_limit('member_apply', $where, '*', 'AId desc', $start_row, get_cfg('member_two.page_count'));

//获取页面跳转url参数
$query_string=query_string('page');
$query_string_no_order=query_string(array('page', 'order'));

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('member_two.member_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.list');?></div>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table" not_mouse_trBgcolor_tr='list_form_title'>
	<tr align="center" class="list_form_title" id="list_form_title">
		<td width="5%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
		<?php if(get_cfg('member.del') || $menu['send_mail']){?><td width="5%" nowrap><strong><?=get_lang('ly200.select');?></strong></td><?php }?>
		<td width="5%" nowrap><strong><?=get_lang('member.title');?></strong></td>
		<td width="10%" nowrap><strong><?=get_lang('ly200.full_name');?></strong></td>
        <td width="10%" nowrap><strong>手机</strong></td>
        <td width="10%" nowrap><strong>ID</strong></td>
		<td width="10%" nowrap><strong>申请时间</strong></td>
		<td width="10%" nowrap><strong>是否审核</strong></td>
        <td width="10%" nowrap><strong>状态</strong></td>
		<td width="5%" nowrap><strong><?=get_lang('ly200.operation');?></strong></td>
	</tr>
	<?php
	$i=1;
	foreach((array)$apply_row as $member_row){
		$member_info=$db->get_one('member',"MemberId = '{$member_row['MemberId']}'");
	?>
	<tr align="center">
		<td nowrap><?=$start_row+$i++;?></td>
		<?php if(get_cfg('member.del') || $menu['send_mail']){?><td><input type="checkbox" name="select_MemberId[]" value="<?=$member_row['MemberId'];?>"></td><?php }?>
		<td nowrap><?=htmlspecialchars($member_info['Title']);?></td>
		<td nowrap><?=htmlspecialchars($member_info['UserName']);?></td>
		<td nowrap><?=htmlspecialchars($member_info['Phone']);?></td>
        <td nowrap><?php echo sprintf('%08s',$member_info['MemberId'])?></td>
        <td nowrap><?=htmlspecialchars(date('Y-m-d',$member_row['ApplyTime']));?></td>
		<td nowrap><?=$member_row['Ischeck']==1?'已审核':'<font class="fc_red">未审核</font>'?></td>
        <td nowrap><?=$member_info['IsTeacher']==1?'通过':'<font class="fc_red">不通过</font>'?></td>
		<td><a href="view.php?<?=$query_string;?>&AId=<?=$member_row['AId']?>"><img src="../images/view.gif" alt="<?=get_lang('ly200.view');?>" /></a></td>
	</tr>
	<?php }?>
	<?php if((get_cfg('member.del') || $menu['send_mail']) && count($member_row)){?>
	<tr>
		<td colspan="20" class="bottom_act">
			<input name="button" type="button" class="form_button" onClick='change_all("select_MemberId[]");' value="<?=get_lang('ly200.anti_select');?>">
			<?php if($menu['send_mail']){?><input name="member_send_mail" id="member_send_mail" type="button" class="form_button" onClick="click_button(this, 'list_form', 'list_form_action');" value="<?=get_lang('send_mail.send');?>"><?php }?>
			<?php if(get_cfg('member.del')){?><input name="member_del" id="member_del" type="button" class="form_button" onClick="if(!confirm('<?=get_lang('ly200.confirm_del');?>')){return false;}else{click_button(this, 'list_form', 'list_form_action');};" value="<?=get_lang('ly200.del');?>"><?php }?>
			<input type="hidden" name="query_string" value="<?=urlencode($query_string);?>">
			<input type="hidden" name="page" value="<?=$page;?>">
			<input name="list_form_action" id="list_form_action" type="hidden" value="">
		</td>
	</tr>
	<?php }?>
</table>
</form>
<form method="get" class="turn_page_form" action="index.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "index.php?$query_string&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="query_string" type="hidden" value="<?=$query_string;?>">
</form>
<?php include('../../inc/manage/footer.php');?>