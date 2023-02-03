<?php
$query_string=query_string('act');

if($_POST['data']=='cart_list'){
	for($i=0; $i<count($_POST['CId']); $i++){
		$_CId=(int)$_POST['CId'][$i];
		$_ProId=(int)$_POST['ProId'][$i];
		$_Qty=abs((int)$_POST['Qty'][$i]);
		$_Qty<=0 && $_Qty=1;
		$_S_Qty=abs((int)$_POST['S_Qty'][$i]);
		$_Remark=$_POST['Remark'][$i];
		$_S_Remark=$_POST['S_Remark'][$i];
		
		if($_Qty!=$_S_Qty || $_Remark!=$_S_Remark){
			$product_row=$db->get_one('product', "ProId='$_ProId'");

			$db->update('shopping_cart', "$where and CId='$_CId'", array(
					'Qty'	=>	$_Qty,
					'Remark'=>	$_Remark,
					'Price'	=>	$product_row['Price_1'],
				)
			);
		}
	}

	js_location("$cart_url_cn?module=checkout");
	
}

if($_GET['act']=='remove' || $_GET['act']=='later'){
	$query_string=query_string(array('act', 'CId'));
	$CId=(int)$_GET['CId'];
	$db->delete('shopping_cart', "$where and CId='$CId'");
	
	if($_GET['act']=='later' && (int)$_SESSION['member_MemberId']){
		$ProId=(int)$_GET['ProId'];
		if(!$db->get_row_count('wish_lists', "$where and ProId='$ProId'")){
			$db->insert('wish_lists', array(
					'MemberId'	=>	(int)$_SESSION['member_MemberId'],
					'ProId'		=>	$ProId
				)
			);
		}
	}
	js_location("$cart_url_cn?$query_string");
}

$cart_row=$db->get_all('shopping_cart', $where, '*', 'ProId desc, CId desc');
?>
<div id="lib_cart_station"><a href="/">首页</a> &gt; 购物车</div>
<div id="lib_cart_guid"><img src="/images/lib/cart/guid_1_cn.gif" /></div>
<div id="lib_cart_list">
	<?php if(!$cart_row){?>
		<div class="empty_cart">
			<img src="/images/lib/cart/no_items.gif" align="left" /><strong>对不起，您的购物车为空</strong><br />
			<a href="/">返回首页</a><br />
			如果您添加商品后购物车是空的，可能是您的浏览器禁用了"cookies"。<br /> 
			继续购物, 请 <a href="/">点击</a>.
		</div>
	<?php
	}else{
		$total_price=$db->get_sum('shopping_cart', $where, 'Qty*Price');
		//var_dump($total_price);
	?>
		<div class="cart_info">
			<div class="fl">您的购物车: <span id="total_item"><?=(int)$db->get_sum('shopping_cart', $where, 'Qty');?></span> 件, <?php if($order_product_weight==1){?>重量: <span id="total_weight"><?=$db->get_sum('shopping_cart', $where, 'Qty*Weight');?></span> KG, <?php }?>总价: <span id="total_price_0"><?=iconv_price($total_price);?></span><?php if($order_discount>0){?>, Discount: <span><?=$order_discount*100;?>%</span>, Save: <span id="discount_save"><?=iconv_price($total_price*$order_discount);?></span><?php }?></div>
			<div class="fr"><a href="/">继续购物</a><a href="javascript://;" onclick="$_('cart_list_form').submit();">购物车结算</a></div>
		</div>
		<form action="<?=$cart_url_cn.'?'.$query_string;?>" method="post" name="cart_list_form" id="cart_list_form" OnSubmit="return checkForm(this);">
			<div class="cart">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="item_list_table">
					<tr class="tb_title">
						<td width="12%">图片</td>
						<td width="12%" nowrap>科目</td>
						<td width="32%" nowrap>产品名称</td>
						<td width="8%">单价</td>
						<td width="8%">数量</td>
						<td width="12%">总价</td>
						<td width="12%" class="last">&nbsp;</td>
					</tr>
					<?php
					for($i=0; $i<count($cart_row); $i++){
					?>
					<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';">
						<td valign="top"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" class="item_img"><a href="<?=$cart_row[$i]['Url'];?>" target="_blank"><img src="<?=$cart_row[$i]['PicPath'];?>" /></a></td></tr></table></td>
						<td valign="center" align="center"><a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname"><?=$Category[$cart_row[$i]['CateId']]['Category'];?></a><?php if($order_product_weight==1){?><br /><span style="font-size:12px;">重量: <?=$cart_row[$i]['Weight'];?> KG<?php }?></span></td>
						<td valign="top">
							<a href="<?=$cart_row[$i]['Url'];?>" target="_blank" class="proname" style="font-size:12px;"><?=$cart_row[$i]['Name'];?></a><br />
							<span class="remark" style="font-size:12px;"><?php if($cart_row[$i]['Color']){?>Color: <?=$cart_row[$i]['Color'];?><br /><?php }?>
							<?php if($cart_row[$i]['Size']){?>Size: <?=$cart_row[$i]['Size'];?><br /><?php }?>
							备注:</span>
                            <br /><input name="Remark[]" value="<?=addslashes($cart_row[$i]['Remark']);?>" type="text" size="70" maxlength="100" class="form_input" /><input type="hidden" name="S_Remark[]" value="<?=addslashes($cart_row[$i]['Remark']);?>" />
						</td>
						<td align="center" class="c_red" id="price_<?=$i;?>"><?=iconv_price($cart_row[$i]['Price']);?></td>
						<td align="center" nowrap>
							<a href="javascript://" onclick="cart_add_cut_qty(-1, <?=$i;?>, <?=$cart_row[$i]['StartFrom'];?>, <?=$cart_row[$i]['CId'];?>, <?=$cart_row[$i]['ProId'];?>, '<?=$cart_url_cn;?>'); this.blur();"><img src="/images/lib/cart/cut.jpg" align="absbottom" /></a>
							<input type="text" name="Qty[]" id="Qty_<?=$i;?>" value="<?=$cart_row[$i]['Qty'];?>" class="form_input qty" onkeyup="set_number(this, 0); cart_add_cut_qty(0, <?=$i;?>, <?=$cart_row[$i]['StartFrom'];?>, <?=$cart_row[$i]['CId'];?>, <?=$cart_row[$i]['ProId'];?>, '<?=$cart_url_cn;?>');" onpaste="set_number(this, 0); cart_add_cut_qty(0, <?=$i;?>, <?=$cart_row[$i]['StartFrom'];?>, <?=$cart_row[$i]['CId'];?>, <?=$cart_row[$i]['ProId'];?>, '<?=$cart_url_cn;?>');" size="4" maxlength="5" />
							<a href="javascript://" onclick="cart_add_cut_qty(1, <?=$i;?>, <?=$cart_row[$i]['StartFrom'];?>, <?=$cart_row[$i]['CId'];?>, <?=$cart_row[$i]['ProId'];?>, '<?=$cart_url_cn;?>'); this.blur();"><img src="/images/lib/cart/add.jpg" align="absbottom" /></a>
							<?php if($order_product_start_from==1){?><br />start from: <?=$cart_row[$i]['StartFrom'];?> pieces<?php }?>
							<input type="hidden" name="S_Qty[]" value="<?=$cart_row[$i]['Qty'];?>" />
							<input type="hidden" name="CId[]" value="<?=$cart_row[$i]['CId'];?>" />
							<input type="hidden" name="ProId[]" value="<?=$cart_row[$i]['ProId'];?>" />
						</td>
						<td align="center" class="c_red" id="sub_total_<?=$i;?>"><?=iconv_price($cart_row[$i]['Price']*$cart_row[$i]['Qty']);?></td>
						<td align="center" nowrap><a href="<?=$cart_url_cn.'?'.$query_string;?>&act=remove&CId=<?=$cart_row[$i]['CId'];?>" title="Remove this item from shopping cart" class="opt" style="font-size:12px;">移除</a><?php if((int)$_SESSION['member_MemberId']){?><a href="<?=$cart_url_cn.'?'.$query_string;?>&act=later&CId=<?=$cart_row[$i]['CId'];?>&ProId=<?=$cart_row[$i]['ProId'];?>" title="Remove this item from shopping cart and save this item to you wish list!" class="opt" style="font-size:12px;">移除并收藏</a><?php }?></td>
					</tr>
					<?php }?>
					<tr class="total">
						<td colspan="5"></td>
						<td id="total_price_1"><?=iconv_price($total_price);?></td>
						<td></td>
					</tr>
				</table>
			</div>
			<div class="checkout"><input type="image" name="imageField" src="/images/lib/cart/btn_cheakout_cn.png" /></div>
			<input type="hidden" name="data" value="cart_list" />
		</form>
		<div class="ext_info" style="padding-left:20px;">
			<strong>购物车使用提示：</strong><br /> 
			1. 您最多可以添加10000件商品到购物车。<br />
			2. 商品将永久保留到您的购物车中。<br />
			3. 您退出登陆后商品仍然会保存在您的账号中。
		</div>
	<?php }?>
</div>