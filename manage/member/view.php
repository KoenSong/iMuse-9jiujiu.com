<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');
include('../../inc/fun/ip_to_area.php');

check_permit('member');

if($_POST['data']=='mod_profile'){
	check_permit('', 'member.mod');
	$MemberId=(int)$_POST['MemberId'];
	$Account_Price=(float)$_POST['Account_Price'];
	$Phone=$_POST['Phone'];
	
	if(!$db->get_row_count('member',"Phone = '$Phone'")){
		$db->update('member', "MemberId='$MemberId'", array(
				'Account_Price'		=>	$Account_Price,
				'Phone'				=>	$Phone,
			)
		);
		save_manage_log('修改注册用户信息');
		js_location("view.php?MemberId=$MemberId");
	}else{
		js_back('手机号已存在');
	}
}

if($_POST['data']=='mod_apply'){
	check_permit('', 'member.mod');
	$MemberId=(int)$_POST['MemberId'];
	
    $Degree=(int)$_POST['Degree'];
    $Certification=(int)$_POST['Certification'];
    $Identity=(int)$_POST['Identity'];
	
	$db->update('member_apply', "MemberId='$MemberId'", array(
			'Degree'		=>	$Degree,
			'Certification'	=>	$Certification,
			'Identity'		=>	$Identity,
		)
	);
	
	save_manage_log('修改注册用户信息');
	js_location("view.php?MemberId=$MemberId");
}

if($_POST['data']=='mod_password'){
	check_permit('', 'member.mod');
	$MemberId=(int)$_POST['MemberId'];
	
	$db->update('member', "MemberId='$MemberId'", array(
			'Password '	=>	password($_POST['NewPassword'])
		)
	);
	
	save_manage_log('修改注册用户密码');
	js_location("view.php?MemberId=$MemberId");
}
if($_POST['data']=='mod_holder'){
	check_permit('', 'member.mod');
	$MemberId=(int)$_POST['MemberId'];
	$Holder_UserName=$_POST['Holder_UserName'];
	$Holder_City=(int)$_POST['Holder_City'];
	$Holder_Bank=(int)$_POST['Holder_Bank'];
	$Holder_Detail=$_POST['Holder_Detail'];
	$Holder_Num=$_POST['Holder_Num'];
	$db->update('member', "MemberId='$MemberId'", array(
			'Holder_UserName'	=>	$Holder_UserName,
			'Holder_City'		=>	$Holder_City,
			'Holder_Bank'		=>	$Holder_Bank,
			'Holder_Detail'		=>	$Holder_Detail,
			'Holder_Num'		=>	$Holder_Num,
		)
	);
	
	save_manage_log('修改用户开户信息');
	js_location("view.php?MemberId=$MemberId");
}

$MemberId=(int)$_GET['MemberId'];
$detail_card=(int)$_GET['detail_card'];
$where="MemberId='$MemberId'";
$query_string=query_string(array('detail_card', 'page'));

$member_row=$db->get_one('member', $where);
$member_apply=$db->get_one('member_apply',$where);

if($detail_card==0){
	$reg_ip_area=ip_to_area($member_row['RegIp']);
	$last_login_ip_area=ip_to_area($member_row['LastLoginIp']);
}elseif($detail_card==1){
	$shipping_address=$db->get_all('member_address_book', "$where and AddressType=0", '*', 'IsDefault desc, AId desc');
	$billing_address=$db->get_one('member_address_book', "$where and AddressType=1");
}elseif($detail_card==2){
	$row_count=$db->get_row_count('product', "ProId in(select ProId from wish_lists where $where)");
}elseif($detail_card==3){
	$row_count=$db->get_row_count('shopping_cart', $where);
}elseif($detail_card==4){
	check_permit('orders');
	$row_count=$db->get_row_count('orders', $where);
}elseif($detail_card==5){
	$row_count=$db->get_row_count('member_login_log', $where);
}

if($detail_card==2 || $detail_card==3 || $detail_card==4 || $detail_card==5){
	$page_count=20;
	$total_pages=ceil($row_count/$page_count);
	$page=(int)$_GET['page'];
	$page<1 && $page=1;
	$page>$total_pages && $page=1;
	$start_row=($page-1)*$page_count;
}

if($detail_card==2){
	$list_row=$db->get_limit('product', "ProId in(select ProId from wish_lists where $where)", '*', 'ProId desc', $start_row, $page_count);
}elseif($detail_card==3){
	$list_row=$db->get_limit('shopping_cart', $where, '*', 'CId desc', $start_row, $page_count);
}elseif($detail_card==4){
	$list_row=$db->get_limit('orders', $where, '*', 'OrderId desc', $start_row, $page_count);
}elseif($detail_card==5){
	$list_row=$db->get_limit('member_login_log', $where, '*', 'LId desc', $start_row, $page_count);
}elseif($detail_card==7){  //开户信息
	$holder_info=$db->get_one('member_holder', $where);
	$city_ary = $db->get_all('product_color','1','CId,Color','MyOrder desc,CId asc');
}

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('member.member_manage');?></a>&nbsp;-&gt;&nbsp;<a href="view.php?<?=$query_string;?>"><?=htmlspecialchars($member_row['UserName']);?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.view');?></div>
<div class="act_form">
	<div class="card_list">
		<div class="<?=$detail_card==0?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=0"><?=get_lang('member.base_info');?></a></div>
		<?php if(!1 && $member_row['IsTeacher']){?><div class="<?=$detail_card==1?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=1">教师信息</a></div><?php }?>
		<?php if(!$member_row['IsTeacher']){?><div class="<?=$detail_card==2?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=2">关注老师</a></div>
        <?php }?>
		<?php /*?><div class="<?=$detail_card==3?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=3"><?=get_lang('member.shopping_cart');?></a></div>
		<?php if($menu['orders']){?><div class="<?=$detail_card==4?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=4"><?=get_lang('member.order_info');?></a></div><?php }?>
		<div class="<?=$detail_card==5?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=5"><?=get_lang('member.login_info');?></a></div><?php */?>
		<?php if(get_cfg('member.mod')){?><div class="<?=$detail_card==6?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=6"><?=get_lang('member.mod_password');?></a></div><?php }?>
        <div class="<?=$detail_card==7?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=7"><?=get_lang('member.member_holder.holder_info');?></a></div>
	</div>
</div>
<?php if($detail_card==0){?>
<form method="post" name="act_form" id="act_form" class="act_form" action="view.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
		<tr> 
			<td width="5%" nowrap><?=get_lang('member.title');?>:</td>
			<td width="95%"><?=htmlspecialchars($member_row['Title']);?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('ly200.full_name');?>:</td>
			<td><?=htmlspecialchars($member_row['UserName']);?></td>
		</tr>
        <tr>
			<td nowrap>账号手机:</td>
			<td><input type="text" class="form_input" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" value="<?=htmlspecialchars($member_row['Phone']);?>" maxlength="11" name="Phone" /></td>
		</tr>
        <tr>
			<td nowrap>账号余额:</td>
			<td><input type="text" class="form_input" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" value="<?=htmlspecialchars($member_row['Account_Price']);?>" name="Account_Price" /></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('ly200.email');?>:</td>
			<td><?=htmlspecialchars($member_row['Email']);?><?php if($menu['send_mail']){?>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="this.blur(); parent.openWindows('win_send_mail', '<?=get_lang('send_mail.send_mail_system');?>', 'send_mail/index.php?email=<?=urlencode($member_row['Email'].'/'.$member_row['FirstName'].' '.$member_row['LastName']);?>');" class="red"><?=get_lang('send_mail.send');?></a><?php }?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('member.reg_time');?>:</td>
			<td><?=date(get_lang('ly200.time_format_full'), $member_row['RegTime']);?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('member.reg_ip');?>:</td>
			<td><?=htmlspecialchars($member_row['RegIp']);?> [<?=$reg_ip_area['country'].$reg_ip_area['area'];?>]</td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('member.last_login_time');?>:</td>
			<td><?=date(get_lang('ly200.time_format_full'), $member_row['LastLoginTime']);?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('member.last_login_ip');?>:</td>
			<td><?=htmlspecialchars($member_row['LastLoginIp']);?> [<?=$last_login_ip_area['country'].$last_login_ip_area['area'];?>]</td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('member.consumption_price');?>:</td>
			<td><?=get_lang('ly200.price_symbols').sprintf('%01.2f', $db->get_sum('orders', "OrderStatus in(5, 6) and MemberId='$MemberId'", 'TotalPrice'));?><?php /*?><?php if($menu['orders']){?>&nbsp;&nbsp;&nbsp;<a href="view.php?<?=$query_string;?>&detail_card=4" class="red"><?=get_lang('member.order_info');?></a><?php }?><?php */?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('member.login_times');?>:</td>
			<td><?=$member_row['LoginTimes'];?>&nbsp;&nbsp;&nbsp;<a href="view.php?<?=$query_string;?>&detail_card=5" class="red"><?=get_lang('member.login_info');?></a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="Submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><input type="hidden" name="MemberId" value="<?=$MemberId;?>" /><input type="hidden" name="data" value="mod_profile" /></td>
		</tr>
	</table>
</form>
<?php }elseif($detail_card==1){?>
<form method="post" name="act_form" id="act_form" class="act_form" action="view.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
		<tr> 
			<td width="5%" nowrap><?=get_lang('member.title');?>:</td>
			<td width="95%"><?=htmlspecialchars($member_row['Title']);?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('ly200.full_name');?>:</td>
			<td><?=htmlspecialchars($member_row['FirstName'].' '.$member_row['LastName']);?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('ly200.email');?>:</td>
			<td><?=htmlspecialchars($member_row['Email']);?><?php if($menu['send_mail']){?>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="this.blur(); parent.openWindows('win_send_mail', '<?=get_lang('send_mail.send_mail_system');?>', 'send_mail/index.php?email=<?=urlencode($member_row['Email'].'/'.$member_row['FirstName'].' '.$member_row['LastName']);?>');" class="red"><?=get_lang('send_mail.send');?></a><?php }?></td>
		</tr>
        <tr>
			<td nowrap>申请时间:</td>
			<td><?=date('Y-m-d',$member_apply['RegTime']);?></td>
		</tr>
		<tr>
			<td nowrap>申请科目:</td>
			<td><?=$db->get_value('product_category',"CateId = '{$member_apply['CateId']}'",'Category');?></td>
		</tr>
		<tr>
			<td nowrap>教龄:</td>
			<td><?= $member_apply['T_age']?></td>
		</tr>
		<tr>
			<td nowrap>教学地点:</td>
			<td><?=htmlspecialchars($member_apply['T_address']);?></td>
		</tr>
        <tr>
			<td nowrap>教学理念:</td>
			<td><?=htmlspecialchars($member_apply['T_will']);?></td>
		</tr>
        <tr>
			<td nowrap>教学特长:</td>
			<td><?=htmlspecialchars($member_apply['T_gift']);?></td>
		</tr>
        <tr>
			<td nowrap>教学经历:</td>
			<td><?=htmlspecialchars($member_apply['T_thought']);?></td>
		</tr>
        <tr>
			<td nowrap>教学成果:</td>
			<td><?=htmlspecialchars($member_apply['T_success']);?></td>
		</tr>
        <tr>
			<td nowrap>教学成就:</td>
			<td><?=htmlspecialchars($member_apply['T_ter']);?></td>
		</tr>
        <tr>
        	<td nowrap>证书验证:</td>
			<td>
            	<table width="50%" border="0" cellpadding="0" cellspacing="1">
                	<tr>
                    	<td>学历认证</td>
                        <td>
                            <select name="Degree">
                            	<option>请选择</option>
                                <option value="1" <?=$member_apply['Degree']==1?'selected':''?>>通过</option>
                                <option value="2" <?=$member_apply['Degree']==2?'selected':''?>>不通过</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>专业认证</td>
                        <td>
                            <select name="Certification">
                            	<option>请选择</option>
                                <option value="1" <?=$member_apply['Certification']==1?'selected':''?>>通过</option>
                                <option value="2" <?=$member_apply['Certification']==2?'selected':''?>>不通过</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>身份认证</td>
                        <td>
                            <select name="Identity">
                            	<option>请选择</option>
                                <option value="1" <?=$member_apply['Identity']==1?'selected':''?>>通过</option>
                                <option value="2" <?=$member_apply['Identity']==2?'selected':''?>>不通过</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
			<td>&nbsp;</td>
			<td><input type="Submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><input type="hidden" name="MemberId" value="<?=$MemberId;?>" /><input type="hidden" name="data" value="mod_apply" /></td>
		</tr>
	</table>
</form>
<?php }elseif($detail_card==2){?>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
	<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
		<tr align="center" class="list_form_title">
			<td width="10%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
			<td width="16%" nowrap><strong><?=get_lang('ly200.photo');?></strong></td>
			<td width="16%" nowrap><strong>科目</strong></td>
			<td width="43%" nowrap><strong><?=get_lang('ly200.name');?></strong></td>
			<td width="15%" nowrap><strong><?=get_lang('ly200.time');?></strong></td>
		</tr>
		<?php
		for($i=0; $i<count($list_row); $i++){
			$url=sprintf($product_url_ary[$product_url_type], $list_row[$i][$product_url_var_ary[$product_url_type]]);
		?>
		<tr align="center">
			<td nowrap><?=$start_row+$i+1;?></td>
			<td nowrap><a href="<?=$url;?>" target="_blank"><img width="90" src="<?=str_replace('s_', '', $list_row[$i]['PicPath_0']);?>" /></a></td>
			<td nowrap><a href="<?=$url;?>" target="_blank"><?=$db->get_value('product_category',"CateId= '{$list_row[$i]['CateId']}'",'Category');?></a></td>
			<td nowrap><a href="<?=$url;?>" target="_blank"><?=$list_row[$i]['Name'];?></a></td>
			<td nowrap><?=date(get_lang('ly200.time_format_full'), $db->get_value('wish_lists', $where, 'WishTime'));?></td>
		</tr>
		<?php }?>
	</table>
</form>
<form method="get" class="turn_page_form" action="view.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "view.php?$query_string&detail_card=$detail_card&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="detail_card" type="hidden" value="<?=$detail_card;?>">
	<input name="MemberId" type="hidden" value="<?=$MemberId;?>">
</form>
<?php }elseif($detail_card==3){?>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
	<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
		<tr align="center" class="list_form_title">
			<td width="8%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
			<td width="10%" nowrap><strong><?=get_lang('ly200.photo');?></strong></td>
			<td width="12%" nowrap><strong>科目</strong></td>
			<td width="42%" nowrap><strong><?=get_lang('ly200.name');?></strong></td>
			<td width="8%" nowrap><strong><?=get_lang('product.price');?></strong></td>
			<td width="8%" nowrap><strong><?=get_lang('ly200.qty');?></strong></td>
			<td width="12%" nowrap><strong><?=get_lang('ly200.time');?></strong></td>
		</tr>
		<?php for($i=0; $i<count($list_row); $i++){?>
		<tr align="center">
			<td nowrap><?=$start_row+$i+1;?></td>
			<td nowrap><a href="<?=$list_row[$i]['Url'];?>" target="_blank"><img src="<?=$list_row[$i]['PicPath_0'];?>" /></a></td>
			<td nowrap><a href="<?=$list_row[$i]['Url'];?>" target="_blank"><?=$db->get_value('product_category',"CateId= '{$list_row[$i]['CateId']}'",'Category');?></a></td>
			<td nowrap align="left" class="flh_150">
				<a href="<?=$list_row[$i]['Url'];?>" target="_blank"><?=$list_row[$i]['Name'];?></a><br />
				<?php if($order_product_weight==1){?><?=get_lang('product.weight');?>: <?=$list_row[$i]['Weight'];?> KG<br /><?php }?>
				<?php if($list_row[$i]['Color']){?><?=get_lang('product.color');?>: <?=$list_row[$i]['Color'];?><br /><?php }?>
				<?php if($list_row[$i]['Size']){?><?=get_lang('product.size');?>: <?=$list_row[$i]['Size'];?><br /><?php }?>
			</td>
			<td nowrap><?=get_lang('ly200.price_symbols').sprintf('%01.2f', $list_row[$i]['Price']);?></td>
			<td nowrap><?=$list_row[$i]['Qty'];?></td>
			<td nowrap><?=date(get_lang('ly200.time_format_full'), $list_row[$i]['AddTime']);?></td>
		</tr>
		<?php }?>
	</table>
</form>
<form method="get" class="turn_page_form" action="view.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "view.php?$query_string&detail_card=$detail_card&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="detail_card" type="hidden" value="<?=$detail_card;?>">
	<input name="MemberId" type="hidden" value="<?=$MemberId;?>">
</form>
<?php }elseif($detail_card==4){?>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
	<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
		<tr align="center" class="list_form_title">
			<td width="6%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
			<td width="14%" nowrap><strong><?=get_lang('orders.order_number');?></strong></td>
			<?php /*?><td width="10%" nowrap><strong><?=get_lang('orders.item_costs');?></strong></td><?php */?>
			<?php /*?><td width="12%" nowrap><strong><?=get_lang('orders.shipping_charges');?></strong></td><?php */?>
			<?php /*?><td width="7%" nowrap><strong><?=get_lang('payment_method.additional_fee');?></strong></td><?php */?>
			<td width="10%" nowrap><strong><?=get_lang('orders.grand_total');?></strong></td>
			<td width="13%" nowrap><strong><?=get_lang('ly200.time');?></strong></td>
			<td width="18%" nowrap><strong><?=get_lang('orders.order_status');?></strong></td>
			<td width="5%" nowrap><strong><?=get_lang('ly200.operation');?></strong></td>
		</tr>
		<?php for($i=0; $i<count($list_row); $i++){?>
		<tr align="center">
			<td nowrap><?=$start_row+$i+1;?></td>
			<td nowrap><?=$list_row[$i]['OId'];?></td>
			<?php /*?><td nowrap><?=get_lang('ly200.price_symbols').sprintf('%01.2f', $list_row[$i]['TotalPrice']);?></td><?php */?>
			<?php /*?><td nowrap><?=get_lang('ly200.price_symbols').sprintf('%01.2f', $list_row[$i]['ShippingPrice']);?></td><?php */?>
			<?php /*?><td nowrap><?=$list_row[$i]['PayAdditionalFee'];?>%</td><?php */?>
			<td nowrap><?=get_lang('ly200.price_symbols').sprintf('%01.2f', ($list_row[$i]['TotalPrice']+$list_row[$i]['ShippingPrice'])*($list_row[$i]['PayAdditionalFee']/100+1));?></td>
			<td nowrap><?=date(get_lang('ly200.time_format_full'), $list_row[$i]['OrderTime']);?></td>
			<td nowrap><?=$order_status_ary[$list_row[$i]['OrderStatus']];?></td>
			<td><a href="javascript:void(0);" onclick="this.blur(); parent.openWindows('win_orders', '<?=get_lang('orders.orders_manage');?>', 'orders/view.php?OrderId=<?=$list_row[$i]['OrderId'];?>');"><img src="../images/view.gif" alt="<?=get_lang('ly200.view');?>" /></a></td>
		</tr>
		<?php }?>
	</table>
</form>
<form method="get" class="turn_page_form" action="view.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "view.php?$query_string&detail_card=$detail_card&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="detail_card" type="hidden" value="<?=$detail_card;?>">
	<input name="MemberId" type="hidden" value="<?=$MemberId;?>">
</form>
<?php }elseif($detail_card==5){?>
<form name="list_form" id="list_form" class="list_form" method="post" action="index.php"> 
	<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
		<tr align="center" class="list_form_title">
			<td width="20%" nowrap><strong><?=get_lang('ly200.number');?></strong></td>
			<td width="30%" nowrap><strong><?=get_lang('member.login_time');?></strong></td>
			<td width="50%" nowrap><strong><?=get_lang('member.login_ip');?></strong></td>
		</tr>
		<?php
		for($i=0; $i<count($list_row); $i++){
			$list_row_area=ip_to_area($list_row[$i]['LoginIp']);
		?>
		<tr align="center">
			<td nowrap><?=$start_row+$i+1;?></td>
			<td nowrap><?=date(get_lang('ly200.time_format_full'), $list_row[$i]['LoginTime']);?></td>
			<td nowrap><?=htmlspecialchars($list_row[$i]['LoginIp']);?> [<?=$list_row_area['country'].$list_row_area['area'];?>]</td>
		</tr>
		<?php }?>
	</table>
</form>
<form method="get" class="turn_page_form" action="view.php" onsubmit="javascript:turn_page(this);">
	<?=turn_page($page, $total_pages, "view.php?$query_string&detail_card=$detail_card&page=", $row_count, get_lang('ly200.pre_page'), get_lang('ly200.next_page'));?>
	<?=get_lang('ly200.turn');?>:<input name="page" id="page" type="text" size="2" maxlength="5" class="form_input">&nbsp;<input name="submit" type="submit" class="form_button" value="<?=get_lang('ly200.turn');?>">
	<input name="total_pages" id="total_pages" type="hidden" value="<?=$total_pages;?>">
	<input name="detail_card" type="hidden" value="<?=$detail_card;?>">
	<input name="MemberId" type="hidden" value="<?=$MemberId;?>">
</form>
<?php }elseif($detail_card==6 && get_cfg('member.mod')){?>
<form method="post" name="act_form" id="act_form" class="act_form" action="view.php" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<tr>
		<td width="5%" nowrap><?=get_lang('admin.new_password');?>:</td>
		<td width="95%"><input name="NewPassword" type="password" value="" class="form_input" check="<?=get_lang('ly200.filled_out').get_lang('admin.new_password');?>!~*" size="25" maxlength="16"></td>
	</tr>
	<tr>
		<td nowrap><?=get_lang('admin.re_password');?>:</td>
		<td><input name="ReNewPassword" type="password" value="" class="form_input" check="<?=get_lang('ly200.filled_out').get_lang('admin.re_password');?>!~=NewPassword|<?=get_lang('admin.repwd_dif_pwd');?>*" size="25" maxlength="16"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="Submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><input type="hidden" name="MemberId" value="<?=$MemberId;?>" /><input type="hidden" name="data" value="mod_password" /></td>
	</tr>
</table>
</form>
<?php }elseif($detail_card==7){?>
<form method="post" name="act_form" id="act_form" class="act_form" action="view.php" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<tr>
		<td width="5%" nowrap><?=get_lang('member.member_holder.Holder_UserName');?>:</td>
		<td width="95%"><input name="Holder_UserName" type="text" value="<?=$holder_info['Holder_UserName']?>" class="form_input" size="25"></td>
	</tr>
	<tr>
		<td width="5%" nowrap><?=get_lang('member.member_holder.Holder_City');?>:</td>
		<td width="95%">
        	<select name="Holder_City">
            	<?php for($i=0,$ilen=count($city_ary);$i<$ilen;$i++){ ?>
            		<option value="<?=$city_ary[$i]['CId']?>"<?=$city_ary[$i]['CId']==$holder_info['Holder_City']?' selected="selected"':''?>><?=$city_ary[$i]['Color']?></option>
                <?php } ?>
            </select>
        </td>
	</tr>
	<tr>
		<td width="5%" nowrap><?=get_lang('member.member_holder.Holder_Bank');?>:</td>
		<td width="95%">
        	<select name="Holder_Bank">
            	<?php 
					$bank_row = $db->get_all('translate','1','LId,Name,LogoPath','MyOrder desc,LId asc');
					for($i=0,$ilen=count($bank_row);$i<$ilen;$i++){ 
				?>
            		<option value="<?=$bank_row[$i]['LId']?>"<?=$bank_row[$i]['LId']==$holder_info['Holder_Bank']?' selected="selected"':''?>><?=$bank_row[$i]['Name']?></option>
                <?php } ?>
            </select>
        </td>
	</tr>
	<tr>
		<td width="5%" nowrap><?=get_lang('member.member_holder.Holder_Detail');?>:</td>
		<td width="95%"><input name="Holder_Detail" type="text" value="<?=$holder_info['Holder_Detail']?>" class="form_input" size="25"></td>
	</tr>
	<tr>
		<td width="5%" nowrap><?=get_lang('member.member_holder.Holder_Num');?>:</td>
		<td width="95%"><input name="Holder_Num" type="text" value="<?=$holder_info['Holder_Num']?>" class="form_input" size="25"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="Submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><input type="hidden" name="MemberId" value="<?=$MemberId;?>" /><input type="hidden" name="data" value="mod_holder" /></td>
	</tr>
</table>
</form>
<?php
}else{
	js_location('index.php');
}
?>
<?php include('../../inc/manage/footer.php');?>