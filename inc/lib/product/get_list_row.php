<?php
/*
url可带参数：
CateId:类别ID
Keyword:搜索关键词（搜索产品名称、产品编号）
P0:价格范围起始值（默认搜索Price_1值，请根据需要修改）
P1:价格范围结束值
ItemNumber:按产品编号精确搜索出对应产品
ext:后台勾选框筛选，值对应搜索条件如ext_ary数组：
*/

//-------------------------------------------------------------------------------------------------------------------------------------------------

$ext_ary=array(1=>'IsInIndex=1', 2=>'IsHot=1', 3=>'IsRecommend=1', 4=>'IsNew=1', 5=>'IsSpecialOffer=1');
$products_order_by=array(0=>'',1=>'Price_1 asc,',2=>'Price_1 desc,');
$Gender_ext=array(1=>"Title='男'", 2=>"Title='女'",);

$CateId=(int)$_GET['CateId'];
$Keyword=$_GET['Keyword'];
$P0=(float)$_GET['P0'];
$P1=(float)$_GET['P1'];
$ItemNumber=$_GET['ItemNumber'];
$ext=(int)$_GET['ext'];
//$C_addrees=(int)$_POST['C_addrees'];
$_Category=$_POST['Category']?$_POST['Category']:$_GET['Category'];
$C_type=(int)$_POST['C_type']?(int)$_POST['C_type']:$_GET['C_type'];				//课程种类
$Gender=(int)$_SESSION['ProductGender'];    //性别
//$CityId=(int)$_SESSION['ProducttoClass'];
$CircleId=(int)$_SESSION['ProductCircle']; //商圈
$_SESSION['CId'] && $where.=" and ColorId='{$_SESSION['CId']}'";//地区
$C_type && $where.=" and CateId = '$C_type'";  //课程种类

$Keyword && $ID=(int)$Keyword;
if(is_numeric($_Category)){
	$_Category = ltrim($_Category,'0');
	$_Category && $where.=" and MemberId like '%$_Category%'";
}else{
	$_Category && $search_cate=$db->get_one('product_category',"Category like '%$_Category%'");//首页BANNER搜索课程种类名称
	$search_cate && $CateId=$search_cate['CateId']; //首页BANNER搜索课程种类ID
}
$_SESSION['ProductByCate'] && $CateId =(int)$_SESSION['ProductByCate']; //课程种类
$CateId && $where.=' and '.get_search_where_by_CateId($CateId, 'product_category');
if($ID){
	$Keyword && $where.=" and (Name like '%$Keyword%' or ProId like '%$ID%')"; //会员ID 例如：000027则27可搜到
}else{
	$Keyword && $where.=" and (Name like '%$Keyword%')"; //会员ID 例如：000027则27可搜到
}
(($P0 || $P1) && $P1>$P0) && $where.=" and Price_1 between $P0 and $P1";
$ItemNumber && $where.=" and ItemNumber='$ItemNumber'";
($ext && $ext_ary[$ext]) && $where.=" and {$ext_ary[$ext]}";
$Gender && $where.=" and {$Gender_ext[$Gender]}"; //性别
$CircleId && $where.=" and CircleId='$CircleId'"; //商圈

$row_count=$db->get_row_count('product', $where);
$total_pages=ceil($row_count/$page_count);
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*$page_count;
//$product_row=$db->get_limit("product", $where, '*', 'Review desc,'.$products_order_by[$_SESSION['ProductPriceOrder']].'MyOrder desc, ProId desc', $start_row, $page_count);
if($where == "SoldOut=0" || $where == "SoldOut=0 and ColorId='1'" ||  empty($_SESSION['ProductPriceOrder']) || $_SESSION['ProductPriceOrder'] == '0'){
	//查询条件加入表别名
	$whereTmp = $where;
	$find="CateId";
	$tmp = stripos($where,$find);
	$tmp && $whereTmp=insertToStr($where, $tmp, "t.");

	$query_sql = " select * from ( "
				." SELECT t.* from product t "
				." where t.myorder is not null and t.myorder != 0 "
				." and $whereTmp"
				." order by myorder desc) t4 "
				." union"
				." select * from (SELECT distinct t.* "
	  			." FROM product t  "
	  			." join order_twos o on t.proid = o.proid "
	  			." where $whereTmp "
	  			." ORDER BY t.review desc,".$products_order_by[$_SESSION['ProductPriceOrder']]."t.myorder desc,o.orderTime desc,t.proid desc"
	 			." ) t1  "
				." union "
				." select * from (SELECT distinct t.*"     
				." FROM product t  "
				." join orders o on t.proid = o.proid"
	 			." where $whereTmp "
				." ORDER BY t.review desc,".$products_order_by[$_SESSION['ProductPriceOrder']]." t.myorder desc,o.orderTime desc,t.proid desc"
				." ) t2 "
				." union"
				." select * from (SELECT t.* "
				." from product t "
	 			." where $whereTmp "
				." ORDER BY t.review desc,".$products_order_by[$_SESSION['ProductPriceOrder']]."t.myorder desc,t.proid desc"
				." ) t3"
				." limit $start_row, $page_count";
	$product_result=$db->query($query_sql);
	while($row=mysql_fetch_assoc($product_result)){
		$product_row[]=$row;
	}
}else{
	if(!empty($_SESSION['ProductPriceOrder']) && $_SESSION['ProductPriceOrder'] != '0'){
		$product_row=$db->get_limit("product", $where, '*', substr($products_order_by[$_SESSION['ProductPriceOrder']],0,-1), $start_row, $page_count);
	}else{
		$product_row=$db->get_limit("product", $where, '*', 'Price_1 asc', $start_row, $page_count);
	}
}
?>