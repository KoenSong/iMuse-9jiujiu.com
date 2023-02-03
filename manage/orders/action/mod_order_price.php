<?php
$TotalPrice=(float)$_POST['TotalPrice'];
$Tmakesure_0=$_POST['Tmakesure_0'];

$db->update('orders', $where, array(
		'TotalPrice'		=>	$TotalPrice,
		'Tmakesure_0'		=>	$Tmakesure_0,
	)
);

save_manage_log('修改订单基本信息');
?>