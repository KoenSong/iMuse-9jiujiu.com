<?php
/*
url可带参数：
ProId:产品ID
*/

$MemberId=(int)$_GET['MemberId'];
$product_row=$db->get_one('member', "MemberId='$MemberId'");
?>