<?php
$url_1 = "http://mi.gdt.qq.com/gdt_mview.fcg?datatype=2&posid=1060805236016374&count=35&r=0.38652783716242145&adposcount=1&ext=%7B%22req%22%3A%7B%22scs%22%3A%2200019ab78960%22%2C%22conn%22%3A1%2C%22muidtype%22%3A1%2C%22sdkver%22%3A%224.8%22%2C%22c_market%22%3A%223%22%2C%22lng%22%3A113350540%2C%22c_w%22%3A360%2C%22c_device%22%3A%222014812%22%2C%22muid%22%3A%22cf3d69560f0cfc2fa1cf85932b8bc5ce%22%2C%22c_mf%22%3A%22Xiaomi%22%2C%22location_accuracy%22%3A66.65596771240234%2C%22postype%22%3A8%2C%22c_sdfree%22%3A3436867584%2C%22tmpallpt%22%3Atrue%2C%22carrier%22%3A0%2C%22deep_link_version%22%3A1%2C%22c_pkgname%22%3A%22qsbk.app%22%2C%22c_os%22%3A%22android%22%2C%22gdtid%22%3A%22cf3d69560f0cfc2fa1cf85932b8bc5ce_1457099593565%22%2C%22c_h%22%3A640%2C%22lat%22%3A23172830%2C%22c_ori%22%3A0%7D%7D";


$resultJson = getData($url_1);
var_dump($resultJson);
$resultData = json_decode( $resultJson, true );
$infoList = array();
$infoList = $resultData['data'];
$dataList = array();
$dataList = $infoList['1060805236016374'];
$dList = array();
$dList = $dataList['list'];
for ( $i = 0; $i < count($dList); $i++ ){
		echo $dList[$i]['txt']. '<br/>';
}


function getData($url) {
	$ch = curl_init();
	//$this_header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
	//curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	$output = curl_exec( $ch );
	curl_close( $ch );
	return $output;
}

?>curl_setopt($curl, CURLOPT_ACCEPT_ENCODING, "gzip"); // 关键在这里   
	$output = curl_exec( $ch );
	curl_close( $ch );
	return $output;
}

?>