<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('withdraw');

if($_POST){
	$MId = (int)$_POST['MId'];
	$Status = (int)$_POST['Status'];
	$query_string = $_POST['query_string'];
	$db->update('member_withdraw',"MId='$MId'",array(
			'Status'	=>  $Status
		)
	);
	save_manage_log('修改会员提现状态');
	
	header("Location: index.php?$query_string");
	exit;
}

$MId=(int)$_GET['MId'];
$query_string=query_string('MId');

$withdraw_row=$db->get_one('member_withdraw', "MId='$MId'");
$cart_row=$db->get_one('member_holder',"MemberId = '{$withdraw_row['MemberId']}'");
$bank_row = $db->get_all('translate','1','LId,Name,LogoPath','MyOrder desc,LId asc');
for($i=0,$ilen=count($bank_row);$i<$ilen;$i++){
	$bank_ary[$bank_row[$i]['LId']] = $bank_row[$i];
}
//var_dump($cart_row);

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('withdraw.withdraw_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.view');?></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="view.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<tr>
		<td width="5%" nowrap>开户信息:</td>
		<td width="95%">
        	<table>
            	<tr>
                	<td width="5%" nowrap>开号名称</td>
                    <td width="95%"><?=$cart_row['Holder_UserName']?></td>
                </tr>
                <tr>
                	<td>开户城市</td>
                    <td><?=$db->get_value('product_color',"CId = '{$cart_row['Holder_City']}'",'Color');?></td>
                </tr>
                <tr>
                	<td>银行</td>
                    <td><?=$db->get_value('translate',"LId = '{$cart_row['Holder_Bank']}'",'Name');?></td>
                </tr>
                <tr>
                	<td>开户信息</td>
                    <td><?=$cart_row['Holder_Detail']?></td>
                </tr>
                <tr>
                	<td>卡号</td>
                    <td><?=$cart_row['Holder_Num']?></td>
                </tr>
                <tr>
                	<td>会员ID</td>
                    <td><?php echo sprintf('%08s',$cart_row['MemberId'])?></td>
                </tr>
                <tr>
                	<td>会员金额:</td>
                    <td><?php echo $db->get_value('member',"MemberId = '{$withdraw_row['MemberId']}'",'Account_Price')?></td>
                </tr>
            </table>
        </td>
	</tr>
    <tr>
		<td nowrap>提现金额:</td>
		<td>
        	<?=$withdraw_row['Price']?>
        </td>
	</tr>
	<tr>
		<td nowrap><?=get_lang('withdraw.status');?>:</td>
		<td>
        	<select name="Status">
            <?php for($i=0,$ilen=count($withdraw_ary);$i<$ilen;$i++){ ?>
            	<option value="<?=$i?>"<?=$i==$withdraw_row['Status']?' selected="selected"':''?>><?=$withdraw_ary[$i]?></option>
            <?php } ?>
            </select>
        </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
        	<a href="index.php?<?=$query_string;?>" class="return_1"><?=get_lang('ly200.return');?></a>
			<?php if(get_cfg('withdraw.mod')){?><input type="submit" value="<?=get_lang('withdraw.mod');?>" name="submit" class="form_button">
            <input type="hidden" name="query_string" value="<?=$query_string;?>">
            <input type="hidden" name="MId" value="<?=$MId;?>"><?php }?>
		</td>
	</tr>
</table>
</form>
<?php include('../../inc/manage/footer.php');?>