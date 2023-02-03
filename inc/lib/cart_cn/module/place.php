<?php
$OId=$_GET['OId'];
?>
<div id="lib_order_place">
	<div>
		<strong>您的订单 订单号#<?=$OId;?> 已提交.</strong><br><br><br><br><br><br>
		<img src="/images/lib/cart/loading.gif"><br><br><br><br>
		如果您的页面3秒后没有跳转, 请<a href="<?=$cart_url_cn;?>?module=payment&OId=<?=$OId;?>">点击</a> 继续付款.
	</div>
</div>
<script language="javascript">
setTimeout('window.location="<?=$cart_url_cn;?>?module=payment&OId=<?=$OId;?>"', 3000);
</script>