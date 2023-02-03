<?php
$OrderStatus=(int)$_POST['OrderStatus'];

if($OrderStatus==5 || $OrderStatus==6){
	$TrackingNumber=$_POST['TrackingNumber'];
	$ShippingTime=@strtotime($_POST['ShippingTime']);
}else{
	$TrackingNumber='';
	$ShippingTime=0;
}

$db->update('order_twos', $where, array(
		'OrderStatus'	=>	$OrderStatus,
		//'TrackingNumber'=>	$TrackingNumber,
		//'ShippingTime'	=>	$ShippingTime
	)
);

if(($OrderStatus==5 || $OrderStatus==6) && $db->get_value('order_twos', $where, 'CutStock')==0){
	$ProId='0,';
	$item_row=$db->get_all('order_twos_product_list', $where, '*', 'ProId desc, LId desc');
	for($i=0; $i<count($item_row); $i++){
		$ProId.=$item_row[$i]['ProId'].',';
		$db->query("update product set Stock=Stock-{$item_row[$i]['Qty']} where ProId='{$item_row[$i]['ProId']}'");
	}
	$ProId.='0';
	$db->update('product', "ProId in($ProId) and Stock<0", array(
			'Stock'	=>	0
		)
	);
	
	$db->update('order_twos', $where, array(
			'CutStock'	=>	1
		)
	);
}

save_manage_log('修改订单状态');
?>