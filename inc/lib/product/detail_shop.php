<?php
$product_img_width=350;	//产品图片宽度
$product_img_height=350;	//产品图片高度
$contents_width=760;	//显示内容的div的宽度

!isset($product_row) && include($site_root_path.'/inc/lib/product/get_detail_row.php');

ob_start();
?>
<script language="javascript" src="/js/checkform.js"></script>
<script language="javascript" src="/js/magiczoom.js"></script>
<div id="lib_product_detail_shop" style="width:<?=$contents_width;?>px;">
	<div class="pro_img" style="width:<?=$product_img_width+2;?>px;">
		<div class="bigimg"><a href="<?=str_replace('s_', '', $product_row['PicPath_0']);?>" class="MagicZoom" id="zoom" rel="zoom-position:custom; zoom-width:350px; zoom-height:350px;"><img src="<?=str_replace('s_', "{$product_img_width}X{$product_img_height}_", $product_row['PicPath_0']);?>" id="bigimg_src" /></a></div>
		<div id="zoom-big" style="left:<?=$product_img_width+1;?>px;"></div>
		<div class="clear"></div>
		<div id="small_img">
			<ul id="small_img_list">
				<?php
				$img_count=0;
				for($i=0; $i<5; $i++){
					if(!is_file($site_root_path.$product_row['PicPath_'.$i])){
						continue;
					}
					$img_count++;
				?>
					<li class="small_img_item"><a href="javascript://;" onclick="showPreview('<?=str_replace('s_', "{$product_img_width}X{$product_img_height}_", $product_row['PicPath_'.$i]);?>', '<?=str_replace('s_', '', $product_row['PicPath_'.$i]);?>'); this.blur();"><img src="<?=str_replace('s_', '70X70_', $product_row['PicPath_'.$i]);?>" /></a></li>
				<?php }?>
			</ul>
			<?php if($img_count>3){?>
				<script type="text/javascript" src="/js/mootools.js"></script>
				<script type="text/javascript" src="/js/iCarousel.js"></script>
				<div class="small_img_ctrl">
					<div class="left"><img id="small_img_previous" src="/images/lib/product/left.gif" /></div>
					<div class="right"><img id="small_img_next" src="/images/lib/product/right.gif" /></div>
				</div>
			<?php }?>
		</div>
	</div>
	<div class="cs" style="width:<?=$contents_width-$product_img_width-17;?>px;">
		<div class="proname"><?=$product_row['Name'];?></div>
		<div class="itemno">Item ID #<?=$product_row['ItemNumber'];?></div>
		<div class="oline"></div>
		<div class="price_0">List Price: <del><?=price_list($product_row['Price_0']);?></del></div>
		<div class="price_1"><strong>Price: <span><?=price_list($product_row['Price_1']);?></span></strong></div>
		<div class="blank6"></div>
		<?php
		$pro_row_wholesale_price=$db->get_all('product_wholesale_price', "ProId='{$product_row['ProId']}'", '*', 'Qty asc');
		if(count($pro_row_wholesale_price)){
		?>
			<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#dddddd">
			  <tr align="center" bgcolor="#ECECEC">
				<td width="30%"><strong>Qty.Range(unit)</strong></td>
				<td width="35%"><strong>Price(per unit)</strong></td>
				<td width="35%"><strong>Discount</strong></td>
			  </tr>
			  <?php
			  for($i=0; $i<count($pro_row_wholesale_price); $i++){
			  ?>
			  <tr align="center" bgcolor="#ffffff">
				<td><?=$pro_row_wholesale_price[$i]['Qty'];?></td>
				<td><?=price_list($pro_row_wholesale_price[$i]['Price']);?></td>
				<td><?=price_list($product_row['Price_1']-$pro_row_wholesale_price[$i]['Price']);?></td>
			  </tr>
			  <?php }?>
			</table>
			<div class="blank12"></div>
		<?php }?>
		<form action="<?=$cart_url;?>?<?=$service_time;?>" target="addtocart_iframe" method="post">
			<div class="addtocart">
				<?php
				if($product_row['ColorId']!='||'){
					$color_row=$db->get_all('product_color');
					for($j=0; $j<count($color_row); $j++){
						$product_color[$color_row[$j]['CId']]=$color_row[$j];
					}
					$color_ary=explode('|', $product_row['ColorId']);
					echo '<div><strong>Color:</strong><div class="par_list">';
					for($j=1; $j<count($color_ary)-1; $j++){
						$class=$j==1?'box1':'box0';
						echo "<span class='$class' id='color_box_{$j}' onclick=\"change_color('{$color_ary[$j]}', '$j')\">{$product_color[$color_ary[$j]]['Color']}</span> ";
					}
					echo '</div></div><div class="blank9"></div>';
				}
				if($product_row['SizeId']!='||'){
					$size_row=$db->get_all('product_size');
					for($j=0; $j<count($size_row); $j++){
						$product_size[$size_row[$j]['SId']]=$size_row[$j];
					}
					$size_ary=explode('|', $product_row['SizeId']);
					echo '<div><strong>Size:</strong><div class="par_list">';
					for($j=1; $j<count($size_ary)-1; $j++){
						$class=$j==1?'box1':'box0';
						echo "<span class='$class' id='size_box_{$j}' onclick=\"change_size('{$size_ary[$j]}', '$j')\">{$product_size[$size_ary[$j]]['Size']}</span> ";
					}
					echo '</div></div><div class="blank9"></div>';
				}
				?>
				<script language="javascript">
				function change_color(color, obj){
					for(i=0; i<<?=count($color_ary)-1;?>; i++){
						$_('color_box_'+i).className='box0';
					}
					$_('color_input').value=color;
					$_('color_box_'+obj).className='box1';
				}
				
				function change_size(size, obj){
					for(i=0; i<<?=count($size_ary)-1;?>; i++){
						$_('size_box_'+i).className='box0';
					}
					$_('size_input').value=size;
					$_('size_box_'+obj).className='box1';
				}
				</script>
				<div><strong>Quantity:</strong> <input type="text" size="3" name="Qty" maxlength="5" class="form_input" value="1" /> Unit(s)</div>
				<div class="blank9"></div>
				<div><input type="image" name="imageField" src="/images/lib/product/addtocart.jpg" align="absmiddle" onclick="this.blur();" /><a href="<?=$member_url;?>?module=wishlists&act=add&ProId=<?=$product_row['ProId'];?>" class="wishlists">Add to Wish Lists</a></div>
				<iframe name="addtocart_iframe" id="addtocart_iframe" src="about:blank" style="display:none;"></iframe>
			</div>
			<input type="hidden" name="module" value="add" />
			<input type="hidden" name="ProId" value="<?=$product_row['ProId'];?>" />
			<input type="hidden" id="color_input" name="ColorId" value="<?=$color_ary[1];?>">
			<input type="hidden" id="size_input" name="SizeId" value="<?=$size_ary[1];?>">
			<input type="hidden" name="JumpUrl" value="<?=$cart_url;?>?module=add_success" />
		</form>
	</div>
	<div class="clear"></div>
	<div class="pro_detail_ext">
		<div class="description">
			<div class="title">Description:</div>
			<div class="flh_180 txt"><?=$db->get_value('product_description', "ProId='{$product_row['ProId']}'", 'Description');?></div>
		</div>
		<div id="lib_product_review"></div>
		<iframe src="/inc/lib/product/review_en.php?ProId=<?=$product_row['ProId'];?>" style="display:none;"></iframe>
		<div class="may_like">
			<div class="title">You Maybe Like:</div>
			<div class="maybe_like" id="scroller" style="width:<?=$contents_width;?>px;">
					<div class="scroller_contents" onMouseOver="Tstop_scroll();" onMouseOut="Tstart_scroll();">
						<div id="scroller_contents_0">
						<?php
						$product_img_width=160;	//产品图片宽度
						$product_img_height=160;	//产品图片高度
						
						$maybe_like_row=$db->get_limit('product', "CateId='{$product_row['CateId']}' and SoldOut=0", '*', 'MyOrder desc, ProId desc', 0, 10);
						count($maybe_like_row)<=1 && $maybe_like_row=$db->get_limit('product', 'SoldOut=0', '*', 'MyOrder desc, ProId desc', 0, 10);
						for($i=0; $i<count($maybe_like_row); $i++){
							$url=get_url('product', $maybe_like_row[$i]);
						?>
							<div class="item" style="width:<?=$product_img_width+15;?>px;">
								<ul style="width:<?=$product_img_width+2;?>px;">
									<li class="img" style="width:<?=$product_img_width;?>px; height:<?=$product_img_height;?>px; *font-size:<?=ceil($product_img_height*0.873);?>px;"><a href="<?=$url;?>" title="<?=$maybe_like_row[$i]['Name'];?>"><img src="<?=$maybe_like_row[$i]['PicPath_0'];?>"/></a></li>
									<li class="name"><a href="<?=$url;?>" title="<?=$maybe_like_row[$i]['Name'];?>"><?=$maybe_like_row[$i]['Name'];?></a></li>
									<li class="price"><del><?=price_list($maybe_like_row[$i]['Price_0']);?></del><span>Sale <?=price_list($maybe_like_row[$i]['Price_1']);?></span></li>
								</ul>
							</div>
						<?php }?>
						</div>
						<div id="scroller_contents_1"></div>
						<div class="clear"></div>
					</div>
			</div>
			<script language="javascript" src="/js/scroller.js"></script>
		</div>
	</div>
</div>
<?php
$product_detail_shop=ob_get_contents();
ob_end_clean();
?>