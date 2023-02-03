<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理
	if($_POST){
		$Holder_UserName = $_POST['Holder_UserName'];
		$Holder_City 	 = (int)$_POST['Holder_City'];
		$Holder_Bank	 = (int)$_POST['Holder_Bank'];
		$Holder_Detail 	 = $_POST['Holder_Detail'];
		$Holder_Num 	 = $_POST['Holder_Num'];
		$MemberId        = (int)$_SESSION['member_MemberId'];
		
		if(!$db->get_row_count('member_holder',"MemberId='$MemberId'")){
			$db->insert('member_holder',array(
					'MemberId'  		=>  $MemberId, 
					'Holder_UserName'   =>  $Holder_UserName, 
					'Holder_City'		=>  $Holder_City,
					'Holder_Bank'  		=>  $Holder_Bank, 
					'Holder_Detail'  	=>  $Holder_Detail, 
					'Holder_Num'  		=>  $Holder_Num
				)
			);
		}else{
			$db->update('member_holder',"MemberId='$MemberId'",array(
					'Holder_UserName'   =>  $Holder_UserName, 
					'Holder_City'		=>  $Holder_City,
					'Holder_Bank'  		=>  $Holder_Bank, 
					'Holder_Detail'  	=>  $Holder_Detail, 
					'Holder_Num'  		=>  $Holder_Num
				)
			);
		}
		echo 1;
		
	}else{
		echo 0;	
	}

?>

