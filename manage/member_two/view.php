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
	$IsTeacher=(int)$_POST['IsTeacher'];
	$IDCE = (int)$_POST['IDCE'];
	$TCCE = (int)$_POST['TCCE'];
	$OTCE = (int)$_POST['OTCE'];
	$AId=(int)$_POST['AId'];
	$Level=$_POST['Level'];
	$T_age=$_POST['T_age'];

	$db->update('member', "MemberId='$MemberId'", array(
			'IsTeacher'		=>	$IsTeacher,
			'MemberLevel'	=>	$Level,
		)
	);
	//exit;
	if($IsTeacher){
		$db->update('product', "MemberId='$MemberId'", array(
				'SoldOut'		=>	0,
				'Identity'		=>	$IDCE,
				'Degree'		=>	$TCCE,
				'Certification'	=>	$OTCE,
			)
		);
		$db->update('member_apply',"MemberId='$MemberId'",array(
				'Identity'		=>	$IDCE,
				'Degree'		=>	$TCCE,
				'Certification'	=>	$OTCE,
		));
	}else{
		$db->update('product', "MemberId='$MemberId'", array(
				'SoldOut'		=>	1,
			)
		);
	}
	
	//
	if($db->get_one('member_ident',"MemberId='$MemberId'")){
		$db->update('member_ident', "MemberId='$MemberId'", array(
				'T_age'		=>	$T_age,
			)
		);
	}else{
		$db->insert('member_ident',array(
				'T_age'		=>	$T_age,
				'MemberId'	=>	$MemberId,
			)
		);
	}
	
	$db->update('member_apply', "AId='$AId'", array(
			'RegTime'		=>	$service_time,
			'Ischeck'		=>	1,
		)
	);
	
	save_manage_log('审核教师申请');
	js_location("index.php");
}

$AId =$_GET['AId'];
$where="AId = '$AId'";
$member_apply=$db->get_one('member_apply',$where);

$MemberId=(int)$_GET['MemberId'];
$where="MemberId='{$member_apply['MemberId']}'";
$member_row=$db->get_one('member', $where);
$member_ident_row=$db->get_one('member_ident',"MemberId = '{$member_apply['MemberId']}'");
$CE = $db->get_one('product',"MemberId = '{$member_apply['MemberId']}'",'Identity,Degree,Certification');

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('member_two.member_manage');?></a>&nbsp;-&gt;&nbsp;<a href="view.php?<?=$query_string;?>"><?=htmlspecialchars($member_row['FirstName'].' '.$member_row['LastName']);?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.view');?></div>
<div class="act_form">
	<div class="card_list">
		<div class="<?=$detail_card==0?'cur':'';?>"><a href="view.php?<?=$query_string;?>&detail_card=0">申请信息</a></div>
	</div>
</div>
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
			<td nowrap>手机号:</td>
			<td><?=htmlspecialchars($member_row['Phone']);?></td>
		</tr>
        <tr>
			<td nowrap>申请时间:</td>
			<td><?=date('Y-m-d',$member_apply['ApplyTime']);?></td>
		</tr>
		<tr>
			<td nowrap>申请科目:</td>
			<td><?=$db->get_value('product_color',"CId = '{$member_apply['CId']}'",'Color');?></td>
		</tr>
		<?php /*?><tr>
			<td nowrap>申请科目:</td>
			<td><?=$db->get_value('product_category',"CateId = '{$member_apply['CateId']}'",'Category');?></td>
		</tr><?php */?>
		<tr>
			<td nowrap>教龄:</td>
			<td><input type="text" class="form_input" value="<?=$member_ident_row['T_age'];?>" maxlength="11" name="T_age" /></td>
		</tr>
         <tr>
			<td nowrap>身份证:</td>
			<td>
				<span class="fl "><input type="checkbox" name="IDCE" value="1" <?=$CE['Identity']=='1'?'checked="checked"':'';  ?> ></span>
				<img class="fl" width="600" src="<?=$member_ident_row['Pic_Cer'];?>" />
				<div class="clear"></div>
			</td>
		</tr>
         <tr>
			<td nowrap>教师资格证:</td>
			<td>
				<span class="fl "><input type="checkbox" name="TCCE" value="1" <?=$CE['Degree']=='1'?'checked="checked"':'';  ?> ></span>
				<img class="fl" width="600" src="<?=$member_ident_row['Pic_Teach'];?>" />
				<div class="clear"></div>
			</td>
		</tr>
         <tr>
			<td nowrap>相关证书:</td>
			<td>
				<span class="fl "><input type="checkbox" name="OTCE" value="1" <?=$CE['Certification']=='1'?'checked="checked"':'';  ?> ></span>
				<img class="fl" width="600" src="<?=$member_ident_row['Pic_Other'];?>" />
				<div class="clear"></div>
			</td>
		</tr>
		<?php /*?><tr>
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
		</tr><?php */?>
        <tr>
            <td nowrap>审核是否通过:</td>
            <td>
                <select name="IsTeacher">
                    <option value="请选择">请选择</option>
                    <option value="1" <?=$member_row['IsTeacher']?'selected="selected"':''?> >通过</option>
                    <option value="0" <?=$member_row['IsTeacher']?'':'selected="selected"'?>>不通过</option>
                </select>
            </td>
		</tr>
        <tr>
            <td nowrap>教师会员级别:</td>
            <td>
            <?php $level_row=$db->get_limit('member_level',"1",'LId,Level','LId desc');?>
                <select name="Level">
                	<?php for($i=0;$i<count($level_row);$i++){?>
                    	<option value="<?=$level_row[$i]['LId']?>" <?=$member_row['MemberLevel']==$level_row[$i]['LId']?'selected="selected"':''?> ><?=$level_row[$i]['Level']?></option>
                    <?php }?>
                </select>
            </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="Submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><input type="hidden" name="MemberId" value="<?=$member_row['MemberId'];?>" /><input type="hidden" name="data" value="mod_profile" />&nbsp;&nbsp;<a href="index.php?<?=$query_string;?>" class="return"><?=get_lang('ly200.return');?></a>
            <input type="hidden" name="AId" value="<?=$AId?>"  />
            </td>
		</tr>
	</table>
</form>
<?php include('../../inc/manage/footer.php');?>