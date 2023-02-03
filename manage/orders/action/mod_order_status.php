<?php
$OrderStatus=(int)$_POST['OrderStatus'];

if($OrderStatus==5 || $OrderStatus==6){
	$TrackingNumber=$_POST['TrackingNumber'];
	$ShippingTime=@strtotime($_POST['ShippingTime']);
}else{
	$TrackingNumber='';
	$ShippingTime=0;
}
if($OrderStatus == '1'){
	$Smakesure_0=0;
	$Tmakesure_0=0;
	$Tmakesure_1=0;
}elseif($OrderStatus == '2'){
	$Smakesure_0=0;
	$Tmakesure_0=1;
	$Tmakesure_1=0;	
}elseif($OrderStatus == '3'){
	$Smakesure_0=1;
	$Tmakesure_0=1;
	$Tmakesure_1=1;	
}
$db->update('orders', $where, array(
			'OrderStatus'	=>	$OrderStatus,
			'Smakesure_0'	=>	$Smakesure_0,
			'Tmakesure_1'	=>	$Tmakesure_1,
			'Tmakesure_0'	=>	$Tmakesure_0,
			//'TrackingNumber'=>	$TrackingNumber,
			//'ShippingTime'	=>	$ShippingTime
		)
	);

if(($OrderStatus==5 || $OrderStatus==6) && $db->get_value('orders', $where, 'CutStock')==0){
	$ProId='0,';
	$item_row=$db->get_all('orders_product_list', $where, '*', 'ProId desc, LId desc');
	for($i=0; $i<count($item_row); $i++){
		$ProId.=$item_row[$i]['ProId'].',';
		$db->query("update product set Stock=Stock-{$item_row[$i]['Qty']} where ProId='{$item_row[$i]['ProId']}'");
	}
	$ProId.='0';
	$db->update('product', "ProId in($ProId) and Stock<0", array(
			'Stock'	=>	0
		)
	);
	
	$db->update('orders', $where, array(
			'CutStock'	=>	1
		)
	);
}

save_manage_log('修改订单状态');
?>