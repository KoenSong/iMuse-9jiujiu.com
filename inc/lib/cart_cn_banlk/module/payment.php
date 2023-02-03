<?php
$query_string=query_string();
$OId=$_GET['OId'];

$order_row=$db->get_one('orders', "$where and OId='$OId'");
!$order_row && js_location("$cart_url_cn?module=list");
($order_row['OrderStatus']!=1 && $order_row['OrderStatus']!=3) && js_location("$cart_url_cn?module=complete&OId=$OId");

$info_of_sender=$info_of_sender_1=$db->get_one('orders_payment_info', "OrderId='{$order_row['OrderId']}'");

if($_POST['data']=='make_payment'){
	$FirstName=$_POST['FirstName'];
	$LastName=$_POST['LastName'];
	$SentMoney=(float)$_POST['SentMoney'];
	$MTCNNumber=$_POST['MTCNNumber'];
	$Currency=$_POST['Currency'];
	$Country=$_POST['Country'];
	$SentTime=$_POST['SentTime'];
	$BankTransactionNumber=$_POST['BankTransactionNumber'];
	$Contents=$_POST['Contents'];
	
	$data=array(
		'OrderId'				=>	(int)$order_row['OrderId'],
		'FirstName'				=>	$FirstName,
		'LastName'				=>	$LastName,
		'SentMoney'				=>	$SentMoney,
		'MTCNNumber'			=>	$MTCNNumber,
		'Currency'				=>	$Currency,
		'Country'				=>	$Country,
		'SentTime'				=>	$SentTime,
		'BankTransactionNumber'	=>	$BankTransactionNumber,
		'Contents'				=>	$Contents,
		'PostTime'				=>	$service_time
	);
	
	if($info_of_sender){
		$db->update('orders_payment_info', "OrderId='{$order_row['OrderId']}'", $data);
	}else{
		$db->insert('orders_payment_info', $data);
	}
	
	$db->update('orders', "OId='$OId'", array(
			'OrderStatus'	=>	2
		)
	);
	
	$order_row['OrderStatus']=2;	//改订单状态，发邮件用，不需要再次查询数据库
	include($site_root_path.'/inc/lib/mail/order_payment.php');
	include($site_root_path.'/inc/lib/mail/template.php');
	sendmail($order_row['Email'], $order_row['FirstName'].' '.$order_row['LastName'], '我们从您收到的付款', $mail_contents);
	
	js_location("$cart_url_cn?module=complete&OId=$OId");
}

$info_of_sender['FirstName']=='' && $info_of_sender['FirstName']=$_SESSION['member_FirstName'];
$info_of_sender['LastName']=='' && $info_of_sender['LastName']=$_SESSION['member_LastName'];
$info_of_sender['Currency']=='' && $info_of_sender['Currency']=($_SESSION['Currency']?$_SESSION['Currency']:$mCfg['ExchangeRate']['Default']);
$info_of_sender['Country']=='' && $info_of_sender['Country']=$order_row['ShippingCountry'];
$info_of_sender['SentTime']=='' && $info_of_sender['SentTime']=date('m/d/Y', $service_time);

$payment_method=$db->get_all('payment_method', 'IsInvocation=1', '*', 'MyOrder desc, PId asc');
$grand_price=(1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'];	//订单总价
?>
<script language="javascript" src="/js/date.js"></script>
<div id="lib_cart_station">付款</div>

<div id="lib_order_payment">
	<div class="order_info" style="font-size:12px;">订单号:<?=$OId;?>&nbsp;&nbsp;&nbsp;<em style="font-size:12px;">订单日期:<?=date('m/d/Y H:i:s', $order_row['OrderTime']);?></em></div>
	<div class="blank12"></div>
	<div><strong>请选择付款方式:</strong></div>
	<div class="payment">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="250" valign="top">
				<?php
				$default_method=0;
				for($i=0; $i<count($payment_method); $i++){
					$order_row['PaymentMethod']==$payment_method[$i]['Name'] && $default_method=$i;
				?>
					<a href="javascript:void(0);" id="payment_method_a_<?=$i;?>" class="payment_method" onclick="this.blur(); change_payment_method(<?=$i;?>, <?=$payment_method[$i]['PId'];?>, <?=count($payment_method);?>, '<?=$cart_url_cn;?>', '<?=$OId;?>');"><img src="<?=$payment_method[$i]['LogoPath'];?>" align="absmiddle" /><?php if($payment_method[$i]['AdditionalFee']!=0){?><span class="<?=$payment_method[$i]['AdditionalFee']>0?'add':'less';?>">(<?=($payment_method[$i]['AdditionalFee']>0?'+':'').$payment_method[$i]['AdditionalFee'];?>% Fee)</span><?php }?></a>
				<?php }?>
			</td>
			<td valign="top" class="payment_info" height="380">
				<?php
				$total_price=array();
				for($i=0; $i<count($payment_method); $i++){
					$total_price=iconv_price($grand_price+$grand_price*$payment_method[$i]['AdditionalFee']/100, 2);
					if((!$info_of_sender_1 || $order_row['PaymentMethod']!=$payment_method[$i]['Name'])){
						$info_of_sender['SentMoney']=$total_price;
					}else{
						$info_of_sender['SentMoney']=$info_of_sender_1['SentMoney'];
					}
				?>
					<div class="contents" id="payment_info_contents_<?=$i;?>">
						<div class="title">使用 <?=$payment_method[$i]['Name'];?> 付款</div>
						<div class="tips" style="font-size:12px;">应支付金额: <span><?=iconv_price($grand_price);?></span><?php if($payment_method[$i]['AdditionalFee']!=0){?> <?=$payment_method[$i]['AdditionalFee']>=0?'+':'-';?> <span><?=iconv_price($grand_price*abs($payment_method[$i]['AdditionalFee'])/100);?></span> (额外的手续费) = <span><?=iconv_price(0, 1).$total_price;?></span><?php }?></div>
						<div class="txt"><?=$payment_method[$i]['Description'];?></div>
						<div class="ext">
						<?php if($payment_method[$i]['PId']==1){?>
							<a href="/inc/lib/gateway/index.php?gateway=Paypal&OId=<?=$OId;?>" class="paypal_button" target="_blank">继续付款 &gt;&gt;</a>
							<div class="tips" style="font-size:12px;">如果您使用paypal支付不成功，请使用Visa/Master信用卡付款。</div>
						<?php }elseif($payment_method[$i]['PId']==2){?>
							<div class="tips">如果您在下面的国家，您可以使用在线汇款。 <a href="http://www.westernunion.com/" target="_blank">在线支付 &gt;&gt;</a><br />国家: Australia, Austria, Belgium, Canada, France, Germany, Ireland, Italy, Netherlands, New Zealand, Norway, Portugal, Spain, Sweden, Switzerland, United Kingdom, United States</div>
							<form action="<?=$cart_url_cn.'?'.$query_string;?>" method="post" name="make_payment_form" OnSubmit="return checkForm(this);">
								<div class="sender_title"><strong><?=$payment_method[$i]['Name'];?> info of Sender:</strong></div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sender_info">
									<tr>
										<td width="10%" nowrap>姓氏: <font class="fc_red">*</font></td>
										<td width="30%" nowrap><input name="FirstName" type="text" value="<?=htmlspecialchars($info_of_sender['FirstName']);?>" check="First Name is required!~*" class="form_input" maxlength="20" /></td>
										<td width="10%" nowrap>名字: <font class="fc_red">*</font></td>
										<td width="50%" nowrap><input name="LastName" type="text" value="<?=htmlspecialchars($info_of_sender['LastName']);?>" check="Last Name is required!~*" class="form_input" maxlength="20" /></td>
									</tr>
									<tr>
										<td nowrap>金额: <font class="fc_red">*</font></td>
										<td nowrap><input name="SentMoney" type="text" value="<?=htmlspecialchars($info_of_sender['SentMoney']);?>" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);" check="Sent Money is required!~*" class="form_input" maxlength="10" /></td>
										<td nowrap>MTCN# No.: <font class="fc_red">*</font></td>
										<td nowrap><input name="MTCNNumber" type="text" value="<?=htmlspecialchars($info_of_sender['MTCNNumber']);?>" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" check="MTCN# No. is required!~10f|MTCN# No. must be 10 Arab Number!*" class="form_input" maxlength="10" /> <span>(10个数字)</span></td>
									</tr>
									<tr>
										<td nowrap>货币: <font class="fc_red">*</font></td>
										<td nowrap><?=exchange_rate_select('Currency', $info_of_sender['Currency']);?></td>
										<td nowrap>国家: <font class="fc_red">*</font></td>
										<td nowrap><?=ouput_table_to_select('country', 'Country', 'Country', 'Country', 'Country asc, CId asc', 0, 1, $info_of_sender['Country'], '', 'Please select Country', 'Please select Country!~*');?></td>
									</tr>
									<tr>
										<td>内容:</td>
										<td colspan="3"><textarea name="Contents" class="form_area contents"><?=htmlspecialchars($info_of_sender['Contents']);?></textarea><br /><span id="Contents_tips"></span></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="3"><input type="submit" name="submit" value="现在完成付款" class="form_button form_button_130" /></td>
									</tr>
								</table>
								<input type="hidden" name="data" value="make_payment" />
							</form>
						<?php }elseif($payment_method[$i]['PId']==3){?>
							<div class="tips">如何通过via MoneyGram付款？<a href="https://www.moneygram.com/" target="_blank">请点击这里 &gt;&gt;</a></div>
							<form action="<?=$cart_url_cn.'?'.$query_string;?>" method="post" name="make_payment_form" OnSubmit="return checkForm(this);">
								<div class="sender_title"><strong><?=$payment_method[$i]['Name'];?> info of Sender:</strong></div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sender_info">
									<tr>
										<td width="10%" nowrap>姓氏: <font class="fc_red">*</font></td>
										<td width="30%" nowrap><input name="FirstName" type="text" value="<?=htmlspecialchars($info_of_sender['FirstName']);?>" check="First Name is required!~*" class="form_input" maxlength="20" /></td>
										<td width="10%" nowrap>名字: <font class="fc_red">*</font></td>
										<td width="50%" nowrap><input name="LastName" type="text" value="<?=htmlspecialchars($info_of_sender['LastName']);?>" check="Last Name is required!~*" class="form_input" maxlength="20" /></td>
									</tr>
									<tr>
										<td nowrap>金额: <font class="fc_red">*</font></td>
										<td nowrap><input name="SentMoney" type="text" value="<?=htmlspecialchars($info_of_sender['SentMoney']);?>" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);" check="Sent Money is required!~*" class="form_input" maxlength="10" /></td>
										<td nowrap>MTCN# No.: <font class="fc_red">*</font></td>
										<td nowrap><input name="MTCNNumber" type="text" value="<?=htmlspecialchars($info_of_sender['MTCNNumber']);?>" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" check="MTCN# No. is required!~8f|MTCN# No. must be 8 Arab Number!*" class="form_input" maxlength="8" /> <span>(8个数字)</span></td>
									</tr>
									<tr>
										<td nowrap>货币: <font class="fc_red">*</font></td>
										<td nowrap><?=exchange_rate_select('Currency', $info_of_sender['Currency']);?></td>
										<td nowrap>国家: <font class="fc_red">*</font></td>
										<td nowrap><?=ouput_table_to_select('country', 'Country', 'Country', 'Country', 'Country asc, CId asc', 0, 1, $info_of_sender['Country'], '', 'Please select Country', 'Please select Country!~*');?></td>
									</tr>
									<tr>
										<td>内容:</td>
										<td colspan="3"><textarea name="Contents" class="form_area contents"><?=htmlspecialchars($info_of_sender['Contents']);?></textarea><br /><span id="Contents_tips"></span></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="3"><input type="submit" name="submit" value="现在完成付款" class="form_button form_button_130" /></td>
									</tr>
								</table>
								<input type="hidden" name="data" value="make_payment" />
							</form>
						<?php }elseif($payment_method[$i]['PId']==4){?>
							<div class="tips">如果您对付款有疑问，可与我们联系。</div>
							<form action="<?=$cart_url_cn.'?'.$query_string;?>" method="post" name="make_payment_form" OnSubmit="return checkForm(this);">
								<div class="sender_title"><strong><?=$payment_method[$i]['Name'];?> info of Sender:</strong></div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sender_info">
									<tr>
										<td width="10%" nowrap>付款时间: <font class="fc_red">*</font></td>
										<td width="30%" nowrap><input name="SentTime" type="text" onclick="SelectDate(this);" value="<?=htmlspecialchars($info_of_sender['SentTime']);?>" check="Sent Time is required!~*" class="form_input" maxlength="10" /></td>
										<td width="10%" nowrap>银行交易号: <font class="fc_red">*</font></td>
										<td width="50%" nowrap><input name="BankTransactionNumber" type="text" value="<?=htmlspecialchars($info_of_sender['BankTransactionNumber']);?>" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" check="Bank Transaction No. is required!~*" class="form_input" maxlength="20" /></td>
									</tr>
									<tr>
										<td nowrap>金额: <font class="fc_red">*</font></td>
										<td nowrap><input name="SentMoney" type="text" value="<?=htmlspecialchars($info_of_sender['SentMoney']);?>" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);" check="Sent Money is required!~*" class="form_input" maxlength="10" /></td>
										<td nowrap>货币: <font class="fc_red">*</font></td>
										<td nowrap><?=exchange_rate_select('Currency', $info_of_sender['Currency']);?></td>
									</tr>
									<tr>
									</tr>
									<tr>
										<td>内容:</td>
										<td colspan="3"><textarea name="Contents" class="form_area contents"><?=htmlspecialchars($info_of_sender['Contents']);?></textarea><br /><span id="Contents_tips"></span></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="3"><input type="submit" name="submit" value="现在完成付款" class="form_button form_button_130" /></td>
									</tr>
								</table>
								<input type="hidden" name="data" value="make_payment" />
							</form>
							<?php }else if($payment_method[$i]['PId']==5){?>
							<a href="/inc/lib/gateway/index.php?gateway=zhifubao&OId=<?=$OId;?>" class="paypal_button" target="_blank">继续付款 &gt;&gt;</a>
							<div class="tips" style="font-size:12px;">如果您使用支付宝支付不成功，请使用Visa/Master信用卡付款。</div>
							<?php }?>
						</div>
					</div>
				<?php }?>
			</td>
		  </tr>
		</table>
	</div>
    <style type="text/css">
	.address_info strong{font-size:12px !important;}
	</style>
	<div class="address">
		<div class="shipping_address">
			<div class="item_title">您的收货地址:</div>
            <div class="address_info">
                <strong>收件人：</strong><?=htmlspecialchars($order_row['ShippingLastName']);?><br />
                <strong>收货地址：</strong>
                <?=htmlspecialchars($order_row['ShippingCountry']);?>
                <?=htmlspecialchars($order_row['ShippingState']);?> (邮政编码: <strong><?=htmlspecialchars($order_row['ShippingPostalCode']);?></strong>)
                <?=htmlspecialchars($order_row['ShippingCity']);?>
                <?=htmlspecialchars($order_row['ShippingAddressLine1']);?><br />
                <strong>手机号码: </strong><?=htmlspecialchars($order_row['ShippingPhone']);?>
            </div>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<script language="javascript">change_payment_method(<?=$default_method;?>, 0, <?=count($payment_method);?>, '<?=$cart_url_cn;?>', '<?=$OId;?>');</script>