<?php
$query_string=query_string('act');
$cart_row=$db->get_all('shopping_cart', $where, '*', 'ProId desc, CId desc');
!$cart_row && js_location("$cart_url_cn?module=list");

foreach((array)$cart_row as $c_item){
	$course_str = @explode(',',trim($c_item['CourseStr'],','));
	$course_arr = array();
	foreach((array)$course_str as $key=>$item){
		$course_arr[]=@explode('|',$item);
	}
	$TimeStart=$TimeEnd=$Price=$Name=array();
	$product_course_price = $db->get_all('product_course_price',"ProId='{$c_item['ProId']}'",'*');
	foreach((array)$product_course_price as $item){
		$TimeStart[$item['PId']] = $item['TimeStart'];
		$TimeEnd[$item['PId']] = $item['TimeEnd'];
		for($c=1;$c<8;$c++){
			$Price[$item['PId']][$c]=$item['Price_'.$c];
			$Name[$item['PId']][$c]=$item['Name_'.$c];
		}
	}
	$len = count($course_arr);
	$price_all = array();
	for($c=0;$c<$len;$c++){
		$len_v = count($course_arr[$c]);
		$price_all[]=$Price[$course_arr[$c][0]][$course_arr[$c][1]];
	}
	$total_price+=array_sum($price_all)*$c_item['Qty'];
}

$order_product_weight==1 && $total_weight=$db->get_sum('shopping_cart', $where, 'Qty*Weight');	//商品总重量


if($_POST['data']=='cart_checkout'){
	$shipping_address['Title']=$member_info['Title'];
	$shipping_address['LastName']=$member_info['LastName'];
	$shipping_address['AddressLine1']=$member_info['Addresses'];
	$shipping_address['City']=$member_info['City'];
	$shipping_address['State']=$member_info['State'];
	$shipping_address['Country']=$member_info['Country'];
	$shipping_address['Phone']=$member_info['Phone'];
	
	$SId=(int)$_POST['SId'];	//送货方式
	$Comments=$_POST['Comments'];	//订单留言
	(!$shipping_address) && js_location("$cart_url_cn?module=checkout");	//提交数据不完整.....
	//-----------------------生成订单号------------------------//
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
			'ShippingLastName'		=>	addslashes($shipping_address['LastName']),
			'ShippingAddressLine1'	=>	addslashes($shipping_address['AddressLine1']),
			'ShippingCity'			=>	addslashes($shipping_address['City']),
			'ShippingState'			=>	addslashes($shipping_address['State']),
			'ShippingCountry'		=>	addslashes($shipping_address['Country']),
			'ShippingPhone'			=>	addslashes($shipping_address['Phone']),
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
	sendmail((int)$_SESSION['member_MemberId']?$_SESSION['member_Email']:$_POST['Email'], $member_info['LastName'], "感谢您的订单#{$OId}", $mail_contents);
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
                    	<strong>名称：</strong><?=htmlspecialchars($member_info['LastName']);?><br />
                        <strong>地址：</strong>
						<?=htmlspecialchars($member_info['Country']);?>
                        <?=htmlspecialchars($member_info['State']);?></strong>
                        <?=htmlspecialchars($member_info['City']);?>
                        <?=htmlspecialchars($member_info['Addresses']);?><br />
						<strong>手机号码: </strong><?=htmlspecialchars($member_info['Phone']);?>
					</div>
					<div class="q_link"><a href="<?=$member_url_cn;?>?module=profile">编辑地址</a></div>
				<?php }?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="blank15"></div>
        
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
					<td width="40%">课程信息</td>
					<td width="15%">单价</td>
					<td width="15%">数量</td>
					<td width="15%" class="last">总价</td>
				</tr>
				<?php
				$pro_count=0;
				for($i=0; $i<count($cart_row); $i++){
					$pro_count+=$cart_row[$i]['Qty'];
					$course_str = @explode(',',trim($cart_row[$i]['CourseStr'],','));
					$course_arr = array();
					foreach((array)$course_str as $key=>$item){
						$course_arr[]=@explode('|',$item);
					}
					$TimeStart=$TimeEnd=$Price=$Name=array();
					$product_course_price = $db->get_all('product_course_price',"ProId='{$cart_row[$i]['ProId']}'",'*');
					foreach((array)$product_course_price as $item){
						$TimeStart[$item['PId']] = $item['TimeStart'];
						$TimeEnd[$item['PId']] = $item['TimeEnd'];
						for($c=1;$c<8;$c++){
							$Price[$item['PId']][$c]=$item['Price_'.$c];
							$Name[$item['PId']][$c]=$item['Name_'.$c];
						}
					}
					$len = count($course_arr);
					$price_all = array();
					$c_str='';
					for($c=0;$c<$len;$c++){
						$len_v = count($course_arr[$c]);
						$price_all[]=$Price[$course_arr[$c][0]][$course_arr[$c][1]];
						$c_str.=$TimeStart[$course_arr[$c][0]].'--'.$TimeEnd[$course_arr[$c][0]].' 课程：'.$Name[$course_arr[$c][0]][$course_arr[$c][1]].' 价格：'.'<span class="c_red">'.iconv_price($Price[$course_arr[$c][0]][$course_arr[$c][1]]).'</span><br/>';
					}
					$item_price=array_sum($price_all)*$cart_row[$i]['Qty'];
				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<td align="left" style=" padding:10px;"><a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname" style="font-size:12px;"><?=$cart_row[$i]['Name'];?></a>
                    <br /><br />
                    <?=$c_str?$c_str:''?>
                    </td>
					<td><?=iconv_price(array_sum($price_all));?></td>
					<td><?=$cart_row[$i]['Qty'];?></td>
					<td><?=iconv_price($item_price);?></td>
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
					<div>课程总价:</div>
				</li>
				<?php /*?><?php if($order_discount>0){?>
					<li>
						<div class="price"><span><?=$order_discount*100;?>%</span></div>
						<div>折扣:</div>
					</li>
					<li>
						<div class="price"><span><?=iconv_price($total_price, 1);?></span><span id="discount_save_span"><?=iconv_price($total_price*$order_discount, 2);?></span></div>
						<div>Save:</div>
					</li>
				<?php }?><?php */?>
				<?php /*?><li>
					<div class="price"><span><?=iconv_price($total_price+$default_shipping_price, 1);?></span><span id="grand_total_span"><?=iconv_price((1-$order_discount)*$total_price+$default_shipping_price, 2);?></span></div>
					<div>支付价格:</div>
				</li><?php */?>
			</ul>	
			<div class="place_order_btn"><input type="image" name="imageField" src="/images/cart_sub_order.jpg" /></div>
            <input type="hidden" value="<?=str_replace('&#165;','',iconv_price($total_price));?>" id="post_total" name="post_total" />
		</div>
		<input type="hidden" name="AId" value="<?=$shipping_address['AId'];?>" />
		<input type="hidden" name="data" value="cart_checkout" />
	</form>
</div>