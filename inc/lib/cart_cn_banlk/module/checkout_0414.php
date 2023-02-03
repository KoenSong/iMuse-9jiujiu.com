<?php
$query_string=query_string('act');
$cart_row=$db->get_all('shopping_cart', $where, '*', 'ProId desc, CId desc');
!$cart_row && js_location("$cart_url_cn?module=list");

$total_price=$db->get_sum('shopping_cart', $where, 'Qty*Price');

$order_product_weight==1 && $total_weight=$db->get_sum('shopping_cart', $where, 'Qty*Weight');	//商品总重量

if((int)$_SESSION['member_MemberId']){
	$AId=(int)$_GET['AId']?(int)$_GET['AId']:(int)$_POST['AId'];
	if($AId){
		$shipping_address=$db->get_one('member_address_book', "MemberId='{$_SESSION['member_MemberId']}' and AddressType=0 and AId='$AId'");
	}else{
		$shipping_address=$db->get_one('member_address_book', "MemberId='{$_SESSION['member_MemberId']}' and AddressType=0 and IsDefault=1");
	}
	$billing_address=$db->get_one('member_address_book', "MemberId='{$_SESSION['member_MemberId']}' and AddressType=1");
}elseif($_POST['data']=='cart_checkout'){
	$shipping_address['Title']=stripslashes($_POST['ShippingTitle']);
	$shipping_address['FirstName']=stripslashes($_POST['ShippingFirstName']);
	$shipping_address['LastName']=stripslashes($_POST['ShippingLastName']);
	$shipping_address['AddressLine1']=stripslashes($_POST['ShippingAddressLine1']);
	$shipping_address['AddressLine2']=stripslashes($_POST['ShippingAddressLine2']);
	$shipping_address['City']=stripslashes($_POST['ShippingCity']);
	$shipping_address['State']=stripslashes($_POST['ShippingState']);
	$shipping_address['Country']=stripslashes($_POST['ShippingCountry']);
	$shipping_address['PostalCode']=stripslashes($_POST['ShippingPostalCode']);
	$shipping_address['Phone']=stripslashes($_POST['ShippingPhone']);
}

if($_POST['data']=='cart_checkout'){
	$SId=(int)$_POST['SId'];	//送货方式
	$Comments=$_POST['Comments'];	//订单留言
	//(!$SId || !$shipping_address || !$billing_address) && js_location("$cart_url_cn?module=checkout");	//提交数据不完整.....
	(!$shipping_address) && js_location("$cart_url_cn?module=checkout");	//提交数据不完整.....
	//---------------------------------------------------------------------------------------生成订单号------------------------------------------------------------------------
	while(1){
		$OId=date('YmdHis', $service_time).rand(10, 99);
		if(!$db->get_row_count('orders', "OId='$OId'")){
			break;
		}
	}
	//---------------------------------------------------------------------------------------生成订单号------------------------------------------------------------------------
	$payment_method_row=$db->get_one('payment_method', 'IsInvocation=1', 'Name, AdditionalFee', 'MyOrder desc, PId asc');
	
	$db->insert('orders', array(
			'OId'					=>	$OId,
			'MemberId'				=>	$_SESSION['member_MemberId'],
			'SessionId'				=>	$cart_SessionId,
			'Discount'				=>	$order_discount,
			'Email'					=>	(int)$_SESSION['member_MemberId']?addslashes($_SESSION['member_Email']):$_POST['Email'],
			'TotalPrice'			=>	(float)$total_price,
			'PayAdditionalFee'		=>	(float)$payment_method_row['AdditionalFee'],
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
			'Express'				=>	'0',//addslashes($db->get_value('shipping', "SId='$SId'", 'Express')),
			'TotalWeight'			=>	(float)$total_weight,
			'Comments'				=>	$Comments,
			'PaymentMethod'			=>	addslashes($payment_method_row['Name']),
			'OrderTime'				=>	$service_time,
			'OrderStatus'			=>	(int)$order_default_status,
		)
	);
	
	$img_dir=mk_dir('/images/orders/'.date('Y_m/', $service_time).$OId.'/');
	$OrderId=$db->get_insert_id();

	update_orders_shipping_info($OrderId, '', 1);
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
				'Remark'	=>	addslashes($cart_row[$i]['Remark']),
				'CourseStr'	=>	addslashes($cart_row[$i]['CourseStr']),
			)
		);
	}
	
	$db->delete('shopping_cart', "MemberId='{$_SESSION['member_MemberId']}'");	//删除购物车的物品
	include($site_root_path.'/inc/lib/mail/order_create.php');
	include($site_root_path.'/inc/lib/mail/template.php');
	sendmail((int)$_SESSION['member_MemberId']?$_SESSION['member_Email']:$_POST['Email'], $shipping_address['FirstName'].' '.$shipping_address['LastName'], "感谢您的订单#{$OId}", $mail_contents);
	js_location("$cart_url?module=place&OId=$OId");
}
?>
<div id="lib_cart_station">结算</div>

<div id="lib_cart_checkout">

    <div class="cart_info">
        <div class="blank19"></div>
        
        <div class="cart_pic">
            查看购物车
        </div>
        <div class="cart_pic cur">
            填写核对信息单
        </div>
        <div class="cart_pic">
            提交订单
        </div>
        
        <div class="blank25"></div>
    </div>

	<form action="<?=$cart_url_cn.'?'.$query_string;?>" method="post" name="cart_checkout_form" OnSubmit="return checkForm(this);" target="_blank">
		<div class="title">请您填写订单信息：</div>
		<div class="blank20"></div>
		<div class="address">
			<div class="shipping_address">
				<div class="item_title">您的地址:</div>
				<div class="check_address">请检查您的地址</div>
				<?php if((int)$_SESSION['member_MemberId']){?>
					<div class="address_info">
                    	<strong>名称：</strong><?=htmlspecialchars($shipping_address['LastName']);?><br />
                        <strong>地址：</strong>
						<?=htmlspecialchars($shipping_address['Country']);?>
                        <?=htmlspecialchars($shipping_address['State']);?> (邮政编码: <strong><?=htmlspecialchars($shipping_address['PostalCode']);?></strong>)
                        <?=htmlspecialchars($shipping_address['City']);?>
                        <?=htmlspecialchars($shipping_address['AddressLine1']);?><br />
						<strong>手机号码: </strong><?=htmlspecialchars($shipping_address['Phone']);?>
					</div>
					<div class="q_link"><a href="<?=$member_url_cn;?>?module=addressbook&checkout=1&AId=<?=$shipping_address['AId'];?>&act=upd_shipping_address">编辑地址</a><a href="<?=$member_url_cn;?>?module=addressbook&checkout=1">选择其他地址</a><a href="<?=$member_url_cn;?>?module=addressbook&checkout=1&act=add_shipping_address">增加地址</a></div>
				<?php }else{?>
					<div id="lib_member_address_book">
						<div class="address" style="width:410px;">
							<div class="item lib_member_item_card" style="width:90%; margin:0;">
								<div class="rows">您的Email: <font class="fc_red">*</font>&nbsp;&nbsp;<input name="Email" value="" type="text" class="form_input" check="Your Email is required!~email|Your Email entered doesn't match with confirm Email value!*" size="42" maxlength="100"></div>
								<div class="rows">
									<div class="fr">姓名: <font class="fc_red">*</font><br /><input name="ShippingLastName" id="ShippingLastName" value="" type="text" class="form_input" check="请输入姓名!~*" size="22" maxlength="20"></div>
									<div class="clear"></div>
								</div>
								<div class="rows">地址: <font class="fc_red">*</font><br /><input name="ShippingAddressLine1" id="ShippingAddressLine1" value="" type="text" class="form_input" check="请输入地址1!~*" size="57" maxlength="200"></div>
								<div class="rows">
									<div class="fl">城市: <font class="fc_red">*</font><br /><input name="ShippingCity" id="ShippingCity" value="" type="text" class="form_input" check="请输入城市!~*" size="25" maxlength="50"></div>
									<div class="fr">省份: <font class="fc_red">*</font><br /><?=str_replace('<select', "<select id='ShippingProvince' onchange='cart_change_shipping_country(this.value, \"$cart_url_cn\");'", ouput_table_to_select('province', 'Province', 'Province', 'ShippingProvince', 'PId asc', 0, 1, '', '', '请选择省份', '请选择省份!~*'));?></div>
									<div class="clear"></div>
								</div>
								<div class="rows">
									<div class="fl">邮政编码: <font class="fc_red">*</font><br /><input name="ShippingPostalCode" id="ShippingPostalCode" value="" type="text" class="form_input" check="请输入邮政编码!~*" size="10" maxlength="10"></div>
									<div class="fr">电话: <font class="fc_red">*</font><br /><input name="ShippingPhone" id="ShippingPhone" value="" type="text" class="form_input" check="请输入电话!~*" size="22" maxlength="20" /></div>
									<div class="clear"></div>
								</div>
								
							</div>
						</div>
					</div>
					<iframe id="get_shipping_methods_iframe" src="about:blank"></iframe>
				<?php }?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="blank15"></div>
        
        
		<?php /*?><div class="shipping_method">
			<div class="item_title">选择运输方式:</div>
			<div id="shipping_method_list">
				<?php
				if((int)$_SESSION['member_MemberId']){
					$shipping_method_row=$db->get_all('shipping', '1', '*', 'MyOrder desc, SId asc');
					$CId=$db->get_value('country', 'Country="'.addslashes($shipping_address['Country']).'"', 'CId');
					
					for($i=0; $i<count($shipping_method_row); $i++){
						if($shipping_method_row[$i]['FreeShippingInvocation']==1 && $total_price>=$shipping_method_row[$i]['FreeShippingPrice']){
							$shipping_price=0;
						}else{
							$shipping_price_row=$db->get_one('shipping_price', "SId='{$shipping_method_row[$i]['SId']}' and CId='$CId'");
							if($order_product_weight==1){
								$ExtWeight=$total_weight>$shipping_price_row['FirstWeight']?$total_weight-$shipping_price_row['FirstWeight']:0;	//超出的重量
								$shipping_price=(float)(@ceil($ExtWeight/$shipping_price_row['ExtWeight'])*$shipping_price_row['ExtPrice']+$shipping_price_row['FirstPrice']);
							}else{
								$shipping_price=$shipping_price_row['FirstPrice'];
							}
						}
						if($i==0){
							$SId=$shipping_method_row[$i]['SId'];
							$default_shipping_price=$shipping_price;
						}
					?>
						<div class="shipping">
							<div class="ft">
								<div class="radio"><input type="radio" name="_SId" value="<?=$shipping_method_row[$i]['SId'];?>" <?=$i==0?'checked':'';?> onclick="cart_change_shipping_method(<?=iconv_price($shipping_price, 2);?>, this.value);" /></div>
								<div class="txt"><?=$shipping_method_row[$i]['Express'];?> / <?=$shipping_price?iconv_price($shipping_price):'<font class="free_shipping">Free Shipping</font>';?><?php if($order_product_weight==1){?>&nbsp;&nbsp;&nbsp;( 商品重量: <?=$total_weight;?> KG )<?php }?></div>
								<div class="clear"></div>
							</div>
							<div class="explanation"><?=$shipping_method_row[$i]['Explanation'];?><?php if($order_product_weight==1 && $shipping_price){?>&nbsp;&nbsp;&nbsp;( <strong>运费:</strong> 首重 <?=$shipping_price_row['FirstWeight'];?> KG : <?=iconv_price($shipping_price_row['FirstPrice']);?> / <?=$shipping_price_row['ExtWeight'];?> KG : <?=iconv_price($shipping_price_row['ExtPrice'])?> )<?php }?></div>
						</div>
					<?php }?>
				<?php }else{?>
					<div class="blank6"></div>
					请您选择一个城市！
				<?php }?>
			</div>
		</div>
		<div class="blank15"></div><?php */?>
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
					<?php //<td width="15%">编号</td> ?>
					<td width="40%">课程信息</td>
					<td width="15%">单价</td>
					<td width="15%">数量</td>
					<td width="15%" class="last">总价</td>
				</tr>
				<?php
				$pro_count=0;
				for($i=0; $i<count($cart_row); $i++){
					$pro_count+=$cart_row[$i]['Qty'];
				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<?php /*<td><a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname"><?=$cart_row[$i]['ItemNumber'];?></a>&nbsp;</td> */?>
					<td align="left" style=" padding:10px;"><a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname" style="font-size:12px;"><?=$cart_row[$i]['Name'];?></a>
                    <br /><br />
                    <?=$PriceTxt?$PriceTxt:''?>
                    <?=$ServiceTxt?$ServiceTxt:''?>
                    </td>
					<td><?=iconv_price($cart_row[$i]['Price']);?></td>
					<td><?=$cart_row[$i]['Qty'];?></td>
					<td><?=iconv_price(($cart_row[$i]['Price']+$PriceItem+$ServiceItem)*$cart_row[$i]['Qty']);?></td>
				</tr>
				<?php }?>
				<tr class="total">
					<td colspan="2"></td>
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
                
				<?php /*?><li>
					<div class="price"><span><?=iconv_price($default_shipping_price, 1);?></span><span id="shipping_charges_span"><?=iconv_price($default_shipping_price, 2);?></span></div>
					<div>运费:</div>
				</li><?php */?>
				<li>
					<div class="price"><span><?=iconv_price($total_price+$default_shipping_price, 1);?></span><span id="grand_total_span"><?=iconv_price((1-$order_discount)*$total_price+$default_shipping_price, 2);?></span></div>
					<div>支付价格:</div>
				</li>
			</ul>	
			<div class="place_order_btn"><input type="image" name="imageField" src="/images/cart_sub_order.jpg" /></div>
            <input type="hidden" value="<?=str_replace('&#165;','',iconv_price($total_price));?>" id="post_total" name="post_total" />
		</div>
		<?php /*?><input type="text" name="SId" class="SId" id="shiping_method_SId" value="<?=$SId;?>" check="Please Choose Shipping Method!~*" /><?php */?>
		<input type="hidden" name="AId" value="<?=$shipping_address['AId'];?>" />
		<input type="hidden" name="data" value="cart_checkout" />
	</form>
</div>