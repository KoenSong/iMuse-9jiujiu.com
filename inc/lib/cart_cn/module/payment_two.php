<?php
$query_string=query_string();
$OId=$_GET['OId'];
$status=$db->get_value('order_twos',"OId = '$OId'",'OrderStatus');
if($status=='2' || $status=='3'){
	header('Location: /account.php?module=orders&act=list');
	exit;
}
//付款
if($_GET['submit']){
	if($_GET['payment_method']=='支付宝'){
	
		js_location("/inc/lib/payment/index.php?payment_method=支付宝&OId={$OId}");
	
	}elseif($_GET['payment_method']=='银联在线'){
		$paytype=$_GET['paytype'];
		js_location("/inc/lib/payment/index.php?payment_method=银联在线&OId={$OId}&paytype={$paytype}");
	}elseif($_GET['payment_method']=='支付宝2'){
		js_location("/inc/lib/payment/index.php?payment_method=支付宝2&OId={$OId}");	
	}
}

$order_row=$db->get_one('order_twos', "$where and OId='$OId'");
!$order_row && js_location("/");
($order_row['OrderStatus']!=1 && $order_row['OrderStatus']!=3) && js_location("$cart_url_cn?module=complete&OId=$OId");

$grand_price=(1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'];	//订单总价
?>
<script language="javascript" src="/js/date.js"></script>
<div id="lib_cart_station"><a href="/">首页</a> &gt; <a href="<?=$member_url_cn;?>?module=orders&OId=<?=$OId;?>&act=detail">订单号#<?=$OId;?></a> &gt; 付款</div>
<div id="lib_cart_guid"><img src="/images/lib/cart/guid_3_cn.gif" /></div>
<div id="lib_order_payment">
	<div class="order_info" style="font-size:12px;">订单号:<?=$OId;?>&nbsp;&nbsp;&nbsp;<em style="font-size:12px;">订单日期:<?=date('m/d/Y H:i:s', $order_row['OrderTime']);?></em></div>
	<div class="blank12"></div>
	<div><strong>请选择付款方式:</strong></div>
	<div id="lib_cart_complete">
	<div class="ok"></div>
	<table width="800" border="0" cellpadding="8" cellspacing="1" bgcolor="#dddddd">
		<tr bgcolor="#f0f0f0" align="center">
			<td width="20%"><strong>订单号</strong></td>
			<td width="20%"><strong>需支付金额（元）</strong></td>
			<?php /*?><td width="60%"><strong>收货人信息</strong></td><?php */?>
		</tr>
		<tr bgcolor="#ffffff" align="center">
			<td>
				<?php if($order_row['MemberId']){?>
					<a href="/account.php?module=orders&OId=<?=$OId;?>&act=detail&Status=0" target="_blank"><?=$OId;?></a>
				<?php }else{?>
					<?=$OId;?>
				<?php }?>
			</td>
			<td><?=iconv_price($order_row['TotalPrice'])?></td>
		</tr>
	</table>
	<br /><br />
	<form action="/cart.php?module=payment" method="get" target="_blank">
		<?php
		//$row=array('0'=>array('Name'=>'支付宝'),'1'=>array('Name'=>'会员付款'));
		$row=array('0'=>array('Name'=>'支付宝'));
		for($i=0; $i<count($row); $i++){
			//$checked=(($order_row['PaymentMethod']=='' && $i==0) || $order_row['PaymentMethod']==$row[$i]['Name'])?'checked':'';
		?>
			<input type="radio" name="payment_method"  value="<?=$row[$i]['Name'];?>" checked /> <?=$row[$i]['Name'];?>&nbsp;&nbsp;&nbsp;
		<?php }?>
		<br /><br />
		<input type="hidden" name="OId" value="<?=$OId;?>" />
		<input type="hidden" name="module" value="payment" />
		<input type="submit" name="submit" value="付款" class="pay_now" />
	</form>
</div>
</div>
