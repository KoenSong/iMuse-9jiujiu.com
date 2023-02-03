<?php
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');

	$nav_all=$db->get_all('product_category',"1");
	foreach($nav_all as $item){
		//导航栏目
		if($item['IsNav']==1){$nav_meua[]=$item;}
		//一级分类
		if($item['Dept']==1){
			$FCategory[]=$item;
		}
		//二级栏目
		if($item['Dept']==2){
			$FCateId=get_CateId_by_UId($item['UId']);
			$SCategory[$FCateId][]=$item;
			echo $FCateId;
		}
		//分类名,不用继续查数据库
		$Category[$item['CateId']]=$item;
	}
?>
