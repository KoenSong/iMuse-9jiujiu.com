<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('withdraw');

if($_POST['list_form_action']=='withdraw_del'){
	check_permit('', 'withdraw.del');
	if(count($_POST['select_MId'])){
		$MId=implode(',', $_POST['select_MId']);
		$db->delete('member_withdraw', "MId in($MId)");
	}
	save_manage_log('批量删除在线询盘');
	
	$page=(int)$_POST['page'];
	$query_string=urldecode($_POST['query_string']);
	header("Location: index.php?$query_string&page=$page");
	exit;
}

if($_GET['query_string']){
	$page=(int)$_GET['page'];
	header("Location: index.php?{$_GET['query_string']}&page=$page");
	exit;
}

//分页查询
$where=1;
$row_count=$db->get_row_count('member_withdraw', $where);
$total_pages=ceil($row_count/get_cfg('withdraw.page_count'));
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*get_cfg('withdraw.page_count');
$withdraw_row=$db->get_limit('member_withdraw', $where, '*', 'MId desc', $start_row, get_cfg('withdraw.page_count'));

//获取页面跳转url参数
$query_string=query_string('page');
$all_query_string=query_string();

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('withdraw.withdraw_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.list');?></div>
<form method="get" class="turn_page_form" action="index.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "index.php?$query_string&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="query_string" type="hidden" value="<?=$query_string;?>">
</form>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table" not_mouse_trBgcolor_tr='list_form_title'>
	<tr align="center" class="list_form_title" id="list_form_title">
		<td width="5%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
		<?php if(get_cfg('withdraw.del')){?><td width="5%" nowrap><strong><?=get_lang('ly200.select');?></strong></td><?php }?>
		<td width="10%" nowrap><strong><?=get_lang('withdraw.full_name');?></strong></td>
		<td width="20%" nowrap><strong><?=get_lang('withdraw.price');?></strong></td>
		<td width="20%" nowrap><strong><?=get_lang('withdraw.status');?></strong></td>
		<td width="15%" nowrap><strong><?=get_lang('ly200.time');?></strong></td>
		<?php if(get_cfg('withdraw.mod')){ ?><td width="15%" nowrap><strong><?=get_lang('ly200.operation');?></strong></td><?php } ?>
	</tr>
	<?php
	include('../../inc/fun/ip_to_area.php');
	for($i=0; $i<count($withdraw_row); $i++){
		$ip_area=ip_to_area($withdraw_row[$i]['Ip']);
	?>
	<tr align="center">
		<td nowrap><?=$start_row+$i+1;?></td>
		<?php if(get_cfg('withdraw.del')){?><td><input type="checkbox" name="select_MId[]" value="<?=$withdraw_row[$i]['MId'];?>"></td><?php }?>
		<td nowrap><?=htmlspecialchars($withdraw_row[$i]['FullName']);?></td>
		<td nowrap><?=iconv_price($withdraw_row[$i]['Price']);?></td>
		<td nowrap><?=htmlspecialchars($withdraw_ary[$withdraw_row[$i]['Status']]);?></td>
		<td nowrap><?=date('Y-m-d H:i',$withdraw_row[$i]['PostTime']);?></td>
        <?php if(get_cfg('withdraw.mod')){ ?><td nowrap><a href="view.php?<?=$all_query_string;?>&MId=<?=$withdraw_row[$i]['MId']?>"><img src="../images/view.gif" alt="<?=get_lang('ly200.view');?>" /></a></td><?php } ?>
	</tr>
	<?php }?>
	<?php if(get_cfg('withdraw.del') && count($withdraw_row)){?>
	<tr>
		<td colspan="20" class="bottom_act">
			<input name="button" type="button" class="form_button" onClick='change_all("select_MId[]");' value="<?=get_lang('ly200.anti_select');?>">
			<input name="withdraw_del" id="withdraw_del" type="button" class="form_button" onClick="if(!confirm('<?=get_lang('ly200.confirm_del');?>')){return false;}else{click_button(this, 'list_form', 'list_form_action');};" value="<?=get_lang('ly200.del');?>">
			<input type="hidden" name="query_string" value="<?=urlencode($query_string);?>">
			<input type="hidden" name="page" value="<?=$page;?>">
			<input name="list_form_action" id="list_form_action" type="hidden" value="">
            
            <span style="margin-left:80px;">提现总额&nbsp;：</span>&nbsp;<span><?=$db->get_sum('member_withdraw','1','Price');?></span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;会员总额&nbsp;：</span>&nbsp;<span><?=$db->get_sum('member','1','Account_Price');?></span>
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