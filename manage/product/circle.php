<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('product_circle');

if($_POST['action']=='order_circle'){
	check_permit('', 'product.circle.order');
	for($i=0; $i<count($_POST['MyOrder']); $i++){
		$CId=(int)$_POST['CId'][$i];
		$order=abs((int)$_POST['MyOrder'][$i]);
		
		$db->update('product_circle', "CId='$CId'", array(
				'MyOrder'	=>	$order
			)
		);
	}
	
	save_manage_log('产品颜色排序');
	
	header('Location: circle.php');
	exit;
}

if($_POST['action']=='del_circle'){
	check_permit('', 'product.circle.del');
	if(count($_POST['select_CId'])){
		$CId=implode(',', $_POST['select_CId']);
		$where="CId in($CId)";
		
		if(get_cfg('product.circle.upload_pic')){
			$circle_row=$db->get_all('product_circle', $where, 'PicPath');
			for($i=0; $i<count($circle_row); $i++){
				del_file($circle_row[$i]['PicPath']);
				del_file(str_replace('s_', '', $circle_row[$i]['PicPath']));
			}
		}
		$db->delete('product_circle', $where);
	}
	save_manage_log('删除产品颜色');
	
	header('Location: circle.php');
	exit;
}

include('../../inc/manage/header.php');
?>
<div class="header">
	<div class="float_left"><?=get_lang('ly200.current_location');?>:<a href="circle.php"><?=get_lang('product.circle_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.list');?></div>
	<?php if(get_cfg('product.circle.add')){?><div class="float_right"><a href="circle_add.php"><?=get_lang('ly200.add');?></a></div><?php }?>
</div>
<form name="list_form" id="list_form" class="list_form" method="post" action="circle.php">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcircle_table" not_mouse_trBgcircle_tr='list_form_title'>
	<tr align="center" class="list_form_title" id="list_form_title">
		<td width="5%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
		<?php if(get_cfg('product.circle.del')){?><td width="5%" nowrap><strong><?=get_lang('ly200.select');?></strong></td><?php }?>
		<?php if(get_cfg('product.circle.order')){?><td width="5%" nowrap><strong><?=get_lang('ly200.order');?></strong></td><?php }?>
		<td width="16%" nowrap><strong><?=get_lang('product.circle');?></strong></td>
		<?php if(get_cfg('product.circle.upload_pic')){?><td width="10%" nowrap><strong><?=get_lang('ly200.photo');?></strong></td><?php }?>
		<?php if(get_cfg('product.circle.mod')){?><td width="8%" nowrap><strong><?=get_lang('ly200.operation');?></strong></td><?php }?>
	</tr>
	<?php
	$circle_row=$db->get_all('product_circle', 1, '*', 'MyOrder desc, CId asc');
	for($i=0; $i<count($circle_row); $i++){
	?>
	<tr align="center">
		<td nowrap><?=($i+1)?></td>
		<?php if(get_cfg('product.circle.del')){?><td><input name="select_CId[]" type="checkbox" value="<?=$circle_row[$i]['CId'];?>" /></td><?php }?>
		<?php if(get_cfg('product.circle.order')){?><td><input name="MyOrder[]" class="form_input" type="text" size="3" maxlength="10" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" value="<?=htmlspecialchars($circle_row[$i]['MyOrder']);?>" /><input type="hidden" name="CId[]" value="<?=$circle_row[$i]['CId'];?>" /></td><?php }?>
		<td nowrap><?=list_all_lang_data($circle_row[$i], 'Circle');?></td>
		<?php if(get_cfg('product.circle.upload_pic')){?><td><?=creat_imgLink_by_sImg($circle_row[$i]['PicPath']);?></td><?php }?>
		<?php if(get_cfg('product.circle.mod')){?><td nowrap><a href="circle_mod.php?CId=<?=$circle_row[$i]['CId'];?>"><img src="../images/mod.gif" alt="<?=get_lang('ly200.mod');?>"></a></td><?php }?>
	</tr>
	<?php }?>
	<?php if((get_cfg('product.circle.order') || get_cfg('product.circle.del')) && count($circle_row)){?>
	<tr>
		<td colspan="6" class="bottom_act">
			<?php if(get_cfg('product.circle.order')){?><input name="order_circle" type="button" class="form_button" onClick="click_button(this, 'list_form', 'action');" value="<?=get_lang('ly200.order');?>"><?php }?>
			<?php if(get_cfg('product.circle.del')){?>
				<input name="button" type="button" class="form_button" onClick='change_all("select_CId[]");' value="<?=get_lang('ly200.anti_select');?>">
				<input name="del_circle" type="button" class="form_button" onClick="if(!confirm('<?=get_lang('ly200.confirm_del');?>')){return false;}else{click_button(this, 'list_form', 'action');};" value="<?=get_lang('ly200.del');?>">
			<?php }?>
			<input name="action" id="action" type="hidden" value="">
		</td>
	</tr>
	<?php }?>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>