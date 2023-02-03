<?php
include('../../site_config.php');
include('../../set/ext_var.php');
include('../../fun/mysql.php');
include('../../function.php');

$ProId=(int)$_GET['ProId'];
//$where="ProId='$ProId' and Display =1";
$where="ProId='$ProId'";
$page_count=10;

$row_count=$db->get_row_count('product_review', $where);
$total_pages=ceil($row_count/$page_count);
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*$page_count;
$review_row=$db->get_limit('product_review', $where, '*', 'RId desc', $start_row, $page_count);
$Lnum='0';
$Gnu='0';
$Mnum='0';
foreach((array)$review_row as $v){

	if($v['Review_Level']==5){
		//好评
		$Gnum+=1;
		$Gnum_row[]=$v;
		
	}elseif($v['Review_Level']==2){
		//中评
		$Mnum+=1;
		$Mnum_row[]=$v;
		
	}elseif($v['Review_Level']==-1){
		//差评
		$Lnum+=1;
		$Lnum_row[]=$v;
		
	}
	$Anum+=1;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="save" content="history" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?=seo_meta();?>
<script language="javascript" src="/js/lang/cn.js"></script>
<script language="javascript" src="/js/global.js"></script>
<script language="javascript">
onload=function(){
	parent.$_('lib_product_review').innerHTML=$_('lib_product_review').innerHTML;
}
</script>
</head>

<body>
<div id="lib_product_review">
	<iframe name="post_data_iframe"></iframe>
    <div class="type_review">
        <ul class="type_review_meua">
            <li class="cur" onclick="review_show(this)">全部评价(<?=$Anum?$Anum:'0'?>)</li>
            <li onclick="review_show(this)">好评（<?=$Gnum?$Gnum:'0'?>）</li>
            <li onclick="review_show(this)">中评（<?=$Mnum?>）</li>
            <li onclick="review_show(this)">差评（<?=$Lnum?>）</li>
            <div class="clear"></div>
        </ul>
		<div class="level">
			<?php
			for($i=0; $i<count($review_row); $i++){
			?>
				<div id="review_list">
						<div class="item">
							<div class="top">
								<span><?=$review_row[$i]['FullName'];?></span><br />
								<span class="time"><?=date('Y-m-d',$review_row[$i]['PostTime'])?></span>
							</div>
							<div class="bottom">
								<?=$review_row[$i]['Contents'];?>
							</div>
						</div>
					</div>
			<?php }?>
		</div>
		<div class="level" style="display:none;">
			<?php
			for($i=0; $i<count($Gnum_row); $i++){
			?>
				<div id="review_list">
						<div class="item">
							<div class="top">
								<span><?=$Gnum_row[$i]['FullName'];?></span><br />
								<span class="time"><?=date('Y-m-d h:m:s',$Gnum_row[$i]['PostTime'])?></span>
							</div>
							<div class="bottom">
								<?=$Gnum_row[$i]['Contents'];?>
							</div>
						</div>
					</div>
			<?php }?>
		</div>
		<div class="level" style="display:none;">
			<?php
			for($i=0; $i<count($Mnum_row); $i++){
			?>
				<div id="review_list">
						<div class="item">
							<div class="top">
								<span><?=$Mnum_row[$i]['FullName'];?></span><br />
								<span class="time"><?=date('Y-m-d h:m:s',$Mnum_row[$i]['PostTime'])?></span>
							</div>
							<div class="bottom">
								<?=$Mnum_row[$i]['Contents'];?>
							</div>
						</div>
					</div>
			<?php }?>
		</div>
		<div class="level" style="display:none;">
			<?php
			for($i=0; $i<count($Lnum_row); $i++){
			?>
				<div id="review_list">
						<div class="item">
							<div class="top">
								<span><?=$Lnum_row[$i]['FullName'];?></span><br />
								<span class="time"><?=date('Y-m-d h:m:s',$Lnum_row[$i]['PostTime'])?></span>
							</div>
							<div class="bottom">
								<?=$Lnum_row[$i]['Contents'];?>
							</div>
						</div>
					</div>
			<?php }?>
		</div>
        </div>
		
	<div class="blank6"></div>
	<div id="turn_page"><?=str_replace('<a ', '<a target="post_data_iframe"', turn_page($page, $total_pages, "/inc/lib/product/review_en.php?ProId=$ProId&page=", $row_count));?></div>
	<div class="blank20"></div>
    <?php /*?><?php if($_SESSION['member_MemberId']){?>
	<div class="t">评论:</div>
	<div class="form">
		<form action="/inc/lib/product/review_en.php" method="post" target="post_data_iframe" name="review_en_form" OnSubmit="return checkForm(this);">
			<div class="rows">
				<label>评分: <font class='fc_red'>*</font></label>
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
		</form>
	</div>
    <?php }?><?php */?>
</div>
</body>
</html>