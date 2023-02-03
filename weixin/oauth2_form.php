<?php
include('../inc/site_config.php');
include('../inc/fun/mysql.php');

/**
 * 返回代码
 * 插入成功：7000
 * 出错：7009
 * 已经插入：7001
 * 
 */
$table = 'weixin_like';
$memberid = $_POST['memberid'];

if(isset($_POST['phone'])){	
    $data = array(
			'memberid' 			=>	$_POST['memberid'],
			'openid'			=>	$_POST['openid'],
			'phone'				=>	$_POST['phone'],
			'custom_name'		=>	$_POST['name'],
			'custom_desc'		=>	$_POST['desc']
		);
    $openid = $_POST['openid'];
    $count = $db->get_row_count($table,"openid = '{$openid}' and memberid = '{$memberid}'");
    $row_list = $db->get_limit($table, "memberid = {$memberid}", "*" , "in_date desc", 0, 5);
    if($count == 0 || empty($openid)){
		$db->insert($table,$data);
		$result_code = 7000;
		$row_list = $db->get_limit($table, "memberid = {$memberid}", "*" , "in_date desc", 0, 5);
		$result = compact("result_code","row_list");
		echo json_encode($result);
    }else{
    	$result_code = 7001;
    	$row_list = array("");
    	$result = compact("result_code","row_list");
    	echo json_encode($result);
    }	
}

if(isset($_POST['type']) && $_POST['type'] == "count"){
	$count = $db->get_row_count($table,"memberid = '{$memberid}'");
	echo $count;
}

?>
