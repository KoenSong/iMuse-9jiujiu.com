<?php 
//$where='IsTeacher = 1';
$member_rs=$db->query("select m.* from member_apply m left join (select MemberId from member where IsTeacher=1) o on m.MemberId=o.MemberId where m.Ischeck=1 order by m.RegTime desc limit 0,6");
while($member_row=mysql_fetch_assoc($member_rs)){
	$new_c_row[]=$member_row;
}
//$apply_row=$db->get_limit('member_apply',"Ischeck = '1'",'MemberId,RegTime','RegTime DESC',0,6);

//$new_c_row=$db->get_limit('product','SoldOut=0','*','AccTime DESC',0,6);
?>
<div id="New_bottom">
	<div class="title">最新认证</div>
<?php $t=0;foreach((array)$new_c_row as $item){
	$new_product_row=$db->get_one('product',"MemberId = '{$item['MemberId']}'",'Name,CateId,ProId,PicPath_0');
	$new_product_row['PicPath_0']=$new_product_row['PicPath_0']?$new_product_row['PicPath_0']:'/images/face.jpg';
	$url=get_url('product',$new_product_row);
	?>
    <div class="item">
    	<div class="l">
    		<div class="PicPath"><a href="<?=$url?>"><img width="72" src="<?=str_replace('s_','72X72_',$new_product_row['PicPath_0'])?>" alt="<?=$new_product_row['Name']?>" /></a></div>
        </div>
        <div class="r">
        	<div class="name"><a href="<?=$url?>"><?=$new_product_row['Name']?></a></div>
            <div class="cate"><?=$Category[$new_product_row['CateId']]['Category']?></div>
            <div class="time0">认证时间: </div>
            <div class="time1"><?=date('Y-m-d',$item['RegTime'])?></div>
        </div>
    </div>
    <?php if(++$t<count($new_c_row)){?><div class="blank25"></div><?php }?>
<?php }?>
<div class="blank20"></div>
</div>