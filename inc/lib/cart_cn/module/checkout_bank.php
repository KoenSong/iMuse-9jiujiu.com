<?php
$query_string=query_string('act');

$cart_row=$db->get_all('shopping_cart', $where, '*', 'ProId desc, CId desc');
!$cart_row && js_location("$cart_url_cn?module=list");

$total_price=$db->get_sum('shopping_cart', $where, 'Qty*Price');	//商品总价格
$order_product_weight==1 && $total_weight=$db->get_sum('shopping_cart', $where, 'Qty*Weight');	//商品总重量
if((int)$_SESSION['member_MemberId']){
$shipping_address['FirstName']=$_SESSION['member_FirstName'];
$shipping_address['LastName']=$_SESSION['member_LastName'];
}

if($_POST['data']=='cart_checkout'){
	//$SId=(int)$_POST['SId'];	//送货方式
	$Comments=$_POST['Comments'];	//订单留言
	$AllTime=$_POST['AllTime'];		//总时间
	
	//(!$SId || !$shipping_address || !$billing_address) && js_location("$cart_url_cn?module=checkout");	//提交数据不完整.....
	
	//---------------------------------------------------------------------------------------生成订单号------------------------------------------------------------------------
	while(1){
		$OId=date('YmdHis', $service_time).rand(10, 99);
		if(!$db->get_row_count('orders', "OId='$OId'")){
			break;
		}
	}
	//---------------------------------------------------------------------------------------生成订单号------------------------------------------------------------------------
	
	//$payment_method_row=$db->get_one('payment_method', 'IsInvocation=1', 'Name, AdditionalFee', 'MyOrder desc, PId asc');
	
	$db->insert('orders', array(
			'OId'					=>	$OId,
			'MemberId'				=>	$_SESSION['member_MemberId'],
			'SessionId'				=>	$cart_SessionId,
			//'Discount'				=>	$order_discount,
			'Email'					=>	(int)$_SESSION['member_MemberId']?addslashes($_SESSION['member_Email']):$_POST['Email'],
			'TotalPrice'			=>	(float)$total_price,
			'ShippingFirstName'		=>	addslashes($shipping_address['FirstName']),
			'ShippingLastName'		=>	addslashes($shipping_address['LastName']),
			/*'PayAdditionalFee'		=>	(float)$payment_method_row['AdditionalFee'],
			'ShippingTitle'			=>	addslashes($shipping_address['Title']),
			'ShippingFirstName'		=>	addslashes($shipping_address['FirstName']),
			'ShippingLastName'		=>	addslashes($shipping_address['LastName']),
			'ShippingAddressLine1'	=>	addslashes($shipping_address['AddressLine1']),
			'ShippingAddressLine2'	=>	addslashes($shipping_address['AddressLine2']),
			'ShippingCity'			=>	addslashes($shipping_address['City']),
			'ShippingState'			=>	addslashes($shipping_address['State']),
			'ShippingCountry'		=>	addslashes($shipping_address['Country']),
			'ShippingPostalCode'	=>	addslashes($shipping_address['PostalCode']),
			'ShippingPhone'			=>	addslashes($shipping_address['Phone']),
			'BillingTitle'			=>	addslashes($billing_address['Title']),
			'BillingFirstName'		=>	addslashes($billing_address['FirstName']),
			'BillingLastName'		=>	addslashes($billing_address['LastName']),
			'BillingAddressLine1'	=>	addslashes($billing_address['AddressLine1']),
			'BillingAddressLine2'	=>	addslashes($billing_address['AddressLine2']),
			'BillingCity'			=>	addslashes($billing_address['City']),
			'BillingState'			=>	addslashes($billing_address['State']),
			'BillingCountry'		=>	addslashes($billing_address['Country']),
			'BillingPostalCode'		=>	addslashes($billing_address['PostalCode']),
			'BillingPhone'			=>	addslashes($billing_address['Phone']),*/
			//'Express'				=>	addslashes($db->get_value('shipping', "SId='$SId'", 'Express')),
			//'TotalWeight'			=>	(float)$total_weight,
			'Comments'				=>	$Comments,
			'PaymentMethod'			=>	'会员支付',
			'OrderTime'				=>	$service_time,
			'OrderStatus'			=>	1,
			'AllTime'				=>	$AllTime,
		)
	);
	
	$img_dir=mk_dir('/images/orders/'.date('Y_m/', $service_time).$OId.'/');
	$OrderId=$db->get_insert_id();
	
	//update_orders_shipping_info($OrderId, '', 1);
	
	for($i=0; $i<count($cart_row); $i++){
		$img_path=$img_dir.basename($cart_row[$i]['PicPath']);
		@copy($site_root_path.$cart_row[$i]['PicPath'], $site_root_path.$img_path);
		
		$db->insert('orders_product_list', array(
				'OrderId'	=>	$OrderId,
				'ProId'		=>	(int)$cart_row[$i]['ProId'],
				'CateId'	=>	(int)$cart_row[$i]['CateId'],
				'Color'		=>	addslashes($cart_row[$i]['Color']),
				'Size'		=>	addslashes($cart_row[$i]['Size']),
				'Name'		=>	addslashes($cart_row[$i]['Name']),
				'ItemNumber'=>	addslashes($cart_row[$i]['ItemNumber']),
				'Weight'	=>	(float)$cart_row[$i]['Weight'],
				'PicPath'	=>	addslashes($img_path),
				'Price'		=>	(float)$cart_row[$i]['Price'],
				'Qty'		=>	(int)$cart_row[$i]['Qty'],
				'Url'		=>	addslashes($cart_row[$i]['Url']),
				'Remark'	=>	addslashes($cart_row[$i]['Remark'])
			)
		);
	}
	
	$db->delete('shopping_cart', "MemberId='{$_SESSION['member_MemberId']}'");	//删除购物车的物品
	
	include($site_root_path.'/inc/lib/mail/order_create.php');
	include($site_root_path.'/inc/lib/mail/template.php');
	sendmail((int)$_SESSION['member_MemberId']?$_SESSION['member_Email']:$_POST['Email'], $shipping_address['FirstName'].' '.$shipping_address['LastName'], "你的订单--{$OId}", $mail_contents);
	
	js_location("$cart_url_cn?module=payment&OId=$OId");
}
?>
<div id="lib_cart_station"><a href="/">首页</a> &gt; <a href="<?=$cart_url_cn;?>?module=list">购物车</a> &gt; 结算</div>
<div id="lib_cart_guid"><img src="/images/lib/cart/guid_2_cn.gif" /></div>
<div id="lib_cart_checkout">
	<form action="<?php /*?>/inc/lib/create_partner_trade_by_buyer_php_utf8/alipayto.php<?php */?><?=$cart_url_cn.'?'.$query_string;?>" method="post" name="cart_checkout_form" OnSubmit="return checkForm(this);" target="_blank">
		<div class="comments">
			<div class="item_title">附加留言或特别的说明:</div>
			<div class="info">如果您有其他留言，请填写：</div>
			<div><textarea class="form_area" name="Comments"></textarea></div>
		</div>
		<div class="blank15"></div>
		<div class="payment_method">
			<div class="item_title">订单查看:</div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="item_list_table">
				<tr class="tb_title">
					<td width="15%">图片</td>
                    <td width="10%">科目</td>
					<td width="20%">老师名称</td>
                    <td width="10%">课时长/h</td>
					<td width="15%">单价</td>
					<td width="15%">数量</td>
					<td width="15%" class="last">总价</td>
				</tr>
				<?php
				$pro_count=0;
				$pro_time=0;
				for($i=0; $i<count($cart_row); $i++){
					$pro_count+=$cart_row[$i]['Qty'];
					$pro_time+=$cart_row[$i]['AllTime'];
				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<td><a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname"><img width="91" src="<?=$cart_row[$i]['PicPath'];?>" /></a>&nbsp;</td>
                    <td><?=$Category[$cart_row[$i]['CateId']]['Category']?>&nbsp;</td>
					<td align="left"><a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname" style="font-size:12px;"><?=$cart_row[$i]['Name'];?></a></td>
                    <td><?=$pro_time?></td>
					<td><?=iconv_price($cart_row[$i]['Price']);?></td>
					<td><?=$cart_row[$i]['Qty'];?></td>
					<td><?=iconv_price($cart_row[$i]['Price']*$cart_row[$i]['Qty']);?></td>
				</tr>
				<?php }?>
				<tr class="total">
					<td colspan="5"></td>
					<td><?=$pro_count;?></td>
					<td><?=iconv_price($total_price);?></td>
				</tr>
			</table>
		</div>
		<div class="blank15"></div>
		<div class="place_order">
			<ul>
				<li>
					<div class="price"><span><?=iconv_price($total_price, 1);?></span><span id="subtotal_span"><?=iconv_price($total_price, 2);?></span></div>
					<div>商品总价:</div>
				</li>
				<?php if($order_discount>0){?>
					<li>
						<div class="price"><span><?=$order_discount*100;?>%</span></div>
						<div>折扣:</div>
					</li>
					<li>
						<div class="price"><span><?=iconv_price($total_price, 1);?></span><span id="discount_save_span"><?=iconv_price($total_price*$order_discount, 2);?></span></div>
						<div>Save:</div>
					</li>
				<?php }?>
                <li>
					<div class="price"><span><?=$pro_time?>h</span></div>
					<div>课时长:</div>
				</li>
				<?php /*?><li>
					<div class="price"><span><?=iconv_price($default_shipping_price, 1);?></span><span id="shipping_charges_span"><?=iconv_price($default_shipping_price, 2);?></span></div>
					<div>运费:</div>
				</li><?php */?>
                <li>
					<div class="price"><span><?=$pro_count?></span></div>
					<div>课程数:</div>
				</li>
				<li>
					<div class="price"><span><?=iconv_price($total_price+$default_shipping_price, 1);?></span><span id="grand_total_span"><?=iconv_price((1-$order_discount)*$total_price+$default_shipping_price, 2);?></span></div>
					<div>支付价格:</div>
				</li>
			</ul>	
			<div class="place_order_btn"><input type="image" name="imageField" src="/images/lib/cart/btn_place_cn.gif" /></div>
            <input type="hidden" value="<?=str_replace('&#165;','',iconv_price($total_price));?>" id="post_total" name="post_total" />
		</div>
		<input type="hidden" name="AId" value="<?=$shipping_address['AId'];?>" />
        <input type="hidden" name="AllTime" value="<?=$pro_time?>" />
		<input type="hidden" name="data" value="cart_checkout" />
	</form>
</div>