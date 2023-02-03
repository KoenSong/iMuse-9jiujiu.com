<?php
ob_end_clean();

$obj=(int)$_GET['obj'];
$CId=(int)$_GET['CId'];
$ProId=(int)$_GET['ProId'];
$Qty=(int)$_GET['Qty'];

$product_row=$db->get_one('product', "ProId='$ProId'");
$item_price=$product_row['Price_1'];
$SumTime=$db->get_sum('product_wholesale_class',"ProId = '{$product_row['ProId']}'",'Issue_L');

$db->update('shopping_cart', "$where and CId='$CId'", array(
		'Qty'	=>	$Qty,
		'Price'	=>	$item_price,
		'AllTime'=>	$SumTime*$Qty,
	)
);

$total_price=$db->get_sum('shopping_cart', $where, 'Qty*Price');

echo iconv_price($item_price).'|'.iconv_price($Qty*$item_price).'|'.iconv_price($total_price).'|'.'0'.'|'.(int)$db->get_sum('shopping_cart', $where, 'Qty').'|'.iconv_price($order_discount*$total_price);
exit;
?>