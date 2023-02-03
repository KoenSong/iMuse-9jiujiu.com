<form method="post" name="act_form" id="act_form" class="act_form" action="view.php" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
	<tr> 
		<td width="5%" nowrap><?=get_lang('orders.order_number');?>:</td>
		<td width="95%"><?=htmlspecialchars($order_row['OId']);?></td>
	</tr>
	<tr>
		<td nowrap><?=get_lang('ly200.full_name');?>:</td>
		<td><?=htmlspecialchars($order_row['ShippingTitle'].' '.$order_row['ShippingFirstName'].' '.$order_row['ShippingLastName']);?></td>
	</tr>
	<?php /*?><tr>
		<td nowrap><?=get_lang('ly200.email');?>:</td>
		<td><?=htmlspecialchars($order_row['Email']);?><?php if($order_row['MemberId'] && $menu['member']){?>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="this.blur(); parent.openWindows('win_member', '<?=get_lang('member.member_manage');?>', 'member/view.php?MemberId=<?=$order_row['MemberId'];?>');" class="red"><?=get_lang('orders.view_member_info');?></a><?php }?><?php if($menu['send_mail']){?>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="this.blur(); parent.openWindows('win_send_mail', '<?=get_lang('send_mail.send_mail_system');?>', 'send_mail/index.php?email=<?=urlencode($order_row['Email'].'/'.$order_row['ShippingFirstName'].' '.$order_row['ShippingLastName']);?>');" class="red"><?=get_lang('send_mail.send');?></a><?php }?></td>
	</tr><?php */?>
	<tr>
		<td nowrap><?=get_lang('orders.item_costs');?>:</td>
		<td><?=get_lang('ly200.price_symbols');?><?php if(get_cfg('orders.mod')){?><input type="text" name="TotalPrice" id="TotalPriceInput" onkeyup="set_number(this, 1); mod_order_price();" onpaste="set_number(this, 1); mod_order_price();" value="<?=$order_row['TotalPrice'];?>" size="5" maxlength="10" class="form_input" /><?php }else{?><?=$order_row['TotalPrice'];?><?php }?></td>
	</tr>
	<?php /*?><tr>
		<td nowrap><?=get_lang('orders.discount');?>:</td>
		<td><input type="text" name="Discount" id="DiscountInput" onkeyup="set_number(this, 1); mod_order_price();" onpaste="set_number(this, 1); mod_order_price();" value="<?=(1-$order_row['Discount']);?>" size="5" maxlength="10" class="form_input" /> ( <?=get_lang('orders.discount_remark');?> )</td>
	</tr>
	<tr>
		<td nowrap><?=get_lang('orders.shipping_charges');?>:</td>
		<td><?=get_lang('ly200.price_symbols');?><?php if(get_cfg('orders.mod')){?><input type="text" name="ShippingPrice" id="ShippingPriceInput" onkeyup="set_number(this, 1); mod_order_price();" onpaste="set_number(this, 1); mod_order_price();" value="<?=$order_row['ShippingPrice'];?>" size="5" maxlength="10" class="form_input" /><?php }else{?><?=$order_row['ShippingPrice'];?><?php }?></td>
	</tr>
	<tr>
		<td nowrap><?=get_lang('payment_method.additional_fee');?>:</td>
		<td>
			<?php if(get_cfg('orders.mod')){?><input type="text" name="PayAdditionalFee" id="PayAdditionalFeeInput" onkeyup="set_number(this, 1); mod_order_price();" onpaste="set_number(this, 1); mod_order_price();" value="<?=$order_row['PayAdditionalFee'];?>" size="5" maxlength="10" class="form_input" /><?php }else{?><?=$order_row['PayAdditionalFee'];?><?php }?>%&nbsp;&nbsp;&nbsp;
			<span id="order_fee_value">(<?=get_lang('ly200.price_symbols').$order_row['TotalPrice'];?> * <?=(1-$order_row['Discount']);?> + <?=get_lang('ly200.price_symbols').$order_row['ShippingPrice'];?>) * <?=$order_row['PayAdditionalFee'];?>% = <?=get_lang('ly200.price_symbols').sprintf('%01.2f', ((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'])*($order_row['PayAdditionalFee']/100));?></span>
		</td>
	</tr><?php */?>
	<tr>
		<td nowrap><?=get_lang('orders.grand_total');?>:</td>
		<td id="total_price_value"><?=get_lang('ly200.price_symbols').sprintf('%01.2f', ((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'])*(1+$order_row['PayAdditionalFee']/100));?></td>
	</tr>
    <tr>
		<td nowrap>学生情况:</td>
		<td>
        	<table border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
                <tr>
                    <td>请选择开始时间:</td>
                    <td width="18%"><?=$order_row['StartTime']?></td>
                </tr>
                <tr>
                    <td>请选择结束时间:</td>
                    <td width="18%"><?=$order_row['EndTime']?></td>
                </tr>
                <tr>
                	<td>备注</td>
                    <td width="80%"><?=$order_row['Comments']?></td>
                </tr>
            </table>
        </td>
	</tr>
    
    <tr>
		<td nowrap>老师信息:</td>
		<td>
        	<table border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
            	<tr>
                	<td>姓名:</td>
                    <td width="18%"><?=$order_row['ProName']?></td>
                </tr>
                <tr>
                	<td>所教科目:</td>
                    <td width="18%"><?=$db->get_value('product_category',"CateId = '{$order_row['CateId']}'",'Category')?></td>
                </tr>
                <tr>
                	<td>课时数:</td>
                    <td width="18%"><?=$db->get_row_count('order_twos_product_list',"OrderId = '{$order_row['OrderId']}'")?></td>
                </tr>
            </table>
        </td>
	</tr>
    
    <tr>
    	<td>
        	确认约课
        </td>
        <td>
            <select name="Tmakesure_0">
                <option value="0">未确定</option>
                <option value="1" <?= $order_row['Tmakesure_0']==1?'selected':''?>>已确定</option>
            </select>
        </td>
    </tr>
	<tr>
		<td nowrap><?=get_lang('orders.payment_method');?>:</td>
		<td><?=$order_row['PaymentMethod'];?></td>
	</tr>
	<?=$payment_info_detail;?>
	<?php /*?><tr>
		<td nowrap><?=get_lang('orders.shipping_method');?>:</td>
		<td><?=$upd_express_link;?></td>
	</tr>
	<?php if($order_row['OrderStatus']==5 || $order_row['OrderStatus']==6){?>
		<tr>
			<td nowrap><?=get_lang('orders.tracking_number');?>:</td>
			<td><?=$order_row['TrackingNumber'];?></td>
		</tr>
		<tr>
			<td nowrap><?=get_lang('orders.shipping_time');?>:</td>
			<td><?=date(get_lang('ly200.time_format_ymd'), $order_row['ShippingTime']);?></td>
		</tr>
	<?php }?><?php */?>
	<tr>
		<td nowrap><?=get_lang('orders.order_status');?>:</td>
		<td><?=$order_status_ary[$order_row['OrderStatus']];?></td>
	</tr>
	<?php if($order_row['OrderStatus']==7){?>
		<tr>
			<td nowrap><?=get_lang('orders.cancel_reason');?>:</td>
			<td class="flh_150"><?=format_text($order_row['CancelReason']);?></td>
		</tr>
	<?php }?>
	<?php /*?><tr>
		<td nowrap><?=get_lang('orders.orders_comments');?>:</td>
		<td class="flh_150"><?=format_text($order_row['Comments']);?></td>
	</tr><?php */?>
	<tr>
		<td nowrap><?=get_lang('ly200.time');?>:</td>
		<td><?=date(get_lang('ly200.time_format_full'), $order_row['OrderTime']);?></td>
	</tr>
	<?php if(get_cfg('orders.mod')){?>
		<tr>
			<td>&nbsp;</td>
			<td><input type="Submit" name="submit" value="<?=get_lang('ly200.mod');?>" class="form_button"><input type="hidden" name="OrderId" value="<?=$OrderId;?>" /><input type="hidden" name="module" value="<?=$module;?>" /><input type="hidden" name="act" value="mod_order_price" /></td>
		</tr>
	<?php }?>
</table>
</form>