<?php
$query_string=query_string('ProId');

if($_POST['module']=='add'){
	$ProId=(int)$_POST['ProId'];
	$JumpUrl=$_POST['JumpUrl'];
}else{
	$ProId=(int)$_GET['ProId'];
	$JumpUrl=$_GET['JumpUrl'];
}

($JumpUrl=='' || substr($JumpUrl, 0, 1)!='/') && $JumpUrl="$cart_url_cn?module=list";
$Qty<=0 && $Qty=1;

$product_row=$db->get_one('product', "ProId='$ProId'");
$product_ext_row=$db->get_one('product_ext', "ProId='$ProId'");
!$product_row && js_location("$cart_url_cn?module=list");
$where.=" and ProId='$ProId'";

if(!$db->get_row_count('shopping_cart', $where)){
	$db->insert('shopping_cart', array(
			'MemberId'	=>	(int)$_SESSION['member_MemberId'],
			'SessionId'	=>	$cart_SessionId,
			'ProId'		=>	$ProId,
			'CateId'	=>	(int)$product_row['CateId'],
			'StartFrom'	=>	(int)$product_row['StartFrom'],
			'Name'		=>	addslashes($product_row['Name']),
			'ItemNumber'=>	addslashes($product_row['ItemNumber']),
			//'Weight'	=>	(float)$product_row['Weight'],
			'PicPath'	=>	$product_row['PicPath'],
			'Price'		=>	$product_row['Price_1'],
			'Qty'		=>	$Qty,
			'Url'		=>	addslashes(get_url('product', $product_row)),
			'AddTime'	=>	$service_time,
			//'CourseStr'	=>	$course_str
		)
	);
}else{
	$Qty=$db->get_value('shopping_cart', $where, 'Qty')+$Qty;
	$db->update('shopping_cart', $where, array(
			'Qty'	=>	$Qty,
			'Price'	=>	$product_row['Price_1'],//pro_add_to_cart_price($product_row, $Qty, $order_product_price_field)
		)
	);
}
js_location($JumpUrl);
?>