<a href="<?=get_domain().$member_url;?>?module=orders&OId=<?=$order_row['OId'];?>&act=detail" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;">查看订单详情点击这里.</a><br /><br />

<div style="border:1px solid #ddd; background:#f7f7f7; border-bottom:none; width:130px; height:26px; line-height:26px; text-align:center; font-size:12px; font-family:Arial;"><strong>Order Details</strong></div>
<div style="border:1px solid #ddd; padding:10px; font-size:12px; font-family:Arial;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="110" style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">订单号:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=$order_row['OId'];?></td>
	  </tr>
	  <tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">订单时间:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=date('d/m-Y H:i:s', $order_row['OrderTime']);?></td>
	  </tr>
	  <tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">订单状态:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=$order_status_ary[$order_row['OrderStatus']];?></td>
	  </tr>
	  <tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">支付方式:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=$order_row['PaymentMethod'];?></td>
	  </tr>
	  <?php /*?><tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">快递方式:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=$order_row['Express'];?></td>
	  </tr>
	  <?php if($order_row['OrderStatus']==5 || $order_row['OrderStatus']==6){?>
		  <tr>
			<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">快递号码:</td>
			<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=$order_row['TrackingNumber'];?> (<?=date('m/d-Y', $order_row['ShippingTime']);?>)</td>
		  </tr>
	  <?php }?><?php */?>
	  <tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">订单金额:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=iconv_price($order_row['TotalPrice']);?></td>
	  </tr>
	  <?php /*?><?php if($order_row['Discount']>0){?>
		  <tr>
			<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">折扣:</td>
			<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=$order_row['Discount']*100;?>%</td>
		  </tr>
		  <tr>
			<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">优惠:</td>
			<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=iconv_price($order_row['Discount']*$order_row['TotalPrice']);?></td>
		  </tr>
	  <?php }?>
	  <tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">运费:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=iconv_price($order_row['ShippingPrice']);?></td>
	  </tr><?php */?>
	  <?php /*?><tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">手续费:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?php if($order_row['PayAdditionalFee']!=0){?><?=iconv_price((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice']);?> * <?=$order_row['PayAdditionalFee'];?>% = <?=$order_row['PayAdditionalFee']<0?'-':'';?><?=iconv_price(((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'])*(abs($order_row['PayAdditionalFee'])/100));?><?php }else{?><?=iconv_price(0);?><?php }?></td>
	  </tr><?php */?>
	  <tr>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;">总价格:</td>
		<td style="padding:7px; border-bottom:1px solid #ddd; font-size:12px; font-family:Arial;"><?=iconv_price(((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'])*(1+$order_row['PayAdditionalFee']/100));?></td>
	  </tr>
	</table>
	<?php /*?><div style="margin:0px auto; clear:both; height:20px; font-size:1px; overflow:hidden;"></div>
	<div style="clear:both; zoom:1;">
		<div style="width:98%; float:left;">
			<div style="font-weight:bold; height:22px; line-height:22px; font-size:12px; font-family:Arial;">您的信息:</div>
			<div style="border:1px solid #ddd; background:#fdfdfd; padding:8px; line-height:160%; font-size:10px; font-family:Arial; font-size:12px;">
				<strong>名称：</strong><?=htmlspecialchars($order_row['ShippingLastName']);?><br />
                <strong>地址：</strong>
				<?=htmlspecialchars($order_row[$i]['ShippingCountry']);?>
                <?=htmlspecialchars($order_row[$i]['ShippingState']);?>
                <?=htmlspecialchars($order_row[$i]['ShippingCity']);?>
                <?=htmlspecialchars($order_row[$i]['ShippingAddressLine1']);?><br />
                <strong>手机号码: </strong><?=htmlspecialchars($order_row[$i]['ShippingPhone']);?>
			</div>
		</div>
        
		<div style="margin:0px auto; clear:both; height:0px; font-size:0px; overflow:hidden;"></div>
	</div><?php */?>
	<div style="margin:0px auto; clear:both; height:20px; font-size:1px; overflow:hidden;"></div>
	<?php /*?><div style="border-bottom:2px solid #ddd; height:24px; line-height:24px; font-weight:bold; font-family:Arial; font-size:12px;">配送方式:</div>
	<div style="line-height:150%; margin-top:5px; font-family:Arial;"><strong style="font-family:Arial; font-size:12px;"><?=htmlspecialchars($order_row['Express']);?></strong> ( <?php if($order_product_weight==1){?>包裹重量: <?=$order_row['TotalWeight'];?> KG, <?php }?>运费: <?=iconv_price($order_row['ShippingPrice']);?> )<?php if($order_product_weight==1){?><br /><div class="shipping_price">( 航运价格: 首重 <?=$order_row['FirstWeight'];?> KG : <?=iconv_price($order_row['FirstPrice']);?> / <?=$order_row['ExtWeight'];?> KG : <?=iconv_price($order_row['ExtPrice'])?> )</div><?php }?></div><?php */?>
	<div style="margin:0px auto; clear:both; height:20px; font-size:1px; overflow:hidden;"></div>
	<?php /*?><div style="border-bottom:2px solid #ddd; height:24px; line-height:24px; font-weight:bold; font-family:Arial; font-size:12px;">特别说明或评论:</div>
	<div style="line-height:180%; font-family:Arial; font-size:12px;"><?=format_text($order_row['Comments']);?></div>
	<div style="margin:0px auto; clear:both; height:20px; font-size:1px; overflow:hidden;"></div>
	<div style="border-bottom:2px solid #ddd; height:24px; line-height:24px; font-weight:bold; font-family:Arial; font-size:12px;">订单项目:</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #ddd; margin:8px 0;">
		<tr>
			<td width="14%" style="border-right:1px solid #ddd; height:28px; font-weight:bold; text-align:center; background:url(<?=get_domain();?>/images/lib/cart/tb_bg.gif); font-family:Arial; font-size:12px;">图像</td>
			<td width="50%" style="border-right:1px solid #ddd; height:28px; font-weight:bold; text-align:center; background:url(<?=get_domain();?>/images/lib/cart/tb_bg.gif); font-family:Arial; font-size:12px;">课程信息</td>
			<td width="12%" style="border-right:1px solid #ddd; height:28px; font-weight:bold; text-align:center; background:url(<?=get_domain();?>/images/lib/cart/tb_bg.gif); font-family:Arial; font-size:12px;">单价</td>
			<td width="12%" style="border-right:1px solid #ddd; height:28px; font-weight:bold; text-align:center; background:url(<?=get_domain();?>/images/lib/cart/tb_bg.gif); font-family:Arial; font-size:12px;">数量</td>
			<td width="12%" style="border-right:1px solid #ddd; height:28px; font-weight:bold; text-align:center; background:url(<?=get_domain();?>/images/lib/cart/tb_bg.gif); font-family:Arial; font-size:12px; border-right:none;">小计</td>
		</tr>
		<?php
		$pro_count=0;
		for($i=0; $i<count($item_row); $i++){
			$pro_count+=$item_row[$i]['Qty'];
			$course_str = @explode(',',trim($item_row[$i]['CourseStr'],','));
			$course_arr = array();
			foreach((array)$course_str as $key=>$item){
				$course_arr[]=@explode('|',$item);
			}
			$TimeStart=$TimeEnd=$Price=$Name=array();
			$product_course_price = $db->get_all('product_course_price',"ProId='{$item_row[$i]['ProId']}'",'*');
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
				$c_str.=$TimeStart[$course_arr[$c][0]].'--'.$TimeEnd[$course_arr[$c][0]].' 课程：'.$Name[$course_arr[$c][0]][$course_arr[$c][1]].' 价格：'.'<span class="c_red">'.get_lang('ly200.price_symbols').$Price[$course_arr[$c][0]][$course_arr[$c][1]].'</span><br/>';
			}
			$item_price=array_sum($price_all)*$item_row[$i]['Qty'];
			$total_price+=$item_price;
		?>
		<tr align="center">
			<td valign="top" style="padding:7px 5px; border-top:1px solid #ddd;"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" style="border:1px solid #ccc; padding:0; background:#fff;"><a href="<?=get_domain().$item_row[$i]['Url'];?>" target="_blank"><img src="<?=get_domain().$item_row[$i]['PicPath'];?>" /></a></td></tr></table></td>
			<td align="left" style="line-height:150%; font-size:10px; font-family:Arial; padding:7px 5px; border-top:1px solid #ddd;">
				<a href="<?=get_domain().$item_row[$i]['Url'];?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:10px;"><?=$item_row[$i]['Name'];?></a><br />
                <?=$c_str?$c_str:'';?>
				备注： <?=htmlspecialchars($item_row[$i]['Remark']);?>
			</td>
			<td style="font-family:Arial; font-size:10px; padding:7px 5px; border-top:1px solid #ddd;"><?=iconv_price(array_sum($price_all));?></td>
			<td style="font-family:Arial; font-size:10px; padding:7px 5px; border-top:1px solid #ddd;"><?=$item_row[$i]['Qty'];?></td>
			<td style="font-family:Arial; font-size:10px; padding:7px 5px; border-top:1px solid #ddd;"><?=iconv_price($item_price);?></td>
		</tr>
		<?php }?>
		<tr>
			<td colspan="3" style="height:26px; background:#efefef; text-align:center; color:#B50C08; font-size:11px; font-weight:bold; font-family:Arial;">&nbsp;</td>
			<td style="height:26px; background:#efefef; text-align:center; color:#B50C08; font-size:11px; font-weight:bold; font-family:Arial;"><?=$pro_count;?></td>
			<td style="height:26px; background:#efefef; text-align:center; color:#B50C08; font-size:11px; font-weight:bold; font-family:Arial;"><?=iconv_price($order_row['TotalPrice']);?></td>
		</tr>
	</table><?php */?>
</div><br /><br />