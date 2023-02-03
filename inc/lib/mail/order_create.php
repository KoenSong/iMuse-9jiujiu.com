<?php
!isset($order_row) && $order_row=$db->get_one('orders', "OId='$OId'");

ob_start();
?>
亲爱的 <strong><?=htmlspecialchars($order_row['ShippingFirstName'].' '.$order_row['ShippingLastName']);?></strong>:<br /><br />

这是来自<a href="<?=get_domain();?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=get_domain(0);?></a>自动发送的邮件，请不要回复此邮件。<br /><br />

谢谢您的订单#<a href="<?=get_domain().$member_url;?>?module=orders&OId=<?=$order_row['OId'];?>&act=detail" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=$order_row['OId'];?></a> 网址 <?=get_domain(0);?>.<br /><br />

<strong>请注意:</strong><br />
您的订单状态是<strong><?=$order_status_ary[$order_row['OrderStatus']];?></strong>，现在，这意味着未完成付款的是，我们只有7天内保留您的订单。

您需要支付 <strong><?=iconv_price(((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'])*(1+$order_row['PayAdditionalFee']/100));?></strong>, 请提交您的 <strong>订单号</strong>, <strong>参考号</strong>, <strong>金额</strong>, <strong>发件人的名字</strong> 和 <strong>地址</strong> 到<a href="<?=get_domain().$cart_url;?>?module=payment&OId=<?=$order_row['OId'];?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;">我们的网站</a> 之后您可以以多种方式付款 如:<strong>Western Union</strong> 或者 <strong>Money Gram</strong> 或者 <strong>Bank Transfer</strong>, 谢谢!<br /><br />


<a href="<?=get_domain().$cart_url;?>?module=payment&OId=<?=$order_row['OId'];?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;">如果你在线支付，请点击此处继续支付 &gt;&gt;</a><br /><br />

<?php include($site_root_path.'/inc/lib/mail/order_detail.php');?>

此致,<br /><br />

<?=get_domain(0);?> 客户服务团队
<?php
$mail_contents=ob_get_contents();
ob_end_clean();
?>

