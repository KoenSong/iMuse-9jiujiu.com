<style type="css/text">
.nav{
	//overflow:hidden;
	display: -webkit-box;
    display: flexbox;
	-webkit-box-pack: center;	
}
.nav .item0{
	flex: 1;
	-webkit-box-flex:1;
}
.nav .item1{
	flex:3;
	-webkit-box-flex:3;
}
</style>
<?php

$_SESSION['ProductListType']=0;
$query_string=query_string('page');
$turn_page_query_string=$website_url_type==0?"?$query_string&page=":'page-';
if($_SESSION['ProductListType']==0){
	$list_row_count=1;	//每行显示的产品件数
	$product_img_width=240;	//产品图片宽度
	$product_img_height=240;	//产品图片高度
}

!isset($_SESSION['ProductListType']) && $_SESSION['ProductListType']=1;
!isset($_SESSION['ProductByCate']) && $_SESSION['ProductByCate']=0;

$go_toclass=$alter_city;
$Gender_ary=array(1=>'男',2=>'女');
$PriceOrder_ary=array(1=>'价格从低到高',2=>'价格从高到低');


if(!isset($product_row)){
	$page_count=5;
	$where='SoldOut=0';	//基本搜索条件，如果后台开启了上下架功能，这里请设置为：SoldOut=0
	include($site_root_path.'/inc/lib/product/get_list_row.php');
}

//列表排序选项
$products_sorted_by_ary=$db->get_all('product_category',"UId='0,'"); 


ob_start();

?>
<div id="lib_product_list_shop">
	<?php
	$j=1;
	for($i=0; $i<count($product_row); $i++){
			//$url=get_url('product', $product_row[$i]);
			$url='/weixin/web/products-detail.php?ProId='.$product_row[$i]['ProId'];
			$ext_row=$db->get_one('product_ext',"ProId ='{$product_row[$i]['ProId']}'");
			$member_info=$db->get_one('member',"MemberId ='{$product_row[$i]['MemberId']}'");
			$T_age=$db->get_value('member_ident',"MemberId = '{$product_row[$i]['MemberId']}'",'T_age');
			$img_path=$product_row[$i]['PicPath_0']?str_replace('s_', '240X240_', $product_row[$i]['PicPath_0']):'/images/face.jpg';
			$_StudentNum1=mysql_fetch_assoc($db->query("select count(*) as sum from orders_product_list as p left join (select * from orders  where OrderStatus in(2,3,4)) o on p.OrderId = o.OrderId where p.ProId = '{$product_row[$i]['ProId']}' and o.OrderStatus in(2,3,4) order by o.OId desc"));
			$StudentNum1=$_StudentNum1['sum'];
			$_StudentNum2=mysql_fetch_assoc($db->query("select count(*) as sum from order_twos_product_list as p left join (select * from order_twos  where OrderStatus in(2,3,4)) o on p.OrderId = o.OrderId where p.ProId = '{$product_row[$i]['ProId']}' and o.OrderStatus in(2,3,4) order by o.OId desc"));
			$StudentNum2=$_StudentNum2['sum'];
			$StudentNum=$StudentNum1+$StudentNum2;
			$meet_calss_Count=$db->get_row_count('orders',"ProId ='{$product_row[$i]['ProId']}' and OrderStatus = '3'");
			$meet_calss_Count && $Continue_rate=$db->get_row_count('order_twos',"ProId ='{$product_row[$i]['ProId']}' and OrderStatus = '3'")/$meet_calss_Count*100;
			$Continue_rate = $Continue_rate>100?100:$Continue_rate;
			//评论
			$review_good=$db->get_row_count('product_review',"ProId ='{$product_row[$i]['ProId']}' and Review_Level='5'");
			$review_all=$db->get_row_count('product_review',"ProId ='{$product_row[$i]['ProId']}'");
			$review_rate='0';
			$review_all && $review_rate=($review_good/$review_all)*100;
			//var_dump($Continue_rate);
			$review_sum='';
			$review_sum=$db->get_sum('product_review',"ProId ='{$product_row[$i]['ProId']}'",'Review_Level');
			
		if($_SESSION['ProductListType']==0){
	?>
			<div class="item_0 translate round">
				<ul class="nav">
					<li class="img translate round item0" >
						<div class="PicPath" style="width:<?=$product_img_width;?>px; height:<?=$product_img_height;?>px">
						<a href="<?=$url;?>" title="<?=$product_row[$i]['Name'];?>">
							<img style="width:<?=$product_img_width;?>px; height:<?=$product_img_height;?>px;" src="<?=$img_path;?>"/>
						</a>
						</div>
					</li>
					<li class="info item1">
						<div class="name">
							<a href="<?=$url;?>" title="<?=$product_row[$i]['Name'];?>"><?=$product_row[$i]['Name'];?></a>
						</div>
                        <div class="Class_Cate"><span class="fl">教学科目:&nbsp; <?php echo $Category[$product_row[$i]['CateId']]['Category']?> </span>
                        	<div class="fr">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="furture">
                        	<img style="width:5px;padding-bottom: 8px;" src="/images/dou_left.png" />
                        	<?=$ext_row['Warranty0']?>
                        	<img style="width:5px;padding-bottom: 8px;" src="/images/dou_right.png" />
                        </div>
                        <div class="teacher_par">
                        	<span>教龄:</span><span>&nbsp;<?=$T_age?>年</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <span>性别:</span><span>&nbsp;<?=$product_row[$i]['Title']?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <span>年龄:</span><span>&nbsp;<?=$member_info['Brithday']?date('Y',time())-$member_info['Brithday']:''?>岁</span>&nbsp;&nbsp;
                            |&nbsp;&nbsp;
                            <span>授课区域:</span><span>&nbsp;<?=$db->get_value('product_color',"CId='{$product_row[$i]['ColorId']}'",'Color')?></span>
                        </div>
						<div class="teach_info">
                        	<div class="par_0"><span><?=$review_rate?$review_rate:'100'?>%</span><font>好评率</font></div>
                            <div class="par_3"><span><?=$Continue_rate?$Continue_rate:'100'?>%</span><font class="right">续课率</font></div>
                            
                            <div class="blank8"></div>
                            <div class="par_2"><span><?=$StudentNum?>h</span><font>授课时长</font></div>
                            <div class="par_1"><span><?=$StudentNum1?>人</span><font class="right">学生总数</font></div>
                        </div>
					</li>
					<li class="price">
                    	<div class="review_star">
                            <span style=" display:block; float:left; margin-left:66px;width:98px; height:17px; background:url(/images/star.png) -100px 60px;">
                              <span style=" display:block; float:left; width:<?=$review_all?($review_sum/($review_all*5))*100:'0'?>%;height:17px; background:url(/images/star.png) 0px 140px;"></span>
                            </span>
                            <span>(<?=$review_all?>条评论)</span>
                        </div>
                        <div class="price_title">——— &nbsp;九啾啾价&nbsp; ———</div>
                        <div class="P_0"><del>机构价:<?=$product_row[$i]['Price_0']==''?$product_row[$i]['Price_0']:''?></del></div>
                        <div class="P_1"><span><?=$product_row[$i]['Price_1']?><span><font>元/小时</font></div>
                        <div class="Detail round"><a href="<?=$url?>"></a></div>
					</li>
				</ul>
			</div>
			<?php if($j++<=count($product_row)){?><div class="blank12"></div><?php }?>
	<?php }}?>
	<div class="clear"></div>
	<div id="turn_page"><?=turn_page_ext($page, $total_pages, $turn_page_query_string, $row_count, '&nbsp;上一页', '下一页&nbsp;&nbsp;', 0);?></div>
</div>
<?php
$product_list_shop=ob_get_contents();
ob_clean();
?>