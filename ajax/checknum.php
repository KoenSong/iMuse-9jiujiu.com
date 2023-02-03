<?php
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
$VCode=strtoupper($_GET['date']);
//var_dump($_SESSION[md5('create')]);
if($VCode!=$_SESSION[md5('create')] || $_SESSION[md5('create')]==''){	//验证码错误
	echo 0;
}else{
	echo 1;	
}
?>

