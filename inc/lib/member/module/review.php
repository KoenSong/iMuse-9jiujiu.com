<?php
$cur='评价中心';
$OId=$_GET['OId'];
$type=(int)$_GET['type'];



if($type==1){
	$order_row=$db->get_one('orders',"OId = '$OId'");
	$ProId= $order_row['ProId'];
	$qty = 1;
}elseif($type==2){
	$order_row=$db->get_one('order_twos',"OId = '$OId'");
	$ProId= $order_row['ProId'];
	$orderId = $order_row['OrderId'];
	$qty = $db->get_row_count('order_twos_product_list', "OrderId = '$orderId'");
}
$url='/products-detail.php?ProId='.$order_row['ProId'];
?>
<div id="lib_member_review">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
	<?php /*?><?php if($type==1){?><?php */?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail_item_list">
				<tr class="tb_title">
					<td width="14%">图片</td>
					<td width="50%">课程信息</td>
					<td width="12%">价格</td>
					<td width="12%">数量</td>
					<td width="12%" class="last">总价</td>
				</tr>
                <style type="text/css">
				.flh_150{font-size:12px !important;}
				</style>
				<?php
				$item_row=$order_row;
				
				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<td valign="top"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" class="item_img"><a href="<?=$url;?>" target="_blank"><img width="100" src="<?=$db->get_value('product',"ProId = $ProId",'PicPath_0');?>" /></a></td></tr></table></td>
					<td align="center" class="flh_150">
						老师: <a href="<?=$url;?>" target="_blank" class="proname"><?=$db->get_value('product',"ProId = $ProId",'Name');?></a><br /><br />
						科目: <?=$Category[$item_row['CateId']]['Category']?><br /><br />
					</td>
					<td><?=iconv_price($item_row['TotalPrice']);?></td>
					<td><?=$qty;?></td>
					<td class="last"><?=iconv_price($item_row['TotalPrice']);?></td>
				</tr>
				<tr class="total">
					<td colspan="3">&nbsp;</td>
					<td></td>
					<td class="last"><?=iconv_price($item_row['TotalPrice']);?></td>
				</tr>
	</table>
	<?php /*?><?php }else{?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail_item_list">
				<tr class="tb_title">
					<td width="14%">图片</td>
					<td width="50%">课程信息</td>
					<td width="12%">价格</td>
					<td width="12%">数量</td>
					<td width="12%" class="last">总价</td>
				</tr>
                <style type="text/css">
				.flh_150{font-size:12px !important;}
				</style>
				<?php
				$pro_count=0;
				$item_row=$db->get_one('member',"MemberId = '{$order_row['MemberId']}'");
				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<td valign="top"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" class="item_img"><a href="<?=$url?>" target="_blank"><img src="<?=$item_row['Face'];?>" /></a></td></tr></table></td>
					<td align="center" class="flh_150">
						学生: <a href="<?=$url;?>" target="_blank" class="proname"><?=$item_row['UserName'];?></a><br /><br />
						科目: <?=$Category[$order_row['CateId']]['Category']?><br /><br />
					</td>
					<td><?=iconv_price($order_two['TotalPrice']);?></td>
					<td>1</td>
					<td><?=iconv_price($order_two['TotalPrice']);?></td>
				</tr>
				<tr class="total">
					<td colspan="3">&nbsp;</td>
					<td></td>
					<td><?=iconv_price($order_row['TotalPrice']);?></td>
				</tr>
	</table>
	<?php }?><?php */?>
	<?php /*?><div class="list_row">
		<div style="height:30px; font-size:16px; text-align:center; margin-top:10px;"><?=$member_info['IsTearch']==1?'学生信息':'老师信息'?></div>
		<div class="img fl">
			<div class="PicPath">
				<a href="<?=$url?>"><img src="<?=$img?>" /></a>
			</div>
		</div>
		<div class="fl info">
			<div class="name">昵称:&nbsp;&nbsp;<?=$name?></div>
			<div class="cate">科目:&nbsp;&nbsp;<?=$cate?></div>
		</div>
	</div><?php */?>

	<div class="form">
		<form action="/inc/lib/member/action/mod.php" method="post" name="review_en_form" OnSubmit="return checkForm(this);">
			<div class="rows">
				<label>印象评分: <font class='fc_red'>*</font></label>
				<span><input type="radio" name="Review_Level" value="5" checked="checked" /> 好评 &nbsp;&nbsp; <input type="radio" name="Review_Level" value="2" /> 中评  &nbsp;&nbsp; <input type="radio" name="Review_Level" value="-1" /> 差评</span>
				<div class="clear"></div>
			</div>
			
			<div class="rows">
				<label>评论内容: <font class='fc_red'>*</font></label>
				<span><textarea name="Contents" class="form_area contents" check="Review Contents is required!~*"></textarea></span>
				<div class="clear"></div>
			</div>
			<div class="rows">
				<label></label>
				<span><input name="Submit" type="submit" class="form_button form_button_130" value="评&nbsp;论"></span>
				<div class="clear"></div>
			</div>
			<input type="hidden" name="ProId" value="<?=$ProId;?>" />
			<input type="hidden" name="data" value="review_cn" />
			<input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
			<input type="hidden" name="IsTearcher" value="<?=$member_info['IsTeacher']?>" />
		</form>
	</div>
</div>