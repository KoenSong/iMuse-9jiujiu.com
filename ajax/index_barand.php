<?php 
	include('../inc/include.php');
	$BrandId = (int)$_GET['BrandId'];
	//echo $BrandId;
	//exit;
	//$product_row=$db->get_all('product',"BrandId = '$BrandId'");
	$maybe_like_row=$db->get_all('product',"BrandId = '$BrandId' and IsInIndex = 1");
	count($maybe_like_row)<=1 && $maybe_like_row=$db->get_limit('product', 'SoldOut=0', '*', 'MyOrder desc, ProId desc', 0, 10);
?>
<div id="P_table">
<div class="may_like">
			<div onclick="" class="maybe_like" id="scroller" style="margin:0 auto;">
					<div class="scroller_contents" onMouseOver="Tstop_scroll();" onMouseOut="Tstart_scroll();">
						<div id="scroller_contents_0">
						<?php
						$product_img_width=200;	//产品图片宽度
						$product_img_height=150;	//产品图片高度
						
						
						for($i=0; $i<count($maybe_like_row); $i++){
							$url=get_url('product', $maybe_like_row[$i]);
						?>
							<div class="item" style="width:<?=$product_img_width+35;?>px;">
								<ul style="width:<?=$product_img_width+2;?>px;">
									<li class="img" style="width:<?=$product_img_width;?>px; height:<?=$product_img_height;?>px; *font-size:<?=ceil($product_img_height*0.873);?>px;"><a href="<?=$url;?>" title="<?=$maybe_like_row[$i]['Name'];?>"><img src="<?=str_replace('s_',"{$product_img_width}X{$product_img_height}_",$maybe_like_row[$i]['PicPath_0']);?>"/></a></li>
									<li class="name">
                                    <a href="<?=$url;?>" title="<?=$maybe_like_row[$i]['Name'];?>"><?=cutEn($maybe_like_row[$i]['Name'],25);?></a>
                                    </li>
                                    <li class="brif"><?=cutEn($maybe_like_row[$i]['BriefDescription'],60);?></li>
									<li class="price"><span class="fl"><font class="span0"><del><?=price_list($maybe_like_row[$i]['Price_0']);?></del></font><br /><font class="span1"><?=price_list($maybe_like_row[$i]['Price_1']);?></font></span> <a target="addtocart_iframe" class="addcart" href="/cart.php?module=add&ProId=<?=$maybe_like_row[$i]['ProId']?>&JumpUrl=/cart.php?module=add_success"></a></li>
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
