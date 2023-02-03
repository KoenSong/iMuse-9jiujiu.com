<?php
include('../../site_config.php');
include('../../set/ext_var.php');
include('../../fun/mysql.php');
include('../../function.php');
if($_POST){
$New_Mail=$_POST['Femail'];
if(!$db->get_row_count('newsletter',"Email = '$New_Mail'")){
	$db->insert('newsletter',
	array(
		'Email'=>$New_Mail,
		'PostTime'=> $service_time,
	));
	$tips='Thinks your attention';
}else{
	$tips='Your e-mail address is already in use';	
}
}
js_back($tips);
?>