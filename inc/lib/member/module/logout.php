<?php
$_SESSION['member_MemberId']=$_SESSION['member_Email']=$_SESSION['member_Title']=$_SESSION['member_FirstName']=$_SESSION['member_LastName']=$_SESSION['member_Password']='';
unset($_SESSION);
js_location('/');
?>