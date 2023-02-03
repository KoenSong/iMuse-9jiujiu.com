<?php
$query_string=query_string();

$OId=$_GET['OId'];
$order_row=$db->get_one('orders', "$where and OId='$OId'");
!$order_row && js_location("$cart_url_cn?module=list");
(($order_row['OrderStatus']==1 || $order_row['OrderStatus']==3) && $_GET['act']!='payonline') && js_location("$cart_url_cn?module=payment&OId=$OId");
?>
<div id="lib_cart_station"><a href="/">首页</a> &gt; <a href="<?=$member_url_cn;?>?module=orders&OId=<?=$OId;?>&act=detail">订单号#<?=$OId;?></a> &gt; 完成付款</div>
<div id="lib_cart_guid"><img src="/images/lib/cart/guid_4_cn.gif" /></div>
<div id="lib_order_complete">
	<div class="order_info">订单号:<?=$OId;?>&nbsp;&nbsp;&nbsp;<em>日期:<?=date('m/d/Y H:i:s', $order_row['OrderTime']);?></em></div>
	<div class="blank12"></div>
	<div class="contents">
		<div class="title">亲爱的 <?=htmlspecialchars($_SESSION['member_LastName']);?>:</div><br />
		我们的网上商店感谢您的 <a href="<?=$member_url_cn;?>?module=orders&OId=<?=$OId;?>&act=detail">订单#<?=$OId;?></a>!<br /><br />
        您目前在您的帐户挂单。支付完成后，您的付款将被确认，我们将开始工作，您的订单上向右走，所以请登录到您的帐户，并检查您的订单。我们的网上商店，使通过提供一系列的便利付款方式支付您的订单轻松。<br /><br />
        如果您有任何其它问题，请联系我们的客户服务!<br /><br />
        您也可以登录我们的实时聊天。我们的在线销售运营商将非常乐意为您提供帮助。<br /><br />
        玩得开心购物！
	</div>
</div>