<?php
/*
url可带参数：
AId:信息页ID
*/

$AId=(int)$_GET['AId'];
if($AId == ''){
	$where=1;
	$GroupId = (int)$_GET['GroupId'];
	$GroupId && $where.=" and GroupId =$GroupId";
	$get_aid=$db->get_limit('article',$where,'AId','MyOrder desc,AId asc',0,1);
	$AId = $get_aid[0]['AId'];	
}
$article_row=$db->get_one('article', "AId='$AId'");
?>