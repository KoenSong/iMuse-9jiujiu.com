<?php
$query_string=query_string();
$OId=$_GET['OId'];
$status=$db->get_value('orders',"OId = '$OId'",'OrderStatus');
if($status=='2' || $status=='3'){
	header('Location: /account.php?module=orders&act=prelist');
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

$order_row=$db->get_one('orders', "$where and OId='$OId'");
!$order_row && js_location("$cart_url_cn?module=list");
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
		$row=array('0'=>array('Name'=>'支付宝'),1=>array('Name'=>'银联在线','Select_bank'=>1));
		for($i=0; $i<count($row); $i++){
			//$checked=(($order_row['PaymentMethod']=='' && $i==0) || $order_row['PaymentMethod']==$row[$i]['Name'])?'checked':'';
		?>
			<input type="radio" name="payment_method" <?=$i==0?'checked':''?> onclick="isbank(<?=$i?>)" value="<?=$row[$i]['Name'];?>" /> <?=$row[$i]['Name'];?>
		<?php }?>
		<br /><br />
        <div class="online_payment" style="display:none;">
        <div class="hls_bank_sel" id="bank_sel">
				<div id="order-check-typelist" class="paytype-list">
					<div class="bank-area bank-self-pay" name="online_pay">
						<ul class="bank-list" style="margin-left: 17px; display: block;margin-top:20px;">
							<li class="item">
								<input type="radio" class="radio" value="ICBC" id="bank-type-ICBC" name="paytype">
								<label title="中国工商银行" for="bank-type-ICBC" class="bank bank--icbc">中国工商银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="ABC" id="bank-type-ABC" name="paytype">
								<label title="中国农业银行" for="bank-type-ABC" class="bank bank--abc">中国农业银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="CCB" id="bank-type-CCB" name="paytype">
								<label title="中国建设银行" for="bank-type-CCB" class="bank bank--ccb">中国建设银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="CMB" id="bank-type-CMB" name="paytype">
								<label title="招商银行" for="bank-type-CMB" class="bank bank--cmb">招商银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="BOC" id="bank-type-BCOM" name="paytype">
								<label title="中国银行" for="bank-type-BCOM" class="bank bank--bcom">中国银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="BCOM" id="bank-type-1020" name="paytype">
								<label title="交通银行" for="bank-type-1020" class="bank bank--boc">交通银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="PSBC" id="bank-type-PSBC-DEBIT" name="paytype">
								<label title="中国邮政储蓄银行" for="bank-type-PSBC-DEBIT" class="bank bank--post">中国邮政储蓄银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="SPDB" id="bank-type-HZCBB2C" name="paytype">
								<label title="浦发银行" for="bank-type-HZCBB2C" class="bank bank--hzcb">浦发银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="GDB" id="bank-type-GDB" name="paytype">
								<label title="广东发展银行" for="bank-type-GDB" class="bank bank--gdb">广东发展银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="CMBC" id="bank-type-CMBC" name="paytype">
								<label title="中国民生银行" for="bank-type-CMBC" class="bank bank--cmbc">中国民生银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="CIB" id="bank-type-CIB" name="paytype">
								<label title="兴业银行" for="bank-type-CIB" class="bank bank--cib">兴业银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="PAB" id="bank-type-SPABANK" name="paytype">
								<label title="平安银行" for="bank-type-SPABANK" class="bank bank--pab">平安银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="SDB" id="bank-type-SPDB" name="paytype">
								<label title="深圳发展银行" for="bank-type-SPDB" class="bank bank--sdb">深圳发展银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="CITIC" id="bank-type-CITIC" name="paytype">
								<label title="中信银行" for="bank-type-CITIC" class="bank bank--citic">中信银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="CEB" id="bank-type-CEB" name="paytype">
								<label title="中国光大银行" for="bank-type-CEB" class="bank bank--ceb">中国光大银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="BEA" id="bank-type-BEA" name="paytype">
								<label title="东亚银行" for="bank-type-BEA" class="bank bank--bea">东亚银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="HXB" id="bank-type-HXB" name="paytype">
								<label title="华夏银行" for="bank-type-HXB" class="bank bank--hxb">华夏银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="SRCB" id="bank-type-SHRCB" name="paytype">
								<label title="上海农商银行" for="bank-type-SHRCB" class="bank bank--shrcc">上海农商银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="BJRCB" id="bank-type-BJRCB" name="paytype">
								<label title="北京农商银行" for="bank-type-BJRCB" class="bank bank--bjrcb">北京农商银行</label>
							</li>
							
<!--							<li class="item">
								<input type="radio" class="radio" value="alipay-gzrcc" id="bank-type-gzrcc" name="paytype">
								<label title="广州市农村信用合作社" for="bank-type-gzrcc" class="bank bank--gzrcc">广州市农村信用合作社</label>
							</li>-->
							<li class="item">
								<input type="radio" class="radio" value="BOB" id="bank-type-BOB" name="paytype">
								<label title="北京银行" for="bank-type-BOB" class="bank bank--bob">北京银行</label>
							</li>
			
									
							<li class="item">
								<input type="radio" class="radio" value="SHB" id="bank-type-SHB" name="paytype">
								<label title="上海银行" for="bank-type-SHB" class="bank bank--shb">上海银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="GZCB" id="bank-type-GZCB" name="paytype">
								<label title="广州银行" for="bank-type-GZCB" class="bank bank--gzcb">广州银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="HZB" id="bank-type-HZBB2C" name="paytype">
								<label title="杭州银行" for="bank-type-HZBB2C" class="bank bank--hzb">杭州银行</label>
							</li>
							
							<li class="item">
								<input type="radio" class="radio" value="NBCB" id="bank-type-NBCB" name="paytype">
								<label title="宁波银行" for="bank-type-NBCB" class="bank bank--nbcb">宁波银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="CBHB" id="bank-type-CBHB" name="paytype">
								<label title="渤海银行" for="bank-type-CBHB" class="bank bank--cbhb">渤海银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="NJCB" id="bank-type-NJCB" name="paytype">
								<label title="南京银行" for="bank-type-NJCB" class="bank bank--njcb">南京银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="CZB" id="bank-type-CZB" name="paytype">
								<label title="浙商银行" for="bank-type-CZB" class="bank bank--czb">浙商银行</label>
							</li>
							<li class="item">
								<input type="radio" class="radio" value="HSB" id="bank-type-HSB" name="paytype">
								<label title="徽商银行" for="bank-type-HSB" class="bank bank--hsb">徽商银行</label>
							</li>
					 </ul>
					</div>
				
				</div>

			</div>
        </div>
		<input type="hidden" name="OId" value="<?=$OId;?>" />
		<input type="hidden" name="module" value="payment" />
		<input type="submit" name="submit" value="付款" class="pay_now" />
	</form>
</div>
</div>
<script>
	function isbank(i){
		if(i==1){
			$('.online_payment').show();
		}else{
			$('.online_payment').hide();
		}
	}
</script>
