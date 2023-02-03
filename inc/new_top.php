<?php 
$new_c_row=$db->get_limit('order_twos',"OrderStatus != '1'",'Shipping_Name,ProId,ClassTime,CateId,OrderId','ClassTime desc',0,3);
?>
<div id="New_top">
	<div class="title">最近开课</div>
<?php $t=0;foreach((array)$new_c_row as $item){
	$url='/products-detail.php?ProId='.$item['ProId'];
	$img=$db->get_value('product',"ProId = '{$item['ProId']}'",'PicPath_0');
	$img &&  $img = str_replace('s_','105X105_',$img);
	$review_good=$db->get_row_count('product_review',"ProId ='{$item['ProId']}' and Review_Level='5'");
	$review_all=$db->get_row_count('product_review',"ProId ='{$item['ProId']}'");
	$review_rate='0';
	$review_all && $review_rate=($review_good/$review_all)*100;
	//var_dump($Continue_rate);
	$review_sum='';
	$review_sum=$db->get_sum('product_review',"ProId ='{$item['ProId']}'",'Review_Level');
	?>
    <ul class="New_top_ul">
    	<li class="img">
        	<div class="PicPath">
            	<a href="<?=$url?>"><img src="<?=$img?$img:'/images/face.jpg'?>" width="92" alt="<?=$item['ProName']?>" /></a>
                <span></span>
            </div>
        </li>
        <li class="name">
        	<a href="<?=$url?>"><span><?=$db->get_value('product',"ProId = '{$item['ProId']}'",'Name');?></span></a><span class="span1"><?php echo $Category[$item['CateId']]['Category']?></span>
        </li>
        <li class="review_star over" style="margin:8px 0px;">
            <span style=" display:block; float:left; margin-left:66px;width:98px; height:17px; background:url(/images/star.png) -100px 60px;">
              <span style=" display:block; float:left; width:<?=$review_all?($review_sum/($review_all*5))*100:'0'?>%;height:17px; background:url(/images/star.png) 0px 140px;"></span>
            </span>
        </li>
        <li class="info">
        	<div class="Stime">开课时间&nbsp;:&nbsp;<?=date('Y-m-d',$item['ClassTime'])?></div>
            <div class="student">学生信息&nbsp;:&nbsp;<?=$item['Shipping_Name']?></div>
            <div class="Ctime">计划课时&nbsp;:&nbsp;1</div>
        </li>
    </ul>
    <?php if(++$t<count($new_c_row)){?><div class="blank25"></div><?php }?>
<?php }?>
<div class="blank20"></div>
</div>